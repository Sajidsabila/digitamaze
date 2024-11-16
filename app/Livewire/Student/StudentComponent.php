<?php

namespace App\Livewire\Student;

use App\Models\Kelas;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class StudentComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $photo, $name, $classroom_id, $gender, $phone, $search;
    public $student_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createStudent',
        'updateStudent',
        'deleteStudent'
    ];

    public function resetFields()
    {
        $this->student_id = null;
        $this->name = '';
        $this->photo = null;
        $this->gender = '';
        $this->classroom_id = '';
        $this->phone = '';
    }

    public function createStudent()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function editStudent($student_id)
    {
        $student = Student::find($student_id);
        if ($student) {
            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->phone = $student->phone;
            $this->gender = $student->gender;
            $this->classroom_id = $student->classroom_id;
            $this->isModalOpen = true;
        }
    }

    public function save()
    {
        $this->validate([
            'photo' => $this->student_id ? 'nullable|mimes:jpg,png,jpeg|max:1024' : 'required|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
            'gender' => 'required',
            'classroom_id' => 'required',
            'phone' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'photo' => 'Foto',
            'name' => 'Nama',
            'gender' => 'Jenis Kelamin',
            'classroom_id' => 'Kelas',
            'phone' => 'Telepon'
        ]);

        try {
            $student = Student::find($this->student_id);

            if ($this->photo && $student && $student->photo) {
                Storage::disk('public')->delete($student->photo);
            }

            if ($this->photo) {
                $photoPath = $this->photo->store('students', 'public');
            } else {
                $photoPath = $student ? $student->photo : null;
            }

            Student::updateOrCreate(
                ['id' => $this->student_id],
                [
                    'name' => $this->name,
                    'photo' => $photoPath,
                    'gender' => $this->gender,
                    'classroom_id' => $this->classroom_id,
                    'phone' => $this->phone,
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            session()->flash("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }

    public function deleteStudent($student_id)
    {
        try {
            if ($student_id) {
                $student = Student::find($student_id);
                if ($student) {
                    if ($student->photo) {
                        Storage::disk('public')->delete($student->photo);
                    }

                    $student->delete();
                    session()->flash('success', 'Data Berhasil dihapus.');
                } else {
                    session()->flash('error', 'Data tidak ditemukan.');
                }
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan : ' . $th->getMessage());
        }
    }

    public function render()
    {
        $students = Student::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('gender', 'like', '%' . $this->search . '%')
                ->orWhere('nis', 'like', '%' . $this->search . '%')
                ->orWhereHas('kelas', function ($kelasQuery) {
                    $kelasQuery->where('class', 'like', '%' . $this->search . '%'); // Ganti 'class' dengan kolom yang sesuai di tabel kelas
                });
        })
            ->with('kelas')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $kelas = Kelas::all();
        return view('livewire.student.index', compact('students', 'kelas'));
    }
}

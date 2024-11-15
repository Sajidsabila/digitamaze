<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TeacherComponent extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $photo, $name, $classroom_id, $gender, $phone, $search;
    public $teacher_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createTeacher',
        'updateTeacher',
        'deleteTeacher'
    ];

    public function resetFields()
    {
        $this->Teacher_id = null;
        $this->name = '';
        $this->photo = null;
        $this->gender = '';
        $this->phone = '';
    }

    public function createTeacher()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function editTeacher($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        if ($teacher) {
            $this->teacher_id = $teacher->id;
            $this->name = $teacher->name;
            $this->phone = $teacher->phone;
            $this->gender = $teacher->gender;
            $this->isModalOpen = true;
        }
    }

    public function save()
    {
        $this->validate([
            'photo' => $this->teacher_id ? 'nullable|mimes:jpg,png,jpeg|max:1024' : 'required|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'photo' => 'Foto',
            'name' => 'Nama',
            'gender' => 'Jenis Kelamin',
            'phone' => 'Telepon'
        ]);

        try {
            $teacher = Teacher::find($this->teacher_id);

            if ($this->photo && $teacher && $teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }

            if ($this->photo) {
                $photoPath = $this->photo->store('teachers', 'public');
            } else {
                $photoPath = $teacher ? $teacher->photo : null;
            }

            Teacher::updateOrCreate(
                ['id' => $this->teacher_id],
                [
                    'name' => $this->name,
                    'photo' => $photoPath,
                    'gender' => $this->gender,
                    'phone' => $this->phone,
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }

    public function deleteTeacher($teacher_id)
    {
        try {
            if ($teacher_id) {
                $teacher = Teacher::find($teacher_id);
                if ($teacher) {
                    if ($teacher->photo) {
                        Storage::disk('public')->delete($teacher->photo);
                    }

                    $teacher->delete();
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
        $teachers = Teacher::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('gender', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(1);
        return view('livewire.teacher.index', compact('teachers', ));
    }
}


<?php

namespace App\Livewire\Kelas;

use App\Models\Kelas;
use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class KelasComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $class, $teacher_id, $search;
    public $kelas_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createKelas',
        'updateKelas',
        'deleteKelas'
    ];

    public function resetFields()
    {
        $this->kelas_id = null;
        $this->class = '';
        $this->classroom_id = '';

    }

    public function createKelas()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function editKelas($kelas_id)
    {
        $kelas = Kelas::find($kelas_id);
        if ($kelas) {
            $this->kelas_id = $kelas->id;
            $this->class = $kelas->class;
            $this->teacher_id = $kelas->teacher_id;
            $this->isModalOpen = true;
        }
    }

    public function save()
    {
        $this->validate([
            'class' => $this->kelas_id ? 'required|unique:kelas,class,' . $this->kelas_id : 'required|unique:kelas,class',
            'teacher_id' => 'required'
        ], [
            'required' => ':attribute harus diisi',
        ], [
            'teacher_id' => 'Foto',
            'class' => 'Nama',
        ]);

        try {
            $kelas = Kelas::find($this->kelas_id);

            Kelas::updateOrCreate(
                ['id' => $this->kelas_id],
                [
                    'class' => $this->class,
                    'teacher_id' => $this->teacher_id,
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            session()->flash("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }

    public function deleteKelas($kelas_id)
    {
        try {
            if ($kelas_id) {
                $kelas = Kelas::find($kelas_id);
                if ($kelas) {
                    $kelas->delete();
                    session()->flash('success', 'Data Berhasil dihapus.');
                } else {
                    session()->flash('error', 'Data tidak ditemukan.');
                }
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan : ' . $th->getMessage());
        }
    }
    public function detail()
    {

    }
    public function render()
    {
        $kelass = Kelas::when($this->search, function ($query) {
            $query->where('class', 'like', '%' . $this->search . '%')
                ->orWhereHas('teacher', function ($kelasQuery) {
                    $kelasQuery->where('name', 'like', '%' . $this->search . '%');
                });
        })
            ->with('teacher')
            ->orderBy('created_at', 'desc')
            ->paginate(10);  // Menampilkan 10 data per halaman
        $teachers = Teacher::all();
        return view('livewire.kelas.index', compact('kelass', 'teachers'));
    }
}

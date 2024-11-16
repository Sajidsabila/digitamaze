<?php

namespace App\Livewire\Liststudent;

use App\Models\Kelas;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class ListStudentComponent extends Component
{
    use WithPagination;
    public $search;
    public $kelas_id;

    public function render()
    {
        $kelass = Kelas::all();
        if ($this->kelas_id) {
            $students = Student::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('gender', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%');
            })
                ->with('kelas')
                ->where('classroom_id', $this->kelas_id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $students = collect();
        }
        return view('livewire.liststudent.index', compact('kelass', 'students'));
    }
}

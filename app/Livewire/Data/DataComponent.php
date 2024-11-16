<?php

namespace App\Livewire\Data;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class DataComponent extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $students = Student::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('gender', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%')
                    ->orWhereHas('kelas', function ($kelasQuery) {
                        $kelasQuery->where('class', 'like', '%' . $this->search . '%')
                            ->orWhereHas('teacher', function ($teacherQuery) {
                                $teacherQuery->where('name', 'like', '%' . $this->search . '%');
                            });
                    });
            })
            ->with('kelas')
            ->paginate(10);
        return view('livewire.data.index', compact('students'));
    }
}

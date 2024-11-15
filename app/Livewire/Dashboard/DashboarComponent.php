<?php

namespace App\Livewire\Dashboard;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;

class DashboarComponent extends Component
{
    public function render()
    {
        $countStudent = Student::count();
        $countTeacher = Teacher::count();
        $countKelas = Kelas::count();
        return view(
            'livewire.dashboard.index',
            compact('countStudent', 'countTeacher', 'countKelas')
        );
    }
}

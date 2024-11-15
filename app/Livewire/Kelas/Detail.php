<?php
namespace App\Livewire\Kelas;

use App\Models\Kelas;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithPagination;

    // Variabel untuk pencarian

    public function render()
    {
        $kelas_id = request()->route('id');

        $kelass = Kelas::with('teacher')->find($kelas_id);

        $students = Student::where('classroom_id', $kelas_id)->paginate(10);

        return view('livewire.kelas.detail', compact('students', 'kelass'));
    }
}
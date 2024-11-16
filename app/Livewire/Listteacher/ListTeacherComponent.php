<?php

namespace App\Livewire\Listteacher;

use App\Models\Kelas;
use Livewire\Component;

class ListTeacherComponent extends Component
{
    public $kelas_id;
    public function render()
    {

        $kelass = Kelas::get();
        if ($this->kelas_id) {
            $teacher = Kelas::with('teacher')->where('id', $this->kelas_id)->first();
        } else {
            $teacher = collect();
        }
        return view('livewire.listteacher.index', compact('kelass', 'teacher'));
    }
}

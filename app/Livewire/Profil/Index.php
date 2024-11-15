<?php

namespace App\Livewire\Profil;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public ?User $user;
    public $name, $email, $password;

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function update()
    {
        $user_update = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:5',
        ]);

        try {
            if ($this->password) {
                $user_update['password'] = bcrypt($this->password);
            } else {
                unset($user_update['password']);
            }

            $this->user->update($user_update);
            $this->user->refresh();

            $this->reset(['password']);
            $this->name = $this->user->name;
            $this->email = $this->user->email;

            return back()->with('success', 'Profil Berhasil Diubah');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.profil.index');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{

    public $email, $name, $password;
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required|unique:users,name',
            'password' => 'required|min:5'
        ], [
            'required' => ':attribute tidak boleh kosong.',
            'email.email' => ':attribute harus berupa email yang valid.',
            'unique' => ':attribute sudah digunakan.',
            'min' => ':attribute minimal :min karakter.'
        ], [
            'email' => 'Email',
            'name' => 'Nama',
            'password' => 'Password'
        ]);

        try {
            User::create(
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password)
                ]
            );

            return back()->with('success', 'Akun Berhasil Dibuat Silahkan ');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan' . $th->getMessage());
        }
    }
}

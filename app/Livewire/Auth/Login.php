<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $user = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute berupa email'
        ], [
            'email' => 'email',
            'password' => 'password'
        ]);
        try {
            if (Auth::attempt($user)) {
                return redirect()->route('student');
            }
            return back()->with('error', 'email atau password salah');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan : ' . $th->getMessage());
        }


    }
}

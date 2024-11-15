<?php

namespace App\Livewire\User;

use App\Models\User;
use Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name, $email, $password, $search;
    public $user_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createUser',
        'updateUser',
        'deleteUser'
    ];

    public function resetFields()
    {
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function createUser()
    {
        $this->resetFields();
        $this->isModalOpen = true;
    }

    public function editUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $this->user_id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            $this->isModalOpen = true;
        } else {
            session()->flash('error', 'Data pengguna tidak ditemukan.');
        }
    }

    public function save()
    {
        $this->validate([
            'email' => $this->user_id ? 'nullable|unique:users,email,' . $this->user_id : 'required|unique:users,email',
            'name' => $this->user_id ? 'nullable|unique:users,name,' . $this->user_id : 'required|unique:users,name',
            'password' => $this->user_id ? 'nullable|min:5' : 'required|min:5'
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
            User::updateOrCreate(
                ['id' => $this->user_id],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => $this->password ? Hash::make($this->password) : ($this->user_id ? User::find($this->user_id)->password : null)
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            session()->flash("error", "Terjadi kesalahan: " . $th->getMessage());
        }
    }

    public function deleteUser($user_id)
    {
        try {
            $user = User::find($user_id);
            if ($user) {
                $user->delete();
                session()->flash('success', 'Data berhasil dihapus.');
            } else {
                session()->flash('error', 'Data tidak ditemukan.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function render()
    {
        $users = User::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.user.index', compact('users'));
    }
}

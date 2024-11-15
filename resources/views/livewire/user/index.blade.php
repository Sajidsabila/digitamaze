<div class="card">
    <div class="card-header bg-primary text-white">
        Data Siswa
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" wire:click="createUser">Tambah Data</button>
            <input type="search" class="form-control w-25" placeholder="Cari..." wire:model.live="search">
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light ">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <div class="d-flex  gap-4">
                                    <button type="button" class="btn btn-warning ms-2"
                                        wire:click="editUser({{ $user->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger me-4"
                                        wire:click="deleteUser({{ $user->id }})">Delete</button>
                                </div>
                            </td>



                        </tr>
                    @empty
                        <td colspan="8" class="text-center fs-1 fw-bold">Data User Kosong</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex gap-2">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.user.form')
    @endif
</div>

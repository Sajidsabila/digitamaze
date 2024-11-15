<div class="card">
    <div class="card-header bg-primary text-white">
        Data Guru
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" wire:click="createTeacher">Tambah Data</button>
            <input type="search" class="form-control w-25" placeholder="Cari..." wire:model.live="search">
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light ">
                    <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>NIP</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $key => $teacher)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $teacher->photo) }}" class="rounded float-left"
                                    alt="{{ $teacher->name }}" width="200px" height="200px">
                            </td>
                            <td>{{ $teacher->nip }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ $teacher->phone }}</td>

                            <td class="d-flex gap-4">
                                <div class="d-flex gap-4">
                                    <button type="button" class="btn btn-warning"
                                        wire:click="editTeacher({{ $teacher->id }})">Edit</button>

                                    <button type="button" class="btn btn-danger"
                                        onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { @this.call('deleteTeacher', {{ $teacher->id }}) }">
                                        Delete
                                    </button>
                                </div>


                            </td>
                        </tr>
                    @empty
                        <td colspan="8" class="text-center fs-1 fw-bold">Data Siswa Kosong</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex gap-2">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.teacher.form')
    @endif
</div>

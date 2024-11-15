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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" wire:click="createStudent">Tambah Data</button>
            <input type="search" class="form-control w-25" placeholder="Cari..." wire:model.live="search">
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light ">
                    <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $key => $student)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $student->photo) }}" class="rounded float-left"
                                    alt="{{ $student->name }}" width="200px" height="200px">
                            </td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->kelas->class ?? 'kelas kosong' }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->phone }}</td>

                            <td class="d-flex gap-4">
                                <div class="d-flex gap-4">
                                    <button type="button" class="btn btn-warning"
                                        wire:click="editStudent({{ $student->id }})">Edit</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { @this.call('deleteStudent', {{ $student->id }}) }">
                                        Delete
                                    </button>
                                    <button type="button" class="btn btn-danger ms-4"
                                        wire:click="deleteStudent({{ $student->id }})">Delete</button>
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
                {{ $students->links() }}
            </div>
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.student.form')
    @endif
</div>

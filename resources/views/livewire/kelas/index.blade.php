<div class="card">
    <div class="card-header bg-primary text-white">
        Data Kelas
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
            <button class="btn btn-primary" wire:click="createKelas">Tambah Data</button>
            <input type="search" class="form-control w-25" placeholder="Cari..." wire:model.live="search">
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light ">
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Nama Pengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelass as $key => $kelas)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kelas->class }}</td>
                            <td>{{ $kelas->teacher->name }}</td>

                            <td class="d-flex gap-3">
                                <button type="button" class="btn btn-warning"
                                    wire:click="editKelas({{ $kelas->id }})">Edit</button>
                                <button type="button" class="btn btn-danger"
                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { @this.call('deleteKelas', {{ $kelas->id }}) }">
                                    Delete
                                </button>
                                <a href="{{ route('detail.kelas', ['id' => $kelas->id]) }}"
                                    class="btn btn-secondary">Detail</a>
                            </td>



                        </tr>
                    @empty
                        <td colspan="8" class="text-center fs-1 fw-bold">Data Kelas Kosong</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="d-flex gap-2">
                {{ $kelass->links() }}
            </div>
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.kelas.form')
    @endif
</div>

<div class="row">
    <div class="card col-12">
        <div class="card-header bg-primary text-white">Filter Kelas</div>
        <div class="card-body">
            <p class="fw-4 font-bold">Pilih Kelas Untuk Melihat Data</p>
            <label for="kelas_id">Pilih Kelas</label>
            <select wire:model.live="kelas_id" id="kelas_id" class="form-control">
                <option value="" selected>Pilih Kelas</option>
                @foreach ($kelass as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->class }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($kelas_id)
        <div class="card col-12">
            <div class="card-header bg-primary text-white">Data Siswa</div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <input type="search" class="form-control w-25" placeholder="Cari siswa..."
                        wire:model.live="search">
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Nama Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $key => $student)
                                <tr>
                                    <td>{{ $key + 1 }}
                                    </td>
                                    <td>{{ $student->nis }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->kelas->class ?? '-' }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center fs-1 fw-bold">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
</div>
@endif

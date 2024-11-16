<div class="row">
    <div class="card col-12">
        <div class="card-header bg-primary text-white">Filter Kelas</div>
        <div class="card-body">
            <p class="fw-4 font-bold">Pilih Kelas Untuk Melihat Data</p>
            <label for="kelas_id">Pilih Kelas</label>
            <select wire:model.live="kelas_id" id="kelas_id" class="form-control">
                <option value="" selected disabled>Pilih Kelas</option>
                @foreach ($kelass as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->class }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($kelas_id)
        <div class="card col-12">
            <div class="card-header bg-primary text-white">Data Guru</div>
            <div class="card-body">

                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Foto</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="{{ $teacher->teacher && $teacher->teacher->photo ? asset('storage/' . $teacher->teacher->photo) : asset('img/no-image.jpg') }}"
                                        class="rounded-circle mb-3" width="120" height="120"
                                        alt="{{ $teacher->teacher->name ?? 'Guru tidak ada' }}"></td>
                                </td>
                                <td>{{ $teacher->teacher->nip ?? '-' }}</td>
                                <td>{{ $teacher->teacher->name ?? '-' }}</td>
                                <td>{{ $teacher->teacher->gender ?? '-' }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endif

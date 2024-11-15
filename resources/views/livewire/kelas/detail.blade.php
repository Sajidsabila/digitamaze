<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0 fw-bold">Data Siswa Kelas {{ $kelass->class }}</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <!-- Card Nama Pengajar -->
            <div class="card col-5 shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h6 class="mb-0 fw-bold">Nama Pengajar</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $kelass->teacher && $kelass->teacher->photo ? asset('storage/' . $kelass->teacher->photo) : asset('img/no-image.jpg') }}"
                        class="rounded-circle mb-3" width="120" height="120"
                        alt="{{ $kelass->teacher->name ?? 'Guru tidak ada' }}">

                    <div class="mb-3">
                        <label for="teacher-name" class="form-label fw-semibold">Nama Pengajar</label>
                        <input type="text" id="teacher-name"
                            value="{{ $kelass->teacher ? $kelass->teacher->name : 'Guru tidak ada' }}"
                            class="form-control text-center" readonly>
                    </div>

                    <div>
                        <label for="teacher-nip" class="form-label fw-semibold">NIP</label>
                        <input type="text" id="teacher-nip"
                            value="{{ $kelass->teacher ? $kelass->teacher->nip : 'Guru tidak ada' }}"
                            class="form-control text-center" readonly>
                    </div>
                </div>
            </div>


        </div>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $key => $student)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->gender }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Data Kelas Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $students->links() }}
        </div>
    </div>
</div>

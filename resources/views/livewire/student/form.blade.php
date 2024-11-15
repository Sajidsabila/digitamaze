<div wire:ignore.self class="modal fade show" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $student_id ? 'Edit Siswa' : 'Create Siswa' }}
                </h5>
                <button type="button" class="close" wire:click="$set('isModalOpen', false)" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mb-3">
                        <!-- Image Section -->
                        <label for="photo" class="mb-3 text-center">
                            <img src="{{ $photo ? $photo->temporaryUrl() : asset('img/no-image.jpg') }}" class="rounded"
                                alt="Student Image" width="100px">
                        </label>

                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                            wire:model="photo">

                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            wire:model.defer="name" placeholder="Masukkan Nama Lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" inputmode="numeric"
                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                            wire:model.defer="phone" placeholder="Masukkan Telepon">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender Select -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select value="" class="form-control @error('gender') is-invalid @enderror" id="gender"
                            wire:model.defer="gender">
                            <option value="" disabled selected>Silahkan Pilih</option>
                            <option value="Laki - laki">Laki - laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Classroom Select -->
                    <div class="mb-3 form-group">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select
                            class="form-control js-example-basic-single  @error('classroom_id') is-invalid @enderror"
                            id="kelas" wire:model.defer="classroom_id">
                            <option value="" disabled selected>Silahkan Pilih</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->class }} - {{ $k->id }}</option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ $student_id ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

   <div class="container">
       <div   class="row justify-content-center">
           <div class="col-md-6">
               <div class="card">
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
                   <div class="card-header bg-primary text-white">
                       Profil
                       Pengguna
                   </div>
                   <div class="card-body border-3">
                       <form wire:submit="update">
                           <div class="mb-3">
                               <label for="username" class="form-label">Username</label>
                               <input type="text" wire:model="name" class="form-control"   id="username"
                                   placeholder="Masukkan username">
                           </div>
                           <div class="mb-3">
                               <label for="email" class="form-label">Email</label>

                               <input type="email" wire:model="email" class="form-control" id="email"
                                   placeholder="Masukkan   
                            email">
                           </div>
                           <div class="mb-3">
                               <label for="password" class="form-label">Password</label>
                               <input type="password" class="form-control" id="password"
                                   placeholder="Masukkan password">
                           </div>
                           <button type="submit" class="btn btn-primary">Simpan</button>

                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

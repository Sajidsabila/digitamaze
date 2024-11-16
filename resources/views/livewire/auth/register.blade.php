  <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="row justify-content-center w-100">
          <div class="col-lg-5 col-md-6 col-12">
              <div class="card shadow-sm border-0 rounded-4">
                  <div class="card-body p-4">
                      @if (session('success'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ session('success') }} <a href="{{ route('login') }}"
                                      wire:navigate>Login</a></strong>
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
                      <h3 class="text-center mb-4">Register</h3>

                      <!-- Form Login -->
                      <form wire:submit.prevent="save">
                          <div class="mb-3">
                              <label for="email" class="form-label">Email Address</label>
                              <input type="email" id="email" wire:model="email"
                                  class="form-control @error('email') is-invalid @enderror"
                                  placeholder="Enter your email">
                              @error('email')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="name" id="name" wire:model="name"
                                  class="form-control @error('name') is-invalid @enderror"
                                  placeholder="Enter your password">
                              @error('name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" id="password" wire:model="password"
                                  class="form-control @error('password') is-invalid @enderror"
                                  placeholder="Enter your password">
                              @error('password')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>

                          <button type="submit" class="btn btn-primary w-100 py-2">Sign Up</button>
                      </form>
                      <div class="mt-4 text-center">
                          <p class="mb-0"> have an account? <a href="{{ route('login') }}" class="text-primary">Log
                                  In</a>
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

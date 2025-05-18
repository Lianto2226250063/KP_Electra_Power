<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>
    .gradient-custom {
    /* fallback for old browsers */
    background: #121766;
  
    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
  
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
    }
    .full-height-background {
        min-height: 100vh;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        overflow: auto;
    }
  </style>
<section class="full-height-background gradient-custom">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 ">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 py-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Register</h2>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" />
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Email -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" />
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Password -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" />
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Confirm Password -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-lg" />
                    </div>

                    <!-- Upload TTD -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="ttd">Upload TTD (Image)</label>
                        <input type="file" name="ttd" class="form-control form-control-lg" accept="image/*" />
                    </div>
                    @error('ttd')
                        <span class="invalid-feedback d-block text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <!-- Role -->
                    <div class="form-outline form-white mb-4">
                        <label class="form-label" for="role">Role</label>
                        <select name="role" class="form-control form-control-lg">
                            <option value="" disabled selected>Select Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    @error('role')
                        <span class="invalid-feedback d-block text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                </form>

                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </section>

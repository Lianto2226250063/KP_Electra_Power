<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <style>
    .gradient-custom {
      background: #121766;
      background: -webkit-linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
      background: linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
    }
    .full-height-background {
      min-height: 100vh;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body>
<section class="full-height-background gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Lupa Password</h2>
              <p class="text-muted">Masukkan email Anda untuk menerima kode OTP</p>

              {{-- Error --}}
              @if ($errors->any())
                <div class="alert alert-danger text-start">
                  @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                  @endforeach
                </div>
              @endif

              {{-- Sukses --}}
              @if (session('success'))
                <div class="alert alert-success text-start">{{ session('success') }}</div>
              @endif

              <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-outline form-white mb-4 text-start">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" name="email" id="email"
                         class="form-control form-control-lg @error('email') is-invalid @enderror"
                         value="{{ old('email') }}" required />
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <button class="btn btn-primary btn-block fa-lg gradient-custom mb-3" style="width:100%" type="submit">
                  Kirim OTP
                </button>
              </form>

              <div class="text-center">
                <a href="{{ route('login') }}" class="text-muted">Kembali ke Login</a>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>

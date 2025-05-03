<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
    .gradient-custom-2 {
/* fallback for old browsers */
background: #121766;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
  background: linear-gradient(to right, #121766, #2f31a0, #132796, #1f22c7);
    border: 2px solid #1f22c7; /* match one of your gradient colors */
    color: white;
}
}
button {
    width: 100%;
}

.card-body {
    width: 90%;
}
.card {
  border: none !important;
}

section
 {
  background-image: url('../images/bg.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
</style>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-5 text-black" style="border: none;">
                <div class="row g-0">
                  <div class="col-lg-6 bg-light">
                    <div class="card-body p-md-5 mx-md-4 bg-light">
                      <div class="text-center">
                        <img src="../images/ElectraPower.png"
                          style="width: 400px; height: 175px;" alt="logo">
                      </div>
                      <br><br>
                      <a href="{{ route('login') }}">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Login</button>
                    </a>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">Selamat datang di Electra Power!</h4>
                      <p class="small mb-0">PT Electra Power adalah suatu usaha yang bergerak di bidang jasa service electro motor, genset, reparasi suku cadang mekanik serta menyediakan aneka sparepart elektromotor seperti fan, terminal, cover, kawat tembaga supreme, snapring, bearing. Workshop ini didukung dengan peralatan kerja yang modern dan lengkap, yang memudahkan proses pengerjaan untuk mencapai efisiensi waktu dan biaya.
                      </p>
                      <br>
                      <a href="">
                        <button class="btn btn-primary btn-block fa-lg bg-dark mb-3" type="button">Hubungi kami Melalui Whatsapp</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

</body>

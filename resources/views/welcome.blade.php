<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
    .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #286316, #49a02f, #7ab34c, #8efa79);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #286316, #49a02f, #7ab34c, #8efa79);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
  background: linear-gradient(to right, #286316, #49a02f, #7ab34c, #8efa79);
    border: 2px solid #49a02f; /* match one of your gradient colors */
    color: white;
}
}
button {
    width: 100%;
}

.card-body {
    width: 90%;
}


section
 {
  background-image: url('../images/bg.jpeg');
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
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6 bg-dark">
                    <div class="card-body p-md-5 mx-md-4 bg-dark">
                      <div class="text-center">
                        <img src="../images/HealthPackLogo.png"
                          style="width: 300px;" alt="logo">
                      </div>
                      <a href="{{ route('register') }}">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">START YOUR JOURNEY</button>
                    </a>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                      <h4 class="mb-4">Selamat datang di Health Pack!</h4>
                      <p class="small mb-0">Solusi catering makanan sehat untuk gaya hidup aktif dan seimbang! Kami hadir untuk kamu yang peduli dengan asupan harian tanpa harus repot memasak. Menu kami dibuat dengan bahan-bahan segar, tanpa pengawet, dan disusun oleh ahli gizi untuk memastikan kamu mendapatkan nutrisi terbaik setiap hari.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

</body>

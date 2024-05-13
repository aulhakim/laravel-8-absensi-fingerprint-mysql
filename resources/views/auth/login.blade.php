<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIstem Informasi Fingerprint</title>
  <link rel="shortcut icon" type="image/png" href="" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />

  <style>
   body {
    /* margin: 0;
    padding: 0; */
    background-image: url('{{ asset('assets/images/backgrounds/absensi-baru1.png') }}');
    /* background-size: cover;
    background-position: center;
    background-repeat: no-repeat; */
     /* Full height */
  height: 100%;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;
}


  </style>
</head>



<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <h5 class="text-center">SISTEM INFORMASI FINGERPRINT</h5>
                <p class="text-center">SDN PANCAWATI 02</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    {{-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> --}}
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    {{-- <input type="password" class="form-control" id="exampleInputPassword1"> --}}
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                  
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  {{-- <div class="d-flex align-items-center justify-content-center">
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Register</a>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
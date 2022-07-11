
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('assets/login2/css/style.css') }}">

	</head>
	<body>
	<div class="div">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                                <div class="text w-100">
                                    <h2>Selamat Datang </h2>
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width:250px;">
                                    <h2 class="mt-3" style="font-size:20px;">MIT CONFERENCE SYSTEM </h2>

                                    <p>Anda belum memiliki akun?</p>

                                    <a href="{{ route('register') }}" class="btn btn-white btn-outline-white">Daftar Di Sini</a>
                                </div>
                      </div>
                            <div class="login-wrap p-4 p-lg-5">
                          <div class="d-flex">
                              <div class="w-100">
                                    <h3 class="mb-1">Sudah Memiliki Akun?</h3>
                                    <p>Silahkan Masukan username dan password terdaftar</p>
                              </div>

                          </div>
                                <form action="{{ route('login') }}" method="post" class="signin-form">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                              <div class="form-group mb-3">
                                  <label class="label" for="name">Username</label>
                                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                              </div>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                          <input type="checkbox" checked>
                                          <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Forgot Password</a>
                                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

	<script src="{{ asset('assets/login2/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/login2/js/popper.js') }}"></script>
  <script src="{{ asset('assets/login2/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/login2/js/main.js') }}"></script>

	</body>
</html>


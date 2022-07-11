
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">



	<link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">

	</head>
	<body>
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

                                    <a href="{{ route('login') }}" class="btn btn-white btn-outline-white">Login Di Sini</a>
							</div>
			        </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-1">Belum Memiliki Akun?</h3>
                            <p>Silahkan daftarkan diri anda pada form di bawah ini</p>
			      		</div>
			      	</div>
                    <form action="{{ route('register') }}" class="signin-form" method="POST">
                        {{ csrf_field() }} {{ method_field("POST") }}
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <div>
                                @if ($errors->has('username'))
                                    <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="full_name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="full_name" placeholder="full_name">
                            <div>
                                @if ($errors->has('full_name'))
                                    <small class="form-text text-danger">{{ $errors->first('full_name') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email">
                            <div>
                                @if ($errors->has('email'))
                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="email">Telephone</label>
                            <input type="text" class="form-control" name="telephone" placeholder="telephone">
                            <div>
                                @if ($errors->has('telephone'))
                                    <small class="form-text text-danger">{{ $errors->first('telephone') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="email">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password">
                            <div>
                                @if ($errors->has('password'))
                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px !important;">
                            <label class="label" for="email">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation">
                            <div>
                                @if ($errors->has('password'))
                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:15px !important;">
                            <button type="submit" class="form-control btn btn-primary submit px-3"><i class="fa fa-check-circle"></i>&nbsp;Daftar Sekarang</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
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

	<script src="{{ asset('assets/login/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/login/js/popper.js') }}"></script>
  <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/login/js/main.js') }}"></script>

	</body>
</html>


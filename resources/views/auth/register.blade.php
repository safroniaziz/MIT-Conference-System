@php
    use App\Models\Pengaturan;
@endphp
<!doctype html>
<html lang="en">
  <head>
  	<title>Registreation Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">



	<link rel="stylesheet" href="{{ asset('assets/register/css/style.css') }}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
                                @php
                                    $setting = Pengaturan::where('id',1)->first();
                                @endphp
                                <p style="text-transform:uppercase; font-size:22px !important; font-weight:bold">welcome to <br> {{ $setting->nama_app }} </p>
                                <img src="{{ asset('upload/aplication_logo/'.$setting->logo_app) }}" alt="" style="width:150px;">
                                <br>
                                    <br>
                                    <p style="text-transform:uppercase; font-style: italic; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                                       <strong> <u>Already have an acoount?</u> </strong><br>
                                        Please Sign In Here
                                    </p>

                                    <a href="{{ route('login') }}" style="margin-bottom:30px !important;" class="btn btn-white btn-outline-white">Sign In</a>
                                    <br>
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width:100px;">
                                    <br>
                                    <p><strong>SUPPORT BY MIT CONFERENCE SYSTEM <br> CV.MEDIA INTI TEKNOLOGI</strong> </p>

							</div>
			        </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-1">Don't have an account?</h3>
                                <p>Please register yourself in the form below</p>
                            </div>
                        </div>
                        <form action="{{ route('daftar') }}" class="signin-form" method="POST">
                            {{ csrf_field() }} {{ method_field("POST") }}
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="username">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                    <div>
                                        @if ($errors->has('username'))
                                            <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="full name">
                                    <div>
                                        @if ($errors->has('full_name'))
                                            <small class="form-text text-danger">{{ $errors->first('full_name') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email">
                                    <div>
                                        @if ($errors->has('email'))
                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="access">Register as</label>
                                    <select name="access" id="" class="form-control">
                                        <option disabled selected>-- choose --</option>
                                        <option value="participant">Participant</option>
                                        <option value="presenter">Presenter</option>
                                    </select>
                                    <div>
                                        @if ($errors->has('access'))
                                            <small class="form-text text-danger">{{ $errors->first('access') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="email">Telephone</label>
                                    <input type="text" class="form-control" name="telephone" placeholder="telephone">
                                    <div>
                                        @if ($errors->has('telephone'))
                                            <small class="form-text text-danger">{{ $errors->first('telephone') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6" style="margin-bottom:5px !important;">
                                    <label class="label" for="email">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="address">
                                    <div>
                                        @if ($errors->has('address'))
                                            <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="email">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                    <div>
                                        @if ($errors->has('password'))
                                            <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12" style="margin-bottom:5px !important;">
                                    <label class="label" for="email">Konfirmasi Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation">
                                    <div>
                                        @if ($errors->has('password'))
                                            <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-12" style="margin-top:15px !important;">
                                    <button type="submit" class="form-control btn btn-primary " style="padding: 0px !important;"><i class="fa fa-check-circle"></i>&nbsp;Create An Account</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-md-left">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                        </form>
		            </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('assets/register/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/register/js/popper.js') }}"></script>
  <script src="{{ asset('assets/register/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/register/js/main.js') }}"></script>

	</body>
</html>


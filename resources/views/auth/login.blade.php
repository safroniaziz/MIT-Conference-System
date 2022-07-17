
<!doctype html>
<html lang="en">
  <head>
  	<title>Login Form</title>
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
                                    <p style="text-transform:uppercase; font-size:22px !important; font-weight:bold">welcome to <br> oceri submission system </p>
                                        <img src="{{ asset('upload/logo/oceri.png') }}" alt="" style="width:150px;">
                                        <br>
                                        <br>
                                        <p style="text-transform:uppercase; font-style: italic; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                                           <strong> <u>Don't have an acoount?</u> </strong><br>
                                            Please Register Here
                                        </p>

                                        <a href="{{ route('register') }}" style="margin-bottom:30px !important;" class="btn btn-white btn-outline-white">Register</a>
                                        <br>
                                        <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width:100px;">
                                        <br>
                                        <p><strong>SUPPORT BY MIT CONFERENCE SYSTEM <br> CV.MEDIA INTI TEKNOLOGI</strong> </p>

                                </div>
                      </div>
                            <div class="login-wrap p-4 p-lg-5">
                                <div class="d-flex d-flex align-items-center order-md-last" style="margin-top:60px !important;">
                                    <div class="w-100">
                                            <h3 class="mb-1">Already Have an Account?</h3>
                                            <p>Please enter the registered username and password</p>
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
                                        <button type="submit" class="form-control btn btn-primary" style="padding: 0px !important;">Log In</button>
                                    </div>
                                    <div class="form-group d-md-flex">
                                    <div class="w-50 text-md-left">
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


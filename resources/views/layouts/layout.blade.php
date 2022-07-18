@php
    use App\Models\Pengaturan;
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MIT Conference System | @yield('location')</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/layout/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/layout/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/layout/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/layout/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/layout/dist/css/skins/_all-skins.min.css') }}">

  @stack('styles')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
    <div class="preloader">
        <div class="do-loader"></div>
    </div>
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-home"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:15px;"><b>MIT Conference</b> System </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                <span class="hidden-xs">
                  @if (Auth::check())
                    {{ Auth::user()->full_name }}
                @endif
                </span>
            </a>

          </li>
          <!-- Control Sidebar Toggle Button -->
          <li style="background:#dc3545;">
            {{-- <a data-toggle="control-sidebar" href="{{ route('anggota.logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i>&nbsp; {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('anggota.logout') }}" method="POST" style="display: none;">
                @csrf
            </form> --}}
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image" style="margin-top:6px;">
          <img src="{{ asset('assets/images/logo.png') }}" style="height:auto;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
                @yield('halaman')
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i>  @yield('user-login')</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @yield('sidebar-menu')

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @php
            $setting = Pengaturan::where('id',1)->first();
        @endphp
        {{ $setting->nama_app }}
        <small>{{ $setting->keterangan_app }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> {{ $setting->nama_app }}</a></li>
        <li class="active">@yield('location2')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer ">
    <div class="pull-right hidden-xs">
      <a href="" target="_blank"><b>MIT Conference System</b></a>
    </div>
    <strong>Copyright &copy; 2022 <a href="">MIT Conference System</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('assets/layout/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/layout/validator/validator.min.js') }}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/layout/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/layout/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/layout/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/layout/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/layout/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script src="{{ asset('assets/layout/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

</script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
        toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-bottom-left","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
        toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-bottom-left","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
        toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-bottom-left","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
        toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-bottom-left","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif

    $(window).on('load', function(){
        // will first fade out the loading animation
        jQuery(".status").fadeOut();
        // will fade out the whole DIV that covers the website.
        jQuery(".preloader").delay(0).fadeOut("slow");
    });
</script>
@stack('scripts')
</body>
</html>

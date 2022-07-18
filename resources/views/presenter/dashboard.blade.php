@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->username }}
    @endif
@endsection
@section('halaman')
    Presenter
@endsection
@section('content-title')
    Dashboard
    <small>{{ $setting->nama_app }}</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> {{ $setting->nama_app }}</a></li>
    <li class="active">Dashboard</li>
@endsection
@section('sidebar-menu')
    @include('presenter/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->full_name }} </span>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" class="btn btn-danger"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
    <style>
        #chartdiv {
            width: 90%;
            height: 500px;
        }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@section('content')
    <div class="callout callout-info">
        <h4>Welcome, <b>{{ Auth::user()->full_name }}</b></h4>

        <p>
            {{ $setting->keterangan_app }}
            <br>
            <i><b>Note</b>: For security, don't forget to logout after using the app</i>
        </p>
    </div>
    <div class="row">
        <div class="col-md-4 sm-6">
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user"></i>&nbsp;User Profile</h3>
                </div>
                <div class="box-body box-profile">
                    @if (Auth::user()->photo == null)
                        <img class="profile-user-img img-responsive img-circle" src="https://cdn-icons-png.flaticon.com/128/1177/1177568.png" alt="User profile picture">
                    @else
                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('upload/profilePhoto/'.Auth::user()->photo) }}" alt="User profile picture">
                    @endif
                    <h3 class="profile-username text-center">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <b>Username</b> <a class="pull-right">{{ Auth::user()->username }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                        <b>Status User</b> <a class="pull-right">
                            @if (Auth::user()->isActive == 1)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </a>
                        </li>
                    </ul>
                    {{-- <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-key"></i>&nbsp;Ubah Password
                    </button> --}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Password
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="" method="POST">
                                {{ csrf_field() }} {{ method_field("PATCH") }}
                                <div class="form-group col-md-12">
                                    <label for="">Masukan Password Baru</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                    <button type="button" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Simpan Perubahan</button>
                    </div>
                </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 sm-6">
            <div class="box box-primary">

                <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-info-circle"></i>&nbsp;User Information</h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $abstrak }}</h3>

                                <p>Abstract</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-green">
                                <div class="inner">
                                <h3><sup style="font-size: 20px"></sup> 0 </h3>

                                <p>Kelas Diambil</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3> 19 </h3>

                                <p>Membuat Forum</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3> 12 </h3>

                                <p>Kelas Selesai</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                responsive : true,
            });
        } );
    </script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>

    am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();
    // Add data
    @yield('chart_data')
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;
    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;
    series.tooltip.pointerOrientation = "vertical";
    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;
    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;
    series.columns.template.adapter.add("fill", function(fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
    });
    // Cursor
    chart.cursor = new am4charts.XYCursor();
    }); // end am4core.ready()
    </script>
@endpush

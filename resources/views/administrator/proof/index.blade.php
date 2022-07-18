@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;Abstract Verification
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->username }}
    @endif
@endsection
@section('halaman')
    Administrator
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
    @include('administrator/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
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
@push('styles')
<style>
    #chartdiv, #chartdiv2, #chartdiv3, #chartdiv4 {
      width: 100%;
      height: 350px;
    }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-pie-chart"></i>&nbsp;Payment Status Statistics (Pie Chart)
            </h3>
            </div>
            <div class="box-body">
                @section('charts')
                    chart.data = [
                        @foreach ($subyek as $data)
                            {
                                    "country": "{{ $data['status_payment'] }}",
                                "litres": {{ $data['jumlah'] }}
                            },
                        @endforeach
                    ];
                @endsection
                <div id="chartdiv"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-bar-chart"></i>&nbsp;Payment Statistics By User Type (Bar Chart)
            </div>
            <div class="box-body">
                @section('charts2')
                    chart.data = [
                        @foreach ($subyek2 as $data)
                            {
                                    "country": "{{ $data['access'] }}",
                                "visits": {{ $data['jumlah'] }}
                            },
                        @endforeach
                    ];
                @endsection
                <div id="chartdiv2"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-check"></i>&nbsp;Payment Amount</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped table-hover" style="width:100%;">
                            <tr>
                                <th style="text-align:center">Number Of User</th>
                                <th style="text-align:center">Payment Amount</th>
                                <th style="text-align:center">Total</th>
                            </tr>
                            <tr>
                                <td style="text-align:center">Participant : {{ $par }}</td>
                                <td style="text-align:center">Rp. {{ number_format($setting->biaya_participant) }}.00</td>
                                <td style="text-align:center">Rp. {{ number_format($par * $setting->biaya_participant) }}.00</td>
                            </tr>
                            <tr>
                                <td style="text-align:center">Presenter : {{ $pre }}</td>
                                <td style="text-align:center">Rp. {{ number_format($setting->biaya_presenter) }}.00</td>
                                <td style="text-align:center">Rp. {{ number_format($pre * $setting->biaya_presenter) }}.00</td>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align:center">
                                    Total
                                </th>
                                <th style="text-align:center">
                                    Rp. {{ number_format(($pre * $setting->biaya_presenter) + $par * $setting->biaya_participant) }}.00
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;All Payment Proof List</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Berhasil :</strong>{{ $message }}
                            </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong>{{ $message }}
                                </div>
                                @else
                        @endif
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-striped" id="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Name</th>
                                    <th>User Registered As</th>
                                    <th style="text-align:center">Payment File</th>
                                    <th style="text-align:center">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($abstraks as $abstrak)
                                    <tr>
                                        <td> {{ $no++ }} </td>
                                        <td>{{ $abstrak->full_name }}</td>
                                        <td style="text-transform:capitalize;">{{ $abstrak->access }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ asset('upload/proof_of_payment/'.$abstrak->proof_of_payment) }}" download="{{ $abstrak->proof_of_payment }}"><i class="fa fa-download"></i>&nbsp; Download</a>
                                        </td>
                                        <td class="text-center">
                                            @if ($abstrak->status_payment == "dikirim")
                                                <small class="label label-warning">Waiting for verification</small>
                                            @elseif ($abstrak->status_payment == "disetujui")
                                                <small class="label label-success">Approved</small>
                                            @elseif ($abstrak->status_payment == "pending")
                                                <small class="label label-info">Pending</small>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- Resources -->
<script src="{{ asset('assets/offline/core.js') }}"></script>
<script src="{{ asset('assets/offline/chart.js') }}"></script>
<script src="{{ asset('assets/offline/animated.js') }}"></script>

<!-- Chart code -->

<script>
    $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );
    am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    // Add data
    @yield('charts')
    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;
    }); // end am4core.ready()
</script>




<!-- Resources -->
<script src="{{ asset('assets/offline/cdn/core.js') }}"></script>
<script src="{{ asset('assets/offline/cdn/charts.js') }}"></script>
<script src="{{ asset('assets/offline/cdn/animated.js') }}"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end
// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart);
// Add data
@yield('charts2')
// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
if (target.dataItem && target.dataItem.index & 2 == 2) {
return dy + 25;
}
return dy;
});
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.name = "Visits";
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;
var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
}); // end am4core.ready()
</script>


@endpush

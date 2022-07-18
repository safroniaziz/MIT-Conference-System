@extends('layouts.layout')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;Manajemen Abstrak
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
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Abstract Data Management</h3>
                <div class="pull-right">
                    <a href="{{ route('presenter.abstrak.add') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Create New Abstract</a>
                </div>
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
                        <table class="table table-striped table-bordered" id="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Abstract Title</th>
                                    <th>Abstract Text</th>
                                    <th style="text-align:center">Abstract File</th>
                                    <th style="text-align:center">Abstract Status</th>
                                    <th style="text-align:center">Send Abstract</th>
                                    <th style="text-align:center">Proof Of Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($abstraks as $abstrak)
                                    <tr>
                                        <td> {{ $no++ }} </td>
                                        <td style="width:25%">
                                            {!! $abstrak->shortJudul !!}
                                            <a href="{{ route('presenter.abstrak.detail',[$abstrak->id]) }}" id="selengkapnya">read more</a>
                                            <br>
                                            <hr style="margin-bottom:5px !important; margin-top:5px !important;">
                                            <small style="font-size:10px !important; text-transform:capitalize;" class="label label-primary">{{ $abstrak->tahun_usulan }}</small>
                                            <small style="font-size:10px !important;" class="label label-success">{{ $abstrak->created_at ? $abstrak->created_at->diffForHumans() : '-' }}</small>
                                            <small style="font-size:10px !important;" class="label label-info">{{ \Carbon\Carbon::parse($abstrak->created_at)->format('j F Y H:i') }}</small> <br>
                                        </td>
                                        <td style="width:25%">
                                            {!! $abstrak->shortAbstrak !!}
                                            <a href="{{ route('presenter.abstrak.detail',[$abstrak->id]) }}" id="selengkapnya">read more</a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ asset('upload/file_abstrak/'.$abstrak->file_abstrak) }}" download="{{ $abstrak->file_abstrak }}"><i class="fa fa-download"></i>&nbsp; Download</a>
                                        </td>
                                        <td style="text-align:center">
                                            @if ($abstrak->status == 'pending')
                                                <small class="label label-warning" style="color:white;"><i class="fa fa-clock-o" style="padding:5px;"></i>&nbsp;Pending</small>
                                                @elseif($abstrak->status == "diteruskan")
                                                <small class="label label-info" style="color:white;"><i class="fa fa-info-circle" style="padding:5px;"></i>&nbsp;Sent</small>
                                                @elseif($abstrak->status == "disetujui")
                                                <small class="label label-success" style="color:white;"><i class="fa fa-clock-o" style="padding:5px;"></i>&nbsp;Approved</small>
                                                @elseif($abstrak->status == "ditolak")
                                                <small class="label label-danger" style="color:white;"><i class="fa fa-close" style="padding:5px;"></i>&nbsp;Rejected</small>
                                            @endif
                                        </td>
                                        <td style="text-align:center">
                                            @if ($abstrak->status == "pending" && $abstrak->status_file == "pending")
                                                <form action="{{ route('presenter.abstrak.usulkan',[$abstrak->id])}}" method="POST">
                                                    {{ csrf_field() }} {{ method_field('PATCH') }}
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-arrow-right"></i>&nbsp; Submit abstract</button>
                                                </form>
                                                @else
                                                <small class="label label-success">
                                                    <i class="fa fa-check-circle"></i>&nbsp; Sent
                                                </small>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($abstrak->proof_of_payment != null || $abstrak->proof_of_payment != "")
                                                <small class="text-success"><i class="fa fa-check-circle"></i>&nbsp;Uploaded</small> <br>
                                                <small>
                                                    <a  href="{{ asset('upload/proof_of_payment/'.$abstrak->proof_of_payment) }}" download="{{ $abstrak->proof_of_payment }}"><i class="fa fa-download"></i>&nbsp; Download</a>
                                                </small>

                                            @else
                                                @if ($abstrak->status_payment == "disetujui")
                                                    <a onclick="kirimBukti({{ $abstrak->id }})" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i>&nbsp; Send</a>
                                                    @elseif ($abstrak->status_payment == "pending")
                                                    <a onclick="kirimBukti({{ $abstrak->id }})" class="btn btn-warning btn-sm"><i class="fa fa-clock-o"></i>&nbsp; Pending</a>
                                                    <label class="label label-danger" for="">-</label>
                                                @endif
                                            @endif
                                        </td>
                                        <td style="text-align:center">
                                            @if ($abstrak->status != "pending")
                                                <button class="btn btn-primary btn-sm" disabled style="color:white; cursor:not-allowed;"><i class="fa fa-edit"></i>&nbsp; Edit</button>
                                                <button class="btn btn-danger btn-sm" disabled style="color:white; cursor:not-allowed;"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                                                @else
                                                <a href="{{ route('presenter.abstrak.edit',[$abstrak->id]) }}" class="btn btn-primary btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-edit"></i>&nbsp; Edit</a>
                                                <a onclick="hapusAbstrak({{ $abstrak->id }})" class="btn btn-danger btn-sm" style="color:white; cursor:pointer;"><i class="fa fa-trash"></i>&nbsp; Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         <!-- Modal Kirim Bukti-->
                        <div class="modal fade modal-secondary" id="modalKirimBukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('presenter.abstrak.bukti_pembayaran') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }} {{ method_field('PATCH') }}
                                        <div class="modal-header">
                                            <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-trash"></i>&nbsp;Confirmation Form To Delete
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </p>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input type="hidden" name="id_kirim" id="id_kirim">
                                                    <label for="">Upload Proof Of Payment</label>
                                                    <input type="file" name="proof_of_payment" class="form-control">
                                                    <div>
                                                        @if ($errors->has('proof_of_payment'))
                                                            <small class="form-text text-danger">{{ $errors->first('proof_of_payment') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Kirim Bukti</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- Modal Hapus-->
            <div class="modal fade modal-danger" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action=" {{ route('presenter.abstrak.delete') }} " method="POST">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <div class="modal-header">
                                <p style="font-size:15px; font-weight:bold;" class="modal-title"><i class="fa fa-trash"></i>&nbsp;Confirmation Form To Delete</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" id="id_hapus">
                                        Apakah anda yakin ingin menghapus data abstak?
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="border: 1px solid #fff;background: transparent;color: #fff;" class="btn btn-sm btn-outline pull-left" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp; Batalkan</button>
                                <button type="submit" style="border: 1px solid #fff;background: transparent;color: #fff;" class="btn btn-sm btn-outline"><i class="fa fa-check-circle"></i>&nbsp; Ya, Hapus Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive : true,
            });
        } );

        function hapusAbstrak(id){
            $('#modaldelete').modal('show');
            $('#id_hapus').val(id);
        }

        $(document).on('change','#visibility',function(){
            var visibility = $(this).val();
            // alert(visibility);
            // alert(visibility);
            var div = $(this).parent().parent();

            var op=" ";
            $.ajax({
            type :'get',
            url: "{{ url('teacher/topics/update_visibility') }}",
            data:{'visibility':visibility},
                success:function(data){

                },
                    error:function(){
                }
            });
        });

        function kirimBukti(id){
            $('#modalKirimBukti').modal('show');
            $('#id_kirim').val(id);
        }

        @if($errors->any())
            $('#modalKirimBukti').modal('show');
        @endif
    </script>
@endpush

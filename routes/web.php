<?php

use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Member\AbstrakController;
use App\Http\Controllers\Member\PaperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'  => 'member'],function(){
    Route::get('/dashboard',[MemberDashboardController::class, 'dashboard'])->name('member.dashboard');
    Route::group(['prefix' => 'abstrak'], function(){
        Route::get('/',[AbstrakController::class, 'index'])->name('member.abstrak');
        Route::get('/{id}/detail',[AbstrakController::class, 'detail'])->name('member.abstrak.detail');
        Route::get('/tambah',[AbstrakController::class, 'add'])->name('member.abstrak.add');
        Route::post('/',[AbstrakController::class, 'post'])->name('member.abstrak.post');
        Route::patch('/{id}/usulkan',[AbstrakController::class, 'usulkan'])->name('member.abstrak.usulkan');
        Route::get('/{id}/edit',[AbstrakController::class, 'edit'])->name('member.abstrak.edit');
        Route::patch('/{id}/update',[AbstrakController::class, 'update'])->name('member.abstrak.update');
        Route::delete('/delete',[AbstrakController::class, 'delete'])->name('member.abstrak.delete');
        Route::patch('/bukti_pembayaran',[AbstrakController::class, 'buktiPembayaran'])->name('member.abstrak.bukti_pembayaran');
    });

    Route::group(['prefix' => 'paper'], function(){
        Route::get('/',[PaperController::class, 'index'])->name('member.paper');
        Route::patch('/{id}/upload_paper',[PaperController::class, 'uploadPaper'])->name('member.paper.paper.upload');
        Route::patch('/{id}/ubah_upload_paper',[PaperController::class, 'ubahUploadPaper'])->name('member.paper.paper.ubahupload');

    });
});

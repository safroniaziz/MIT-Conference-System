<?php

use App\Http\Controllers\Administrator\AdministratorDashboardController;
use App\Http\Controllers\Administrator\SettingsController;
use App\Http\Controllers\Participant\ParticipantDashboardController;
use App\Http\Controllers\Presenter\PresenterDashboardController;
use App\Http\Controllers\Presenter\AbstrakController;
use App\Http\Controllers\Presenter\PaperController;
use App\Http\Controllers\RegisterController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::post('/sign_up',[RegisterController::class, 'daftar'])->name('daftar');

Route::group(['prefix'  => 'administrator'],function(){
    Route::get('/dashboard',[AdministratorDashboardController::class, 'dashboard'])->name('administrator.dashboard');

    Route::group(['prefix' => '/settings'], function(){
        Route::get('/',[SettingsController::class, 'index'])->name('administrator.settings');
    });
});

Route::group(['prefix'  => 'participant'],function(){
    Route::get('/dashboard',[ParticipantDashboardController::class, 'dashboard'])->name('participant.dashboard');
    Route::get('/payment',[ParticipantDashboardController::class, 'payment'])->name('participant.payment');
    Route::get('/id_card',[ParticipantDashboardController::class, 'dashboard'])->name('participant.id_card');
});

Route::group(['prefix'  => 'presenter'],function(){
    Route::get('/dashboard',[PresenterDashboardController::class, 'dashboard'])->name('presenter.dashboard');
    Route::group(['prefix' => 'abstrak'], function(){
        Route::get('/',[AbstrakController::class, 'index'])->name('presenter.abstrak');
        Route::get('/{id}/detail',[AbstrakController::class, 'detail'])->name('presenter.abstrak.detail');
        Route::get('/tambah',[AbstrakController::class, 'add'])->name('presenter.abstrak.add');
        Route::post('/',[AbstrakController::class, 'post'])->name('presenter.abstrak.post');
        Route::patch('/{id}/usulkan',[AbstrakController::class, 'usulkan'])->name('presenter.abstrak.usulkan');
        Route::get('/{id}/edit',[AbstrakController::class, 'edit'])->name('presenter.abstrak.edit');
        Route::patch('/{id}/update',[AbstrakController::class, 'update'])->name('presenter.abstrak.update');
        Route::delete('/delete',[AbstrakController::class, 'delete'])->name('presenter.abstrak.delete');
        Route::patch('/bukti_pembayaran',[AbstrakController::class, 'buktiPembayaran'])->name('presenter.abstrak.bukti_pembayaran');
    });

    Route::group(['prefix' => 'paper'], function(){
        Route::get('/',[PaperController::class, 'index'])->name('presenter.paper');
        Route::post('/{abstrak_id}/upload_paper',[PaperController::class, 'uploadPaper'])->name('presenter.paper.paper.upload');
        Route::patch('/{abstrak_id}/ubah_upload_paper',[PaperController::class, 'ubahUploadPaper'])->name('presenter.paper.paper.ubahupload');
        Route::patch('/{abstrak_id}/upload_presentasi',[PaperController::class, 'uploadPresentasi'])->name('presenter.paper.presentasi.upload');
        Route::patch('/{abstrak_id}/ubah_upload_presentasi',[PaperController::class, 'ubahUploadPresentasi'])->name('presenter.paper.presentasi.ubahupload');
        Route::patch('/{abstrak_id}/change_status',[PaperController::class, 'changeStatus'])->name('presenter.paper.presentasi.change_status');

    });
});

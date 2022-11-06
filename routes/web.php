<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agama53Controller;
use App\Http\Controllers\User53Controller;
use App\Http\Controllers\Detail_data53Controller;
use Illuminate\Support\Facades\Auth;

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

    if (Auth::check()) {
        $role = Auth::user()->role;
    } else {
        $role = null;
    }

    return view('dashboard', [
        'role' => $role
    ]);
})->name('index53');

Route::middleware(['auth', 'hakakses:role'])->group(function () {

    // User
    Route::get('/users53', [User53Controller::class, 'users53'])->name('users53');
    Route::get('/detailUser53/{id}', [User53Controller::class, 'detailUser53'])->name('detailUser53');
    Route::get('/profile53', [User53Controller::class, 'profile53'])->name('profile53');


    Route::get('/updatePassword53', [User53Controller::class, 'updatePassword53'])->name('updatePassword53');
    Route::post('/updatePasswordProses53/{id}', [User53Controller::class, 'updatePasswordProses53'])->name('updatePasswordProses53');


    Route::get('/register53', [User53Controller::class, 'register53'])->name('register53');
    Route::post('/registerProses53', [User53Controller::class, 'registerProses53'])->name('registerProses53');

    Route::get('/logout53', [User53Controller::class, 'logout53'])->name('logout53');

    // Detail data
    Route::get('/detailData53', [Detail_data53Controller::class, 'detailData53'])->name('detailData53');

    Route::get('/createData53', [Detail_data53Controller::class, 'createData53'])->name('createData53');
    Route::post('/createDataProses53', [Detail_data53Controller::class, 'createDataProses53'])->name('createDataProses53');

    Route::get('/updateData53', [Detail_data53Controller::class, 'updateData53'])->name('updateData53');
    Route::post('/updateDataProses53', [Detail_data53Controller::class, 'updateDataProses53'])->name('updateDataProses53');
});

Route::middleware(['auth', 'hakadmin:role'])->group(function () {
    // agama
    Route::get('/agama53', [Agama53Controller::class, 'agama53'])->name('agama53');

    Route::get('/createAgama53', [Agama53Controller::class, 'createAgama53'])->name('createAgama53');
    Route::post('/createAgama53Proses', [Agama53Controller::class, 'createAgama53Proses'])->name('createAgama53Proses');

    Route::get('/deleteAgama53Proses/{id}', [Agama53Controller::class, 'deleteAgama53Proses'])->name('deleteAgama53Proses');

    Route::get('/updateAgama53/{id}', [Agama53Controller::class, 'updateAgama53'])->name('updateAgama53');
    Route::post('/updateAgama53Proses/{id}', [Agama53Controller::class, 'updateAgama53Proses'])->name('updateAgama53Proses');

    // user
    Route::get('/deleteUser53/{id}', [User53Controller::class, 'deleteUser53'])->name('deleteUser53');
    Route::get('/approveUser53/{id}', [User53Controller::class, 'approveUser53'])->name('approveUser53');
});

Route::get('/login53', [User53Controller::class, 'login53'])->name('login53');
Route::post('/loginProses53', [User53Controller::class, 'loginProses53'])->name('loginProses53');

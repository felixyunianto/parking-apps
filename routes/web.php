<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\RateController;

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

// Route::get('/', function () {
//     return view('layouts.app');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// User

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/tambah', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
Route::put("/user/status/{id}", [App\Http\Controllers\UserController::class, 'changeStatus'])->name('user.status');



//Parking
Route::get('/parking', [ParkingController::class, "index"])->name('parking');

//Rate
Route::get('/rate', [RateController::class, "index"])->name('rate');
Route::get('/rate/tambah', [RateController::class, "create"])->name('rate.create');
Route::post('/rate/store', [RateController::class, "store"])->name('rate.store');
Route::get('/rate/edit/{id}', [RateController::class, "edit"])->name('rate.edit');
Route::put('/rate/update/{id}', [RateController::class, "update"])->name('rate.update');
Route::delete('/rate/delete/{id}', [RateController::class, "destroy"])->name('rate.destroy');
Route::put("/rate/status/{id}", [RateController::class, 'changeStatus'])->name('rate.status');

Route::get("/test-pdf", function(){
    // dd(env('WKHTML_PDF_BINARY'));
    $pdf = \PDF::loadHTML('<h1>Test</h1>');
    // dd($pdf);
    
    return $pdf->download('invoice.pdf');
});
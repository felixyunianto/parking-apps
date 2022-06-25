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
Route::get('/parking/tambah', [ParkingController::class, "create"])->name('parking.create');
Route::get('/parking/{id}', [ParkingController::class, "show"])->name('parking.show');
Route::post('/parking/store', [ParkingController::class, "store"])->name('parking.store');
Route::get('/parking/barcode/{id}', [ParkingController::class, "printReceipt"])->name('parking.print');

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
    $parking = \App\Models\Parking::findOrFail(1);

    // $duration = $parking->clockout != null ? round(abs(strtotime($parking->clockout) - strtotime($parking->clockin)) / 60, 2) : 0;

    // if($duration <= 720){
    //     dd("3000");
    // }else{
    //     if($duration <= 1440 && $duration >= 720){
    //         dd("5000");
    //     }else{
    //         $clockin = new \Carbon\Carbon($parking->clockin);
    //     $clockout = new \Carbon\Carbon($parking->clockout);
    //         $diff = \Carbon\Carbon::parse($clockin)->diffInDays($clockout);
    //         dd($diff * (int) "5000");
    //     }
    // }

    $pdf = \PDF::loadView('barcode.index', compact('parking'))
    ->setOptions([
        'page-width' =>  '58',
        'page-height' => '85',
        'margin-left' => 0,
        'margin-right' => 0,
        'margin-top' => 3,
        'margin-bottom' => 0
    ]);
    // dd($pdf);
    
    return $pdf->stream('invoice.pdf');
});
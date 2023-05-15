<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StripePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'student'], function () {
    // Route::get('/', [StudentController::class, 'index']);
    Route::get('/list', [StudentController::class, 'getStudents'])->name('students.list');
    Route::get('/edit', [StudentController::class, 'editStudents'])->name('students.edit');
    Route::get('/delete{id}', [StudentController::class, 'deleteStudents'])->name('students.delete');
    
    Route::group(['prefix' => 'payment'], function () {
        Route::controller(StripePaymentController::class)->group(function(){
            Route::get('stripe', 'stripe')->name('stripe.payment');
            Route::post('payments', 'stripePost')->name('stripe.post');
        });
    });

    Route::get('/email', [StudentController::class,'email'])->name('email');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

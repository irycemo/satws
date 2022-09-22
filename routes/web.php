<?php

use App\Http\Livewire\PagoSatFinanzas;
use App\Http\Livewire\PagoSatIrycem;
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

Route::get('pagos_sat_irycem', PagoSatIrycem::class)->name('pago_sat_irycem');

Route::get('pagos_sat_finanzas', PagoSatFinanzas::class)->name('pago_sat_finanzas');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

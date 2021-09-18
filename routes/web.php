<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/image', [HomeController::class, 'image'])->name('image');
Route::get('/document', [HomeController::class, 'document'])->name('document');
Route::post('/send', [HomeController::class, 'send'])->name('send');
Route::post('/send-image', [HomeController::class, 'send_image'])->name('send-image');
Route::post('/send-document', [HomeController::class, 'send_document'])->name('send-document');
Route::get('/api/receive', [HomeController::class, 'receive_get'])->name('receive_get');
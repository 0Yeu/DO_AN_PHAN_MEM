<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;

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
    return (new LoginController)->index();
});

Route::post('/store', function (Illuminate\Http\Request $request) {
    return (new LoginController)->store($request);
});

Route::get('/admin', function () {
    return (new MainController)->index();
})->name('admin');


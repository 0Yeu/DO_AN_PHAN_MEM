<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckQuyen;

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
    return (new \App\Http\Controllers\Home\HomePageController())->index();
})->name('home');


Route::get('/DangKyUngHo', function () {
    return (new LoginController)->DangKyUngHo();
})->name('DangKyUngHo');
Route::post('/GuiUngHo', function (Illuminate\Http\Request $request) {
    return (new LoginController)->GuiUngHo($request);
});
Route::get('/danhsachungho', function () {
    return (new LoginController)->DanhSachUngHo();
});
// Các route chỉ được truy cập bởi user có quyền 1 hoặc 2
Route::get('/chitietungho', function (Illuminate\Http\Request $request) {
    return (new LoginController)->ChiTietUngHo($request);
});


Route::get('/login', function () {
    return (new LoginController)->index();
})->name('login');
Route::get('/register', function () {
    return (new LoginController)->show();
})->name('register');

Route::post('/store', function (Illuminate\Http\Request $request) {
    return (new LoginController)->store($request);
});
Route::post('/create', function (Illuminate\Http\Request $request) {
    return (new LoginController)->create($request);
});

Route::middleware(['auth','CheckQuyen:1'])->group(function(){

    Route::prefix('admin')-> group(function (){
        Route::get('/', function () {
            return (new MainController)->index();
        })->name('admin');

        Route::prefix('menu')->group(function (){
            Route::get('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'create']);
            Route::post('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'store']);
            Route::get('listDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'index'])->name('listDanhMuc');
            Route::get('destroy',[\App\Http\Controllers\Admin\MenuController::class,'destroy']);
            Route::get('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'show']);
            Route::post('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'edit']);
        });
        Route::prefix('DotLuLut')->group(function (){
            Route::get('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'create']);
            Route::post('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'store']);
            Route::get('listDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'index'])->name('listDanhMuc');
            Route::get('destroy',[\App\Http\Controllers\Admin\MenuController::class,'destroy']);
            Route::get('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'show']);
            Route::post('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'edit']);
        });
        Route::prefix('hanghoa')->group(function (){
//            Route::get('/',[\App\Http\Controllers\Admin\HangHoaController::class,'index'])->name('listhanghoa');
            Route::get('addDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'create']);
            Route::post('addDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'store']);
            Route::get('listDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'index'])->name('listhanghoa');
            Route::get('destroy',[\App\Http\Controllers\Admin\HangHoaController::class,'destroy']);
            Route::get('editDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'show']);
            Route::post('editDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'edit']);
            Route::get('filterDanhMuc',[\App\Http\Controllers\Admin\HangHoaController::class,'filterDanhMuc']);


        });
        Route::prefix('taoBaiDang')->group(function (){
            Route::get('/',[\App\Http\Controllers\Admin\BaiDangController::class,'create']);
            Route::post('/', function (Illuminate\Http\Request $request) {
                return (new \App\Http\Controllers\Admin\BaiDangController())->store($request);
            });
            Route::get('/edt',[\App\Http\Controllers\Admin\BaiDangController::class,'show']);
            Route::post('/edt',[\App\Http\Controllers\Admin\BaiDangController::class,'edit']);
            Route::get('/del', [\App\Http\Controllers\Admin\BaiDangController::class, 'destroy']);

        });

    });
});

Route::middleware(['auth', 'CheckQuyen:2'])->group(function (){
    // Các route chỉ được truy cập bởi user có quyền 2
    Route::prefix('user')-> group(function () {
        Route::get('/', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user');
    });
});

Route::middleware(['auth', 'CheckQuyen:1,2'])->group(function (){
});

Route::middleware(['auth', 'CheckQuyen:1,2,3'])->group(function (){
    // Các route chỉ được truy cập bởi user có quyền 1, 2 hoặc 3
    Route::get('logout',[\App\Http\Controllers\Admin\Users\LoginController::class,'logout']);
});

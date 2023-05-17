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
Route::any('/chitietungho', function (Illuminate\Http\Request $request) {
    return (new LoginController)->ChiTietUngHo($request);
})->name('chitietungho');

Route::get('/danhsachunghotien', function () {
    return (new LoginController)->DanhSachUngHoTien();
});
// Các route chỉ được truy cập bởi user có quyền 1 hoặc 2
Route::any('/chitietunghotien', function (Illuminate\Http\Request $request) {
    return (new LoginController)->ChiTietUngHoTien($request);
})->name('chitietunghotien');


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
//        Route::prefix('DotLuLut')->group(function (){
//            Route::get('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'create']);
//            Route::post('addDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'store']);
//            Route::get('listDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'index'])->name('listDanhMuc');
//            Route::get('destroy',[\App\Http\Controllers\Admin\MenuController::class,'destroy']);
//            Route::get('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'show']);
//            Route::post('editDanhMuc',[\App\Http\Controllers\Admin\MenuController::class,'edit']);
//        });
        Route::prefix('dotlulut')->group(function (){
            Route::get('addDotLuLut',[\App\Http\Controllers\Admin\DotLuLutController::class,'create']);
            Route::post('addDotLuLut',[\App\Http\Controllers\Admin\DotLuLutController::class,'store']);
            Route::get('listDotLuLut',[\App\Http\Controllers\Admin\DotLuLutController::class,'index'])->name('listDotLuLut');
            Route::get('destroy',[\App\Http\Controllers\Admin\DotLuLutController::class,'destroy']);
            Route::get('editDanhMuc',[\App\Http\Controllers\Admin\DotLuLutController::class,'show']);
            Route::post('editDanhMuc',[\App\Http\Controllers\Admin\DotLuLutController::class,'edit']);
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

        Route::prefix('mucDoThietHai')->group(function (){
            Route::get('addMucDoThietHai',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'create']);
            Route::post('addMucDoThietHai',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'store']);
            Route::get('listMucDoThietHai',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'index'])->name('listMucDoThietHai');
            Route::get('destroy',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'destroy']);
            Route::get('editMucDoThietHai',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'show']);
            Route::post('editMucDoThietHai',[\App\Http\Controllers\Admin\MucDoThietHaiController::class,'edit']);
        });
        Route::prefix('hoGiaDinh')->group(function (){
            Route::get('addHoGiaDinh',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'create']);
            Route::post('addHoGiaDinh',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'store']);
            Route::get('listHoGiaDinh',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'index'])->name('listHoGiaDinh');
            Route::get('destroy',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'destroy']);
            Route::get('editHoGiaDinh',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'show']);
            Route::post('editHoGiaDinh',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'edit']);
            Route::get('filterHGD',[\App\Http\Controllers\Admin\HoGiaDinhController::class,'filterHoGiaDinh']);


        });
        Route::prefix('loaiHoGD')->group(function (){
            Route::get('addLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'create']);
            Route::post('addLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'store']);
            Route::get('listLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'index'])->name('listLoaiHoGD');
            Route::get('destroy',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'destroy']);
            Route::get('editLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'show']);
            Route::post('editLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'edit']);
        });
        Route::prefix('phanQuyen')->group(function (){
            Route::get('addLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'create']);
            Route::post('addLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'store']);
            Route::get('list',[\App\Http\Controllers\Admin\PhanQuyenController::class,'index'])->name('listLoaiHoGD');
            Route::get('destroy',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'destroy']);
            Route::get('editLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'show']);
            Route::post('editLoaiHoGD',[\App\Http\Controllers\Admin\LoaiHoGDController::class,'edit']);

            // Route definition
            Route::post('validate-password', [App\Http\Controllers\Admin\PhanQuyenController::class,'validatePassword']);
            Route::post('update-IdQuyen', [App\Http\Controllers\Admin\PhanQuyenController::class,'updateIdQuyen']);
            Route::get('/search', [App\Http\Controllers\Admin\PhanQuyenController::class,'search']);


// UserController.php

        });
        Route::prefix('PhanBo')->group(function (){
            Route::get('/', function () {
                return (new \App\Http\Controllers\Admin\PhanBoController())->duKien();
            });
            Route::get('/thongKe', function () {
                return (new \App\Http\Controllers\Admin\PhanBoController())->ThongKeTheoDuKien();
            })->name('thongkedukien');
            Route::post('/guiDuKien', function (Illuminate\Http\Request $request) {
                return (new \App\Http\Controllers\Admin\PhanBoController())->guiPhanBo($request);
            });
            Route::get('filterMDTH',[\App\Http\Controllers\Admin\PhanBoController::class,'filterMDTH']);
            Route::get('filterMDTH3',[\App\Http\Controllers\Admin\PhanBoController::class,'filterMDTH3']);
            Route::get('filterMDTHS',[\App\Http\Controllers\Admin\PhanBoController::class,'filterMDTHS']);


// UserController.php

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
});

Route::middleware(['auth', 'CheckQuyen:1,2'])->group(function (){

    Route::prefix('CTV')-> group(function () {
        Route::get('/', function () {
            return (new MainController)->indexCTV();
        })->name('CTV');
    });
    Route::post('/phe-duyet', [\App\Http\Controllers\Admin\Users\LoginController::class,'pheDuyet'])->name('phe-duyet');
    Route::post('/phe-duyet-all', [\App\Http\Controllers\Admin\Users\LoginController::class,'pheDuyetAll'])->name('phe-duyet-all');

    Route::post('/phe-duyet-tien', [\App\Http\Controllers\Admin\Users\LoginController::class,'pheDuyetTien'])->name('phe-duyet-tien');
    Route::post('/phe-duyet-tien-all', [\App\Http\Controllers\Admin\Users\LoginController::class,'pheDuyetTienAll'])->name('phe-duyet-tien-all');

    Route::get('/danhsachtokhai', function () {
        return (new \App\Http\Controllers\Admin\DuyetToKhaiController())->DanhSachToKhai();
    })->name('DanhSachToKhai');
// Các route chỉ được truy cập bởi user có quyền 1 hoặc 2
    Route::any('/chitiettokhai', function (Illuminate\Http\Request $request) {
        return (new \App\Http\Controllers\Admin\DuyetToKhaiController())->ChiTietToKhai($request);
    })->name('chitiettokhai');


    Route::get('/danhsachphanbo', function () {
        return (new \App\Http\Controllers\Admin\DuyetToKhaiController())->DanhSachPhanBo();
    })->name('danhsachphanbo');
// Các route chỉ được truy cập bởi user có quyền 1 hoặc 2
    Route::any('/chitietphanbo', function (Illuminate\Http\Request $request) {
        return (new \App\Http\Controllers\Admin\DuyetToKhaiController())->ChiTietPhanBo($request);
    })->name('chitietphanbo');

    Route::post('/pheduyettokhaiall', [\App\Http\Controllers\Admin\DuyetToKhaiController::class,'pheDuyetAll'])->name('pheduyettokhaiall');
    Route::post('/pheduyettokhai', [\App\Http\Controllers\Admin\DuyetToKhaiController::class,'pheDuyet'])->name('pheduyettokhai');

    Route::get('/filterToKhai',[\App\Http\Controllers\Admin\DuyetToKhaiController::class,'filterToKhai']);
});

Route::middleware(['auth', 'CheckQuyen:1,2,3'])->group(function () {
    // Các route chỉ được truy cập bởi user có quyền 1 hoặc 3
    Route::prefix('HoGiaDinh')->group(function () {
        Route::get('/', function () {
            return (new \App\Http\Controllers\Admin\HoGiaDinhController())->HomeHGD();
        })->name('HoGiaDinh');
        Route::get('/KhaiBaoThietHai', function () {
            return (new LoginController)->KhaiBaoThietHai();
        })->name('KhaiBaoThietHai');
        Route::post('/GuiToKhai', function (Illuminate\Http\Request $request) {
            return (new LoginController)->GuiToKhai($request);
        });
        Route::get('filterMDTH1',[\App\Http\Controllers\Admin\PhanBoController::class,'filterMDTH1']);
        Route::get('filterMDTH2',[\App\Http\Controllers\Admin\PhanBoController::class,'filterMDTH2']);
    });
});
Route::middleware(['auth', 'CheckQuyen:1,2,3,4'])->group(function () {
    // Các route chỉ được truy cập bởi user có quyền 1 hoặc 3
    Route::prefix('user')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user');
    });
    Route::get('logout', [\App\Http\Controllers\Admin\Users\LoginController::class, 'logout']);
});

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PhanQuyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dlls = DB::table('Quyen')->get();
        $menus = DB::table('NguoiDung')
            ->join('Quyen', 'Quyen.idQuyen', '=', 'NguoiDung.idQuyen')
            ->select('NguoiDung.*', 'Quyen.tenQuyen')
            ->orderBy('idNguoiDung', 'asc')
            ->paginate(10);
        return view('admin/PhanQuyen/listPhanQuyen',[
            'title'=>'Danh sách tài khoản người dùng',
            'menus'=>$menus,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $dlls = DB::table('Quyen')->get();
        $menus = DB::table('NguoiDung')
            ->join('Quyen', 'Quyen.idQuyen', '=', 'NguoiDung.idQuyen')
            ->select('NguoiDung.*', 'Quyen.tenQuyen')
            ->where('hoTen', 'like', '%' . $keyword . '%')
            ->orWhere('taiKhoan', 'like', '%' . $keyword . '%')
            ->orWhere('soDT', 'like', '%' . $keyword . '%')
            ->orWhere('idNguoiDung', 'like', '%' . $keyword . '%')
            ->orderBy('idNguoiDung', 'asc')
            ->paginate(10);
        return view('admin/PhanQuyen/tableUser',[
            'title'=>'Danh sách tài khoản người dùng',
            'menus'=>$menus,
            'dlls'=>$dlls
        ]);
    }
    public function validatePassword(Request $request)
    {
        $password = $request->input('password');
//        log($password);
        // Perform password validation logic here
        // For example, you can compare the password with the one stored in your database
        if (Hash::check($password, Auth::user()->getAuthPassword())) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 403);
        }
    }

    public function updateIdQuyen(Request $request)
    {
        $idQuyen = $request->input('idQuyen');
        $idNguoiDung = $request->input('idNguoiDung');
        // Kiểm tra idQuyen và thực hiện các bước cập nhật dữ liệu tương ứng
        $result = DB::table('NguoiDung')
            ->where('idNguoiDung', $idNguoiDung)
            ->update(['idQuyen' => $idQuyen]);

        if ($result){
            return response()->json(['success' => true]);
        }else {
//            Session::flash('error', 'Có lỗi xảy ra. Không thể cập nhật dữ liệu.');
            return response()->json(['success' => false]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Image;

class BaiDangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dlls = DB::table('DotLuLut')->get();
        return view("admin.baidang.taobaidang",[
            'title'=>'Tạo bài kêu gọi',
            'dlls'=>$dlls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $fileName = $request->file('hinhanh')->getClientOriginalName(); // lấy tên gốc của tệp
        $fileName = time() . '_' . $fileName;
        $request->file('hinhanh')->storeAs('public/images', $fileName); // lưu tệp vào thư mục public/images với tên gốc của tệp
        try {
            DB::table('BaiDang')->insert(
                [
                    'tenDotCuuTro' => $request->input('tenDotCuuTro'),
                    'idDotLuLut' => $request->input('idDotLuLut'),
                    'ngayBatDau' => $request->input('ngayBatDau'),
                    'ngayKetThuc' => $request->input('ngayKetThuc'),
                    'hinhAnh' => '../storage/images/' . $fileName,
                    'noiDung' => $request->input('ghiChu'),
                ]
            );
            Session::flash('success','Thêm bài đăng thành công');
            return redirect()->route('admin');

        }catch (\ErrorException $e){
            Session::flash('errors',$e->getMessage());
            return redirect()->route('admin');
        }
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $menu = DB::table('BaiDang')
            ->where('idBaiDang', $request->query('id'))
            ->first();
        $dlls = DB::table('DotLuLut')->get();
        return view('admin.BaiDang.suaBaiDang',[
            'title'=>'Chỉnh sửa danh mục',
            'menu'=>$menu,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $request->validate([
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->file('hinhanh')!= null){
            $fileName = $request->file('hinhanh')->getClientOriginalName(); // lấy tên gốc của tệp
            $fileName = time() . '_' . $fileName;
            $request->file('hinhanh')->storeAs('public/images', $fileName); // lưu tệp vào thư mục public/images với tên gốc của tệp
            try {
                DB::table('BaiDang')
                    ->where('idBaiDang', $request->input('idBaiDang'))
                    ->update(
                        [
                            'tenDotCuuTro' => $request->input('tenDotCuuTro'),
                            'idDotLuLut' => $request->input('idDotLuLut'),
                            'ngayBatDau' => $request->input('ngayBatDau'),
                            'ngayKetThuc' => $request->input('ngayKetThuc'),
                            'hinhAnh' => '../storage/images/' . $fileName,
                            'soTien' => $request->input('soTien'),
                            'noiDung' => $request->input('ghiChu'),
                        ]
                    );
                Session::flash('success','Chỉnh sửa bài đăng thành công');
                return redirect()->route('admin');
            }catch (\ErrorException $e){
                Session::flash('errors',$e->getMessage());
                dd($e);
                return redirect()->route('admin');
            }
        }else{
            try {
                DB::table('BaiDang')
                    ->where('idBaiDang', $request->input('idBaiDang'))
                    ->update(
                        [
                            'tenDotCuuTro' => $request->input('tenDotCuuTro'),
                            'idDotLuLut' => $request->input('idDotLuLut'),
                            'ngayBatDau' => $request->input('ngayBatDau'),
                            'ngayKetThuc' => $request->input('ngayKetThuc'),
                            'soTien' => $request->input('soTien'),
                            'noiDung' => $request->input('ghiChu'),
                        ]
                    );
                Session::flash('success','Chỉnh sửa bài đăng thành công');
                return redirect()->route('admin');
            }catch (\ErrorException $e){
                Session::flash('errors',$e->getMessage());
                dd($e);
                return redirect()->route('admin');
            }
        }

        return redirect()->route('admin');
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
    public function destroy(Request $request)
    {
        //
        $menu = DB::table('BaiDang')
            ->where('idBaiDang', $request->id)->first();
        if ($menu) {
            $result=DB::table('BaiDang')->where('idBaiDang', '=', $request->id)->delete();
        }
        if ($result) {
            Session::flash('success', 'Đã xóa');
        } else {
            Session::flash('error', 'Có lỗi xảy ra. Không thể cập nhật dữ liệu.');
        }
        return redirect()->route('admin');
    }
}

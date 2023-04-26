<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HangHoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menus = DB::table('HangCuuTro')
            ->orderBy('idHangCuuTro', 'asc')
            ->paginate(10);
        return view('admin/hanghoa/listDanhMuc',[
            'title'=>'Danh sách danh mục hàng cứu trợ',
            'menus'=>$menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $dlls = DB::table('DanhMucHangCuuTro')->get();
        return view("admin.hanghoa.addDanhMuc",[
            'title'=>'Thêm loại hàng hóa cứu trợ',
            'dlls'=>$dlls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $menus = DB::table('HangCuuTro')
            ->orderBy('idHangCuuTro', 'asc')
            ->paginate(10);
        DB::table('HangCuuTro')->insert(
            [
                'tenHangCuuTro' => $request->input('tenHangCuuTro'),
                'idDanhMuc'=>$request->input('idDanhMuc'),
                'donViTinh' => $request->input('donViTinh'),
                'soLuongCon'=>$request->input('soLuongCon'),
                'moTa' =>$request->input('moTa'),
            ]
        );
        return redirect()->route('listhanghoa',[
            'title'=>'Danh sách danh mục hàng cứu trợ',
            'menus'=>$menus
        ])->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $dlls = DB::table('DanhMucHangCuuTro')->get();
        $menu = DB::table('HangCuuTro')
            ->where('idHangCuuTro', $request->query('idHangCuuTro'))
            ->first();
        return view('admin.hanghoa.editDanhMuc',[
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
        DB::table('HangCuuTro')
            ->where('idHangCuuTro', $request->idHangCuuTro)
            ->update([
                'tenHangCuuTro' => $request->input('tenHangCuuTro'),
                'idDanhMuc'=>$request->input('idDanhMuc'),
                'donViTinh' => $request->input('donViTinh'),
                'soLuongCon'=>$request->input('soLuongCon'),
                'moTa' =>$request->input('moTa'),
            ]);
        return redirect()->route('listhanghoa')->with('success', 'Sửa thành công!');
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
        $menu = DB::table('HangCuuTro')
            ->where('idHangCuuTro', $request->query('idHangCuuTro'));

        if ($menu){
            DB::table('HangCuuTro')->where('idHangCuuTro', '=', $request->query('idHangCuuTro'))->delete();
        }
        return redirect()->route('listHangHoa');
    }
}

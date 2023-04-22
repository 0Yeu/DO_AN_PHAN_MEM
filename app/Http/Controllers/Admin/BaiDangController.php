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
        if ($request->file('hinhAnh')->getError()) {
            return response()->json(['error' => 'File upload failed'], 400);
        }

        dd($request->file('hinhAnh'));
            $image = new Image();

            $image->name = $request->file('hinhAnh')->getClientOriginalName();
            $image->path = $request->file('hinhAnh')->store('images', 'public');

            $image->save();
            dd($image->path);

        try {
            DB::table('BaiDang')->insert(
                [
                    'tenDotCuuTro' => $request->input('tenDotCuuTro'),
                    'idDotLuLut' => $request->input('idDotLuLut'),
                    'ngayBatDau' => $request->input('ngayBatDau'),
                    'ngayKetThuc' => $request->input('ngayKetThuc'),
                    'hinhAnh' => $image->path,
                    'soTien' => $request->input('soTien'),
                    'noiDung' => $request->input('ghiChu'),
                ]
            );
            return redirect()->route('admin');
            Session::flash('succes','Thêm danh mục thành công');
        }catch (\ErrorException $e){
            Session::flash('error',$e->getMessage());
            dd($e);
            return redirect()->route('admin');
        }
        return redirect()->route('admin');
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
}

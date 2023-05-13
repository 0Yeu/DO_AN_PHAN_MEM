<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCreateFormRequest;
use App\Http\Service\Menu\MenuService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DotLuLutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index()
    {
        $dlls = DB::table('DotLuLut')->get();
        $menus = DB::table('DotLuLut')
            ->orderBy('idDotLuLut', 'asc')
            ->paginate(10);
        return view('admin/dotlulut/listDotLuLut',[
            'title'=>'Danh sách lũ',
            'menus'=>$menus,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dlls = DB::table('DotLuLut')->get();
        return view("admin.DotLuLut.addDotLuLut",[
            'title'=>'Thêm Đợt lũ lụt',
            'dlls'=>$dlls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $menus = DB::table('DotLuLut')
            ->orderBy('idDotLuLut', 'asc')
            ->paginate(10);
        $result=DB::table('DotLuLut')->insert(
            [
                'tenDotLuLut' => $request->input('tenDotLuLut'),
                'thoiGian' => $request->input('thoiGian'),
            ]
        );
        if ($result) {
            Session::flash('success', 'Thêm thành công.');
        } else {
            Session::flash('error', 'Có lỗi xảy ra.');
        }
        return redirect()->route('listDotLuLut',[
            'title'=>'Danh sách đợt lũ',
            'menus'=>$menus
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $dlls = DB::table('DotLuLut')->get();
        $menu = DB::table('DotLuLut')
            ->where('idDotLuLut', $request->query('idDotLuLut'))
            ->first();
        return view('admin.dotlulut.editDanhMuc',[
            'title'=>'Chỉnh sửa đợt lũ',
            'menu'=>$menu,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $result=DB::table('DotLuLut')
            ->where('idDotLuLut', $request->idDotLuLut)
            ->update([
                'tenDotLuLut' => $request->input('tenDotLuLut'),
                'thoiGian'=>$request->input('thoiGian'),
            ]);
        if ($result) {
            Session::flash('success', 'Dữ liệu đã được cập nhật thành công.');
        } else {
            Session::flash('error', 'Có lỗi xảy ra. Không thể cập nhật dữ liệu.');
        }
        return redirect()->route('listDotLuLut');
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
        $menu = DB::table('DotLuLut')
            ->where('idDotLuLut', $request->query('idDotLuLut'));

        if ($menu){
            $result=DB::table('DotLuLut')->where('idDotLuLut', '=', $request->query('idDotLuLut'))->delete();
        }
        if ($result) {
            Session::flash('success', 'Dữ liệu đã được cập nhật thành công.');
        } else {
            Session::flash('error', 'Có lỗi xảy ra. Không thể cập nhật dữ liệu.');
        }
        return redirect()->route('listDotLuLut');
    }
}

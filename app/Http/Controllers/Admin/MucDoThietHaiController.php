<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCreateFormRequest;
use App\Http\Service\Menu\MenuService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MucDoThietHaiController extends Controller
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
        $menus = DB::table('MucDoThietHai')
            ->select('MucDoThietHai.*','DotLuLut.tenDotLuLut')
            ->join('DotLuLut', 'MucDoThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
            ->orderBy('idMucDoThietHai', 'asc')
            ->paginate(10);
        return view('admin/mucDoThietHai/listMucDoThietHai',[
            'title'=>'Danh sách mức độ thiệt hại',
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
        return view("admin.mucDoThietHai.addMucDoThietHai",[
            'title'=>'Thêm loại mức độ',
            'dlls'=>$dlls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $menus = DB::table('MucDoThietHai')
            ->orderBy('idMucDoThietHai', 'asc')
            ->paginate(10);
        DB::table('MucDoThietHai')->insert(
            [
                'idDotLuLut'=>$request->input('idDotLuLut'),
                'tenMucDo' => $request->input('tenMucDo'),
                'moTa' => $request->input('ghiChu'),
            ]
        );
        return redirect()->route('listMucDoThietHai',[
            'title'=>'Danh sách mức độ',
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
        $menu = DB::table('MucDoThietHai')
            ->where('idMucDoThietHai', $request->query('idMucDoThietHai'))
            ->first();
        return view('admin.mucDoThietHai.editMucDoThietHai',[
            'title'=>'Chỉnh sửa mức độ',
            'menu'=>$menu,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        DB::table('MucDoThietHai')
            ->where('idMucDoThietHai', $request->idMucDoThietHai)
            ->update([
                'idDotLuLut'=>$request->input('idDotLuLut'),
                'tenMucDo' => $request->input('tenMucDo'),
                'moTa'=>$request->input('ghiChu'),
            ]);
        return redirect()->route('listMucDoThietHai');
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
        $menu = DB::table('MucDoThietHai')
            ->where('idMucDoThietHai', $request->query('idMucDoThietHai'));

        if ($menu){
            DB::table('MucDoThietHai')->where('idMucDoThietHai', '=', $request->query('idMucDoThietHai'))->delete();
        }
        return redirect()->route('listMucDoThietHai');
    }
}

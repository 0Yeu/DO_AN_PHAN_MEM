<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCreateFormRequest;
use App\Http\Service\Menu\MenuService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
        //
        return view('admin/menu/listDanhMuc',[
            'title'=>'Danh sách danh mục hàng cứu trợ',
            'menus'=>$this->menuService->getTop10()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.menu.addDanhMuc",[
            'title'=>'Thêm danh mục mới'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuCreateFormRequest $request)
    {
        //
        $resuilt = $this->menuService->create($request);
        return redirect()->route('listDanhMuc',[
            'title'=>'Danh sách danh mục hàng cứu trợ',
            'menus'=>$this->menuService->getTop10()
        ])->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $menu = DB::table('DanhMucHangCuuTro')
            ->where('idDanhMuc', $request->query('idDanhMuc'))
            ->first();
        return view('admin.menu.editDanhMuc',[
            'title'=>'Chỉnh sửa danh mục',
            'menus'=>$menu,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        DB::table('DanhMucHangCuuTro')
            ->where('idDanhMuc', $request->idDanhMuc)
            ->update(['tenDanhMuc' => $request->tenDanhMuc, 'moTa' => $request->moTa ]);
        return redirect()->route('listDanhMuc')->with('success', 'Thêm thành công!');;
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
        $resuilt= $this->menuService->destroy($request);
        if ($resuilt==true){
            return redirect()->route('listDanhMuc');
        }
        return redirect()->route('listDanhMuc');
    }
}

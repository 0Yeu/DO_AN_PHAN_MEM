<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCreateFormRequest;
use App\Http\Service\Menu\MenuService;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoaiHoGDController extends Controller
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
        $dlls = DB::table('LoaiHoGD')->get();
        $menus = DB::table('LoaiHoGD')
            ->orderBy('idLoaiHoGD', 'asc')
            ->paginate(10);
        return view('admin/loaiHoGD/listLoaiHoGD',[
            'title'=>'Danh sách loại hộ gia đình',
            'menus'=>$menus,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dlls = DB::table('LoaiHoGD')->get();
        return view("admin.loaiHoGD.addLoaiHoGD",[
            'title'=>'Thêm loại hộ',
            'dlls'=>$dlls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $menus = DB::table('LoaiHoGD')
            ->orderBy('idLoaiHoGD', 'asc')
            ->paginate(10);
        DB::table('LoaiHoGD')->insert(
            [
                'LoaiHoGD' => $request->input('LoaiHoGD')
            ]
        );
        return redirect()->route('listLoaiHoGD',[
            'title'=>'Danh sách loại hộ gia đình',
            'menus'=>$menus
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $dlls = DB::table('LoaiHoGD')->get();
        $menu = DB::table('LoaiHoGD')
            ->where('idLoaiHoGD', $request->query('idLoaiHoGD'))
            ->first();
        return view('admin.loaiHoGD.editLoaiHoGD',[
            'title'=>'Chỉnh sửa loại hộ',
            'menu'=>$menu,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        DB::table('LoaiHoGD')
            ->where('idLoaiHoGD', $request->idLoaiHoGD)
            ->update([
                'LoaiHoGD' => $request->input('LoaiHoGD'),
            ]);
        return redirect()->route('listLoaiHoGD');
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
        $menu = DB::table('LoaiHoGD')
            ->where('idLoaiHoGD', $request->query('idLoaiHoGD'));

        if ($menu){
            DB::table('LoaiHoGD')->where('idLoaiHoGD', '=', $request->query('idLoaiHoGD'))->delete();
        }
        return redirect()->route('listLoaiHoGD');
    }
}

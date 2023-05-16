<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HoGiaDinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $xas=DB::table('Xa')->get();
        $dlls = DB::table('LoaiHoGD')->get();
        $menus = DB::table('HoGiaDinh')
                ->join('LoaiHoGD', 'HoGiaDinh.idLoaiHoGD', '=', 'LoaiHoGD.idLoaiHoGD')
                ->select('HoGiaDinh.idHoGiaDinh', 'HoGiaDinh.idLoaiHoGD', 'HoGiaDinh.soLuongThanhVien', 'HoGiaDinh.diaChi','LoaiHoGD.LoaiHoGD')
                ->orderBy('idHoGiaDinh', 'asc')
                ->paginate(10);
        return view('admin/hoGiaDinh/listHoGiaDinh',[
            'title'=>'Danh sách các hộ gia đình',
            'menus'=>$menus,
            'dlls'=>$dlls,
            'xas'=>$xas
       ]);

    }


    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        //
        $xas=DB::table('Xa')->get();
        $dlls = DB::table('LoaiHoGD')->get();
        return view("admin.hoGiaDinh.addHoGiaDinh",[
            'title'=>'Thêm hộ gia đình',
            'dlls'=>$dlls,
            'xas'=>$xas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $menus = DB::table('HoGiaDinh')
            ->orderBy('idHoGiaDinh', 'asc')
            ->paginate(10);
        DB::table('HoGiaDinh')->insert(
            [
                'idHoGiaDinh'=>'00000000000000',
                'idLoaiHoGD'=>$request->input('idLoaiHoGD'),
                'idXa'=>$request->input('idXa'),
                'soLuongThanhVien' => $request->input('soLuongThanhVien'),
                'diaChi'=>$request->input('diaChi'),
            ]
        );
        return redirect()->route('listHoGiaDinh',[
            'title'=>'Danh sách hộ gia đình',
            'menus'=>$menus
        ])->with('success', 'Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $xas=DB::table('Xa')->get();
        $dlls = DB::table('LoaiHoGD')->get();
        $menu = DB::table('HoGiaDinh')
            ->where('idHoGiaDinh', $request->query('idHoGiaDinh'))
            ->first();
        return view('admin.hoGiaDinh.editHoGiaDinh',[
            'title'=>'Chỉnh sửa hộ gia đình',
            'xas'=>$xas,
            'menu'=>$menu,
            'dlls'=>$dlls
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request)
    {
        //
        DB::table('HoGiaDinh')
            ->where('idHoGiaDinh', $request->idHoGiaDinh)
            ->update([
                'idXa'=>$request->input('idXa'),
                'idLoaiHoGD'=>$request->input('idLoaiHoGD'),
                'soLuongThanhVien' => $request->input('soLuongThanhVien'),
                'diaChi'=>$request->input('diaChi'),
            ]);
        return redirect()->route('listHoGiaDinh')->with('success', 'Sửa thành công!');
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
        $menu = DB::table('HoGiaDinh')
            ->where('idHoGiaDinh', $request->query('idHoGiaDinh'));

        if ($menu){
            DB::table('HoGiaDinh')->where('idHoGiaDinh', '=', $request->query('idHoGiaDinh'))->delete();
        }
        return redirect()->route('listHoGiaDinh');
    }
    public function filterHoGiaDinh(Request $request)
    {
        $idXa = $request->input('idXa');
        $idLoaiHoGD = $request->input('idLoaiHGD');
        $dlls = DB::table('LoaiHoGD')->get();
        if($idLoaiHoGD==-1 and $idXa==-1){
            $menus = DB::table('HoGiaDinh')
                ->join('LoaiHoGD', 'HoGiaDinh.idLoaiHoGD', '=', 'LoaiHoGD.idLoaiHoGD')
                ->join('Xa', 'HoGiaDinh.idXa', '=', 'Xa.idXa')
                ->select('HoGiaDinh.idHoGiaDinh', 'HoGiaDinh.idLoaiHoGD', 'HoGiaDinh.soLuongThanhVien', 'HoGiaDinh.diaChi','LoaiHoGD.LoaiHoGD','Xa.tenXa')
                ->orderBy('idHoGiaDinh', 'asc')
                ->paginate(10);
        }elseif ($idLoaiHoGD!=-1 and $idXa==-1){
            $menus = DB::table('HoGiaDinh')
                ->join('LoaiHoGD', 'HoGiaDinh.idLoaiHoGD', '=', 'LoaiHoGD.idLoaiHoGD')
                ->join('Xa', 'HoGiaDinh.idXa', '=', 'Xa.idXa')
                ->select('HoGiaDinh.idHoGiaDinh', 'HoGiaDinh.idLoaiHoGD', 'HoGiaDinh.soLuongThanhVien', 'HoGiaDinh.diaChi', 'LoaiHoGD.LoaiHoGD','Xa.tenXa')
                ->where('HoGiaDinh.idLoaiHoGD', $idLoaiHoGD)
                ->orderBy('HoGiaDinh.idHoGiaDinh', 'asc')
                ->paginate(10);
        }elseif ($idLoaiHoGD==-1 and $idXa!=-1){
            $menus = DB::table('HoGiaDinh')
                ->join('LoaiHoGD', 'HoGiaDinh.idLoaiHoGD', '=', 'LoaiHoGD.idLoaiHoGD')
                ->join('Xa', 'HoGiaDinh.idXa', '=', 'Xa.idXa')
                ->select('HoGiaDinh.idHoGiaDinh', 'HoGiaDinh.idLoaiHoGD', 'HoGiaDinh.soLuongThanhVien', 'HoGiaDinh.diaChi', 'LoaiHoGD.LoaiHoGD','Xa.tenXa')
                ->where('HoGiaDinh.idXa', $idXa)
                ->orderBy('HoGiaDinh.idHoGiaDinh', 'asc')
                ->paginate(10);
        }else{
            $menus = DB::table('HoGiaDinh')
                ->join('LoaiHoGD', 'HoGiaDinh.idLoaiHoGD', '=', 'LoaiHoGD.idLoaiHoGD')
                ->join('Xa', 'HoGiaDinh.idXa', '=', 'Xa.idXa')
                ->select('HoGiaDinh.idHoGiaDinh', 'HoGiaDinh.idLoaiHoGD', 'HoGiaDinh.soLuongThanhVien', 'HoGiaDinh.diaChi', 'LoaiHoGD.LoaiHoGD')
                ->where('HoGiaDinh.idLoaiHoGD', $idLoaiHoGD)
                ->where('HoGiaDinh.idXa', $idXa)
                ->orderBy('HoGiaDinh.idHoGiaDinh', 'asc')
                ->paginate(10);
        }


//        $idLoaiHoGD = $request->input('idLoaiHGD');
//        $dlls = DB::table('LoaiHoGD')->get();
//        $menus = DB::table('HoGiaDinh')->where('idLoaiHoGD', $idLoaiHoGD)->paginate(10);

        return
            view('admin/HoGiaDinh/tableHGD',[
                    'title'=>'Danh sách loại hộ gia đình',
                    'menus'=>$menus,
                    'dlls'=>$dlls
            ]);
    }

    public function HomeHGD()
    {

        return view('HoGiaDinh.home',[
            'title'=>'Trang quản trị',
        ]);

    }

}

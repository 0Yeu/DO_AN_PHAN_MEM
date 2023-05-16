<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhanBoController extends Controller
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
    public function guiPhanBo(Request $request)
    {
        $mergedData = [];
        $idDotLuLut = $request->input('idDotlulut');
        $idMucDoThietHai = $request->input('idMucDoThietHai');
        $sl = $request->input('sl');
        $idHangCuuTro = $request->input('idHangCuuTro');
        $soLuongDuKien = $request->input('soluongDuKien');
        $money = $request->input('money');
        $thoigian = $request->input('thoigian');
        $i=-1;
        foreach ($sl as $key => $value) {
            if ($value == 1) {
                $i++;
            }
            $currentMergedDataKey = $idMucDoThietHai[$i] . '_' . $idHangCuuTro[$key];

            // Kiểm tra nếu cặp idMucDoThietHai và idHangCuuTro đã tồn tại trong mảng $mergedData
            // Nếu tồn tại, cộng dồn giá trị soLuongDuKien vào tổng cũ
            // Nếu chưa tồn tại, thêm cặp mới vào mảng $mergedData
            if (array_key_exists($currentMergedDataKey, $mergedData)) {
                $mergedData[$currentMergedDataKey]['soLuongDuKien'] += $soLuongDuKien[$key];
            } else {
                $mergedData[$currentMergedDataKey] = [
                    'idDotLuLut' => $idDotLuLut,
                    'idMucDoThietHai' => $idMucDoThietHai[$i],
                    'idHangCuuTro' => $idHangCuuTro[$key],
                    'soLuongDuKien' => $soLuongDuKien[$key],
                ];
            }
        }
        foreach ($mergedData as $data) {
            DB::table('DuKienPhanBo')->insert($data);
        }

//        foreach ($sl as $key => $value) {
//            if ($value == 1) {
//                $i++;
//            }
//            DB::table('DuKienPhanBo')->insert([
//                'idDotLuLut' => $idDotLuLut,
//                'idMucDoThietHai' => $idMucDoThietHai[$i],
//                'idHangCuuTro' => $idHangCuuTro[$key],
//                'soLuongDuKien' => $soLuongDuKien[$key],
//            ]);
//        }

        return redirect()->route('admin');
    }
    public function duKien(){
        $DotLuLut = DB::table('DotLuLut')->get();
        $HangCT = DB::table('HangCuuTro')->get();
        $ListMucDO=DB::table('MucDoThietHai')->where('idDotLuLut',$DotLuLut->get(0)->idDotLuLut)->get();
        return view('Admin.PhanBo.dukienform',[
            'title'=>'abc',
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut,
            'ListMucDo'=>$ListMucDO
        ]);
    }
    public function filterMDTH(Request $request)
    {
        $idDLL = $request->input('idDLL');
        $dlls = DB::table('DotLuLut')->get();
        $menus = DB::table('MucDoThietHai')
                ->where('idDotLuLut', $idDLL)
                ->get();
        $DotLuLut = DB::table('DotLuLut')->get();
        $HangCT = DB::table('HangCuuTro')->get();

//        $idLoaiHoGD = $request->input('idLoaiHGD');
//        $dlls = DB::table('LoaiHoGD')->get();
//        $menus = DB::table('HoGiaDinh')->where('idLoaiHoGD', $idLoaiHoGD)->paginate(10);

        return
            view('admin/PhanBo/tableData',[
                'title'=>'Danh sách loại hộ gia đình',
                'ListMucDo'=>$menus,
                'dlls'=>$dlls,
                'HangCT'=>$HangCT,
                'DotLuLut'=>$DotLuLut
            ]);
    }
    public function filterMDTHS(Request $request)
    {
        $idDLL = $request->input('idDLL');
        $dlls = DB::table('DotLuLut')->get();
        $menus = DB::table('MucDoThietHai')
            ->select('MucDoThietHai.*','DotLuLut.tenDotLuLut')
            ->join('DotLuLut', 'MucDoThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
            ->where('MucDoThietHai.idDotLuLut', $idDLL)
            ->orderBy('idMucDoThietHai', 'asc')
            ->get();
        $DotLuLut = DB::table('DotLuLut')->get();
        $HangCT = DB::table('HangCuuTro')->get();

//        $idLoaiHoGD = $request->input('idLoaiHGD');
//        $dlls = DB::table('LoaiHoGD')->get();
//        $menus = DB::table('HoGiaDinh')->where('idLoaiHoGD', $idLoaiHoGD)->paginate(10);

        return
            view('admin/MucDoThietHai/tableMDTH',[
                'title'=>'Danh sách loại hộ gia đình',
                'menus'=>$menus,
                'dlls'=>$dlls,
                'HangCT'=>$HangCT,
                'DotLuLut'=>$DotLuLut
            ]);
    }
    public function filterMDTH1(Request $request)
    {
        $idDLL = $request->input('idDLL');
        $DotLuLut = DB::table('DotLuLut')->where('khaiBao',2)->get();
        $HangCT = DB::table('HangCuuTro')->get();
        if ($DotLuLut->count()>0){
            $MucDos = DB::table('MucDoThietHai')->where('idDotLuLut',$idDLL)->get();
        }else{
            $MucDos = DB::table('MucDoThietHai')->where('idDotLuLut',-1)->get();
        }
        $result=DB::table('ThietHai')->where('idHoGiaDinh','=',Auth::user()->hoTen)->where('idDotLuLut','=',$idDLL)->get();
        return view('Admin.ToKhai.selectedIDMDTH',[
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut,
            'MucDos'=>$MucDos,
            'result'=>$result
        ]);
    }
}

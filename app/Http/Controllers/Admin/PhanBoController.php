<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
//        dd($request);
        $mergedData = [];
        $idDotLuLut = $request->input('idDotlulut');
        $idMucDoThietHai = $request->input('idMucDoThietHai');
        $sl = $request->input('sl');
        $idHangCuuTro = $request->input('idHangCuuTro');
        $soLuongDuKien = $request->input('soluongDuKien');
        $money = $request->input('money');
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
//        dd($request,$mergedData);
        DB::table('DuKienPhanBo')->where('idDotLuLut', '=', $idDotLuLut)->delete();
        DB::table('DuKienPhanBoTien')->where('idDotLuLut', '=', $idDotLuLut)->delete();
        foreach ($mergedData as $data) {
//            dd($data);
            DB::table('DuKienPhanBo')->insert($data);
        }
        $i=-1;
        foreach ($sl as $key => $value) {
            if ($value == 1) {
                $i++;
                DB::table('DuKienPhanBoTien')->insert([
                    'idDotLuLut'=>$idDotLuLut,
                    'idMucDoThietHai'=>$idMucDoThietHai[$i],
                    'tienDuKien'=>$money[$i]
                ]);
            }

        }
        Session::flash("success","Thành công");
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

        return redirect()->route('thongkedukien');
    }
    public function duKien(){
        $DotLuLut = DB::table('DotLuLut')->get();
        $HangCT = DB::table('HangCuuTro')->get();
        $ListMucDO=DB::table('MucDoThietHai')->where('idDotLuLut',$DotLuLut->get(0)->idDotLuLut)->get();
        $result =DB::table('DuKienPhanBo')
            ->join('HangCuuTro','HangCuuTro.idHangCuuTro','=','DuKienPhanBo.idHangCuuTro')
            ->where('idDotLuLut',$DotLuLut[0]->idDotLuLut)
            ->select('DuKienPhanBo.*','HangCuuTro.tenHangCuuTro')
            ->get();
        $result1 =DB::table('DuKienPhanBoTien')
            ->where('idDotLuLut',$DotLuLut[0]->idDotLuLut)
            ->get();
        return view('Admin.PhanBo.dukienform',[
            'title'=>'abc',
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut,
            'ListMucDo'=>$ListMucDO,
            'result'=>$result,
            'result1'=>$result1,
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
        $result =DB::table('DuKienPhanBo')
            ->join('HangCuuTro','HangCuuTro.idHangCuuTro','=','DuKienPhanBo.idHangCuuTro')
            ->where('idDotLuLut',$idDLL)
            ->select('DuKienPhanBo.*','HangCuuTro.tenHangCuuTro')
            ->get();
        $result1 =DB::table('DuKienPhanBoTien')
            ->where('idDotLuLut',$idDLL)
            ->get();
        return
            view('admin/PhanBo/tableData',[
                'title'=>'Danh sách loại hộ gia đình',
                'ListMucDo'=>$menus,
                'dlls'=>$dlls,
                'HangCT'=>$HangCT,
                'DotLuLut'=>$DotLuLut,
                'result'=>$result,
                'result1'=>$result1
            ]);
    }
    public function filterMDTHS(Request $request)
    {
        $idDLL = $request->input('idDLL');
        $dlls = DB::table('DotLuLut')->get();
        if ($idDLL!=-1)
            $menus = DB::table('MucDoThietHai')
                ->select('MucDoThietHai.*','DotLuLut.tenDotLuLut')
                ->join('DotLuLut', 'MucDoThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
                ->where('MucDoThietHai.idDotLuLut', $idDLL)
                ->orderBy('idMucDoThietHai', 'asc')
                ->paginate(10);
        else{
            $menus = DB::table('MucDoThietHai')
                ->select('MucDoThietHai.*','DotLuLut.tenDotLuLut')
                ->join('DotLuLut', 'MucDoThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
                ->orderBy('idMucDoThietHai', 'asc')
                ->paginate(10);
        }
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
    public function filterMDTH2(Request $request)
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
        return view('Admin.ToKhai.ghichu',[
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut,
            'MucDos'=>$MucDos,
            'result'=>$result
        ]);
    }
    public function ThongKeTheoDuKien(){
        $DotLuLut = DB::table('DotLuLut')->get();
        $result = DB::table('DuKienPhanBo AS DUK')
            ->join('ThietHai AS TH', 'DUK.idMucDoThietHai', '=', 'TH.idMucDoThietHai')
            ->join('HoGiaDinh AS HG', 'TH.idHoGiaDinh', '=', 'HG.idHoGiaDinh')
            ->join('HangCuuTro AS HC', 'DUK.idHangCuuTro', '=', 'HC.idHangCuuTro')
            ->where('DUK.idDotLuLut', $DotLuLut[0]->idDotLuLut)
            ->where('TH.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->groupBy('DUK.idHangCuuTro', 'HC.soLuongCon', 'HC.tenHangCuuTro')
            ->select('DUK.idHangCuuTro', 'HC.tenHangCuuTro', DB::raw('SUM(DUK.soLuongDuKien * HG.soLuongThanhVien) AS soLuong'), 'HC.soLuongCon')
            ->get();
        return view('Admin.PhanBo.thongketheodukien',[
            'title'=>'abc',
            'DotLuLut'=>$DotLuLut,
            'menus'=>$result,
        ]);
    }
    public function filterMDTH3(Request $request){
        $idDLL = $request->input('idDLL');
        $DotLuLut = DB::table('DotLuLut')->get();
        $result = DB::table('DuKienPhanBo AS DUK')
            ->join('ThietHai AS TH', 'DUK.idMucDoThietHai', '=', 'TH.idMucDoThietHai')
            ->join('HoGiaDinh AS HG', 'TH.idHoGiaDinh', '=', 'HG.idHoGiaDinh')
            ->join('HangCuuTro AS HC', 'DUK.idHangCuuTro', '=', 'HC.idHangCuuTro')
            ->where('DUK.idDotLuLut', $idDLL)
            ->where('TH.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->groupBy('DUK.idHangCuuTro', 'HC.soLuongCon', 'HC.tenHangCuuTro')
            ->select('DUK.idHangCuuTro', 'HC.tenHangCuuTro', DB::raw('SUM(DUK.soLuongDuKien * HG.soLuongThanhVien) AS soLuong'), 'HC.soLuongCon')
            ->get();
        return view('Admin.PhanBo.tableThongKe',[
            'title'=>'abc',
            'DotLuLut'=>$DotLuLut,
            'menus'=>$result,
        ]);
    }
    public function filterPB(Request $request)
    {
        $idDLL = $request->input('idDLL');
        $hoGiaDinhChuaPhanBo = DB::table('ThietHai AS th')
            ->join('MucDoThietHai','MucDoThietHai.idMucDoThietHai','=','th.idMucDoThietHai')
//            ->join('','MucDoThietHai.idMucDoThietHai','=','th.idMucDoThietHai')
            ->select('th.*','MucDoThietHai.tenMucDo')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chiTietPhanBoHang AS ctp')
                    ->join('dotPhanBo AS dpb', 'ctp.idPhanBo', '=', 'dpb.idPhanBo')
                    ->join('HoGiaDinh', 'dpb.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh');
            })
            ->where('th.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->where('th.idDotLuLut','=',$idDLL)
            ->distinct()
            ->get();
        $hoGiaDinhDaPhanBo = DB::table('ThietHai AS th')
            ->select('th.*')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chiTietPhanBoHang AS ctp')
                    ->join('dotPhanBo AS dpb', 'ctp.idPhanBo', '=', 'dpb.idPhanBo')
                    ->join('HoGiaDinh', 'dpb.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh');
            })
            ->where('th.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->where('th.idDotLuLut','=',$idDLL)
            ->distinct()
            ->get();
//        dd($hoGiaDinhChuaPhanBo,$hoGiaDinhDaPhanBo);
        $dlls=DB::table('DotLuLut')->get();
        if (Auth::user()->idQuyen==1 ){
            return view('Admin.PhanBo.tableListPB',[
                'title'=>'Danh sách tờ khai',
                'hoGiaDinhChuaPhanBo'=>$hoGiaDinhChuaPhanBo,
                'hoGiaDinhDaPhanBo'=>$hoGiaDinhDaPhanBo,
                'dlls'=>$dlls
            ]);
        }else
            return view('CTV.PhanBo.listPhanBo',[
                'title'=>'Danh sách tờ khai',
                'hoGiaDinhChuaPhanBo'=>$hoGiaDinhChuaPhanBo,
                'hoGiaDinhDaPhanBo'=>$hoGiaDinhDaPhanBo,
                'dlls'=>$dlls
            ]);
    }
}

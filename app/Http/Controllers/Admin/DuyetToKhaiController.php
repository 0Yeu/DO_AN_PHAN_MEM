<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class DuyetToKhaiController extends Controller
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
    public function DanhSachToKhai(){
        $ungHoList = DB::table('ThietHai')
            ->join('DotLuLut', 'ThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
            ->join('HoGiaDinh', 'ThietHai.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh')
            ->join('MucDoThietHai', 'ThietHai.idMucDoThietHai', '=', 'MucDoThietHai.idMucDoThiethai')
            ->select('ThietHai.*', 'DotLuLut.tenDotLuLut as tenDotLuLut','MucDoThietHai.tenMucDo as tenMucDoThietHai','HoGiaDinh.idXa')
            ->paginate(10);
        $xaList = DB::table('Xa')->get();
        $dlls=DB::table('DotLuLut')->get();
        if (Auth::user()->idQuyen==1 ){
            return view('Admin.DuyetToKhai.danhsach',[
                'title'=>'Danh sách tờ khai',
                'menus'=>$ungHoList,
                'xaList'=>$xaList,
                'dlls'=>$dlls
            ]);
        }else
            return view('CTV.DuyetToKhai.danhsach',[
                'title'=>'Danh sách tờ khai',
                'menus'=>$ungHoList,
                'xaList'=>$xaList,
                'dlls'=>$dlls
            ]);
    }
    public function ChiTietToKhai(Request $request){
//        dd($request);
        $chiTietList = DB::table('ChiTietUngHoHang')
            ->join('HangCuuTro', 'ChiTietUngHoHang.idHangCuuTro', '=', 'HangCuuTro.idHangCuuTro')
            ->join('UngHo', 'ChiTietUngHoHang.idUngHo', '=', 'UngHo.idUngHo')
            ->join('NguoiDung', 'UngHo.idNguoiDung', '=', 'NguoiDung.idNguoiDung')
            ->select('ChiTietUngHoHang.*', 'HangCuuTro.tenHangCuuTro','HangCuuTro.donViTinh', 'UngHo.thoiGianUngHo','NguoiDung.hoTen','NguoiDung.idQuyen','NguoiDung.idNguoiDung')
            ->where('ChiTietUngHoHang.idUngHo', $request->id)
            ->get();
        if (Auth::user()->idQuyen==1 ){
            return view('Admin.Duyet.chitiet',[
                'title'=>'Chi tiết ủng hộ',
                'chiTietList'=>$chiTietList,
                'idUngHo'=>$request->id
            ]);
        }else
            return view('Admin.UngHo.chitiet',[
                'chiTietList'=>$chiTietList,
                'idUngHo'=>$request->id
            ]);
    }
    public function pheDuyetAll(Request $request)
    {
        $checks = $request->input('check');
        if ($request->has("pheduyetall"))
            for ($i = 0; $i < count($checks); $i++) {
                $idThietHai = $checks[$i];

                // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
                DB::table('thietHai')
                    ->where('idThietHai', $idThietHai)
                    ->update([
                        'trangThaiPheDuyet' => 'Đã phê duyệt', // Đã phê duyệt
                    ]);
            }
        else
            for ($i = 0; $i < count($checks); $i++) {
                $idThietHai = $checks[$i];

                // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
                DB::table('thietHai')
                    ->where('idThietHai', $idThietHai)
                    ->update([
                        'trangThaiPheDuyet' => 'Từ chối', // Đã phê duyệt
                    ]);
            }
            \Illuminate\Support\Facades\Session::flash("success",'Đã phê duyệt thành công');
        return redirect()->route('DanhSachToKhai');
    }
    public function pheDuyet(Request $request)
    {
        $checks = $request->input('check');
        if ($request->has("pheduyetall"))
            for ($i = 0; $i < count($checks); $i++) {
                $idThietHai = $checks[$i];

                // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
                DB::table('thietHai')
                    ->where('idThietHai', $idThietHai)
                    ->update([
                        'trangThaiPheDuyet' => 'Đã phê duyệt', // Đã phê duyệt
                    ]);
            }
        else
            for ($i = 0; $i < count($checks); $i++) {
                $idThietHai = $checks[$i];

                // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
                DB::table('thietHai')
                    ->where('idThietHai', $idThietHai)
                    ->update([
                        'trangThaiPheDuyet' => 'Từ chối', // Đã phê duyệt
                    ]);
            }
        return response()->json(['success' => true]);
    }
    public function filterToKhai(Request $request)
    {
        $idXa = $request->input('idXa');
        $idPheDuyet = $request->input('idPheDuyet');
        $idDotLuLut = $request->input('idDotLuLut');
        $dlls = DB::table('LoaiHoGD')->get();

        $query = DB::table('ThietHai')
            ->join('DotLuLut', 'ThietHai.idDotLuLut', '=', 'DotLuLut.idDotLuLut')
            ->join('HoGiaDinh', 'ThietHai.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh')
            ->join('MucDoThietHai', 'ThietHai.idMucDoThietHai', '=', 'MucDoThietHai.idMucDoThiethai')
            ->select('ThietHai.*', 'DotLuLut.tenDotLuLut as tenDotLuLut', 'MucDoThietHai.tenMucDo as tenMucDoThietHai', 'HoGiaDinh.idXa');

        if ($idPheDuyet != -1 || $idXa != -1 || $idDotLuLut != -1) {
            $query->where(function ($query) use ($idPheDuyet, $idXa, $idDotLuLut) {
                if ($idPheDuyet != -1) {
                    $query->where('ThietHai.trangThaiPheDuyet', 'like', $idPheDuyet);
                }

                if ($idXa != -1) {
                    $query->where('HoGiaDinh.idXa', '=', $idXa);
                }

                if ($idDotLuLut != -1) {
                    $query->where('ThietHai.idDotLuLut', '=', $idDotLuLut);
                }
            });
        }

        $results = $query->paginate(10);

        return view('admin/DuyetToKhai/tabledata', [
            'title' => 'Danh sách loại hộ gia đình',
            'menus' => $results,
            'dlls' => $dlls
        ]);
    }


    public function DanhSachPhanBo(){
        $dlls=DB::table('DotLuLut')->get();
        $hoGiaDinhChuaPhanBo = DB::table('ThietHai AS th')
            ->join('MucDoThietHai','MucDoThietHai.idMucDoThietHai','=','th.idMucDoThietHai')
            ->select('th.*','MucDoThietHai.tenMucDo')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chiTietPhanBoHang AS ctp')
                    ->join('dotPhanBo AS dpb', 'ctp.idPhanBo', '=', 'dpb.idPhanBo')
                    ->join('HoGiaDinh', 'dpb.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh');
            })
            ->where('th.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->where('th.idDotLuLut','=',$dlls[0]->idDotLuLut)
            ->distinct()
            ->get();
//        dd($hoGiaDinhChuaPhanBo);
        $hoGiaDinhDaPhanBo = DB::table('ThietHai AS th')
            ->select('th.*')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('chiTietPhanBoHang AS ctp')
                    ->join('dotPhanBo AS dpb', 'ctp.idPhanBo', '=', 'dpb.idPhanBo')
                    ->join('HoGiaDinh', 'dpb.idHoGiaDinh', '=', 'HoGiaDinh.idHoGiaDinh');
            })
            ->where('th.trangThaiPheDuyet', 'LIKE', 'Đã phê duyệt')
            ->where('th.idDotLuLut','=',$dlls[0]->idDotLuLut)
            ->distinct()
            ->get();
//        dd($hoGiaDinhChuaPhanBo,$hoGiaDinhDaPhanBo);
        if (Auth::user()->idQuyen==1 ){
            return view('Admin.PhanBo.listPhanBo',[
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
    public function ChiTietPhanBo(Request $request){
//        dd($request);
        $idThietHai=$request->input('id');
        $tableResult=DB::table('Thiethai')
            ->join('MucDoThietHai','MucDoThietHai.idMucDoThietHai','=','ThietHai.idMucDoThietHai')
            ->join('HoGiaDinh','HoGiaDinh.idHoGiaDinh','=','ThietHai.idHoGiaDinh')
            ->where('idThietHai','=',$idThietHai)
            ->first();
        $DKPB=DB::table('DuKienPhanBo')
            ->join('HangCuuTro','HangCuuTro.idHangCuuTro','=','DuKienPhanBo.idHangCuuTro')
            ->where('idMucDoThietHai','=',$tableResult->idMucDoThietHai)
            ->get();
        $DKPBT=DB::table('DuKienPhanBoTien')
//            ->join('HangCuuTro','HangCuuTro.idHangCuuTro','=','DuKienPhanBoTien.idHangCuuTro')
            ->where('idMucDoThietHai','=',$tableResult->idMucDoThietHai)
            ->first();
        $HangCT=DB::table("HangCuuTro")->get();
//        dd($tableResult,$DKPB,$DKPBT);
        if (Auth::user()->idQuyen==1 ){
            return view('Admin.PhanBo.chitietphanbo',[
                'title'=>'Chi tiết ủng hộ',
                'idUngHo'=>$request->id,
                'tableResult' =>$tableResult,
                'DKPB'=>$DKPB,
                'HangCT'=>$HangCT,
                'DKPBT'=>$DKPBT
            ]);
        }else
            return view('Admin.UngHo.chitiet',[
                'idUngHo'=>$request->id
            ]);
    }
}

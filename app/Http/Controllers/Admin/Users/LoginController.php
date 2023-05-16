<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check())
            if (Auth::user()->idQuyen==1){
                return redirect()->route('admin');
            }
        return view('Admin.Users.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'tenNguoiDung'=> 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmpass'=>'required_with:password'

        ]);
        DB::table('NguoiDung')->insert(
            [
                'hoTen'=> $request->input('tenNguoiDung'),
                'taiKhoan'=> $request->input('email'),
                'email'=>$request->input('email'),
                'matKhau'=> bcrypt($request->input('password')),
                'idQuyen'=>'2',
            ]);
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->input());
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = DB::table('NguoiDung')
            ->where('taiKhoan', $request->input('email'))
            ->first();


        if ($user && Hash::check($request->password,$user->matKhau)){
            Auth::loginUsingId($user->idNguoiDung);
            if (Auth::check()){
                if ($user->idQuyen=='1'){
                    return redirect()->route('admin');
                }else{
                    if ($user->idQuyen=='3'){
                        return redirect()->route('HoGiaDinh');
                    }else{
                        return redirect()->route('user');
                    }
                }
            }else{
                return redirect()->back()->withInput()->withErrors([
                    'email' => 'Not Logger',
                ]);
            }
        }else{
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        return view('Admin.Users.register');
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function DangKyUngHo()
    {
        //
        $DotLuLut = DB::table('DotLuLut')->where('ungHo',2)->get();
        $HangCT = DB::table('HangCuuTro')->get();
        return view('Admin.UngHo.toKhai',[
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut
        ]);
    }
    public function GuiUngHo(Request $request)
    {
        //
        $data = [];
        $hanghoa = $request->input('hanghoa');
        $soLuong = $request->input('soluong');
        $count = count($hanghoa);
//        dd($request);
        for ($i = 0; $i < $count; $i++) {
            $product = $hanghoa[$i];
            $quantity = $soLuong[$i];
            if (isset($data[$product])) {
                $data[$product] += $quantity;
            } else {
                $data[$product] = $quantity;
            }
        }
        DB::table('UngHo')->insert([
            'idNguoiDung' => Auth::check() ? Auth::user()->getAuthIdentifier():1,
            'idDotLuLut' => $request->input('dotlulut'),
            'thoiGianUngHo' => $request->input('thoigian'),
            'TrangThaiPheDuyet' => 'Chờ phê duyệt',
        ]);

        $latestUngHo = DB::table('UngHo')->orderBy('idUngHo', 'desc')->first();
//        dd($latestUngHo);
        foreach ($data as $product => $quantity) {
            echo $product . ' - ' . $quantity;
            // xử lý với từng product và quality
            DB::table('ChiTietUngHoHang')->insert(
                [
                    'idUngHo'=>$latestUngHo->idUngHo,
                    'idHangCuuTro' => $product,
                    'soLuong' => $quantity,
                    'TrangThaiPheDuyet' => 1,
                ]
            );
        }

        return redirect()->route('home');
    }
    public function DanhSachUngHo(){
        $ungHoList = DB::table('UngHo')
            ->join('NguoiDung', 'UngHo.idNguoiDung', '=', 'NguoiDung.idNguoiDung')
            ->select('UngHo.*', 'NguoiDung.hoTen as tenNguoiDung')
            ->get();
        return view('Admin.UngHo.danhsach',[
            'ungHoList'=>$ungHoList
        ]);
    }
    public function ChiTietUngHo(Request $request){
//        dd($request);
        $chiTietList = DB::table('ChiTietUngHoHang')
            ->join('HangCuuTro', 'ChiTietUngHoHang.idHangCuuTro', '=', 'HangCuuTro.idHangCuuTro')
            ->join('UngHo', 'ChiTietUngHoHang.idUngHo', '=', 'UngHo.idUngHo')
            ->join('NguoiDung', 'UngHo.idNguoiDung', '=', 'NguoiDung.idNguoiDung')
            ->select('ChiTietUngHoHang.*', 'HangCuuTro.tenHangCuuTro','HangCuuTro.donViTinh', 'UngHo.thoiGianUngHo','NguoiDung.hoTen','NguoiDung.idQuyen','NguoiDung.idNguoiDung')
            ->where('ChiTietUngHoHang.idUngHo', $request->id)
            ->get();

        return view('Admin.UngHo.chitiet',[
            'chiTietList'=>$chiTietList,
            'idUngHo'=>$request->id
        ]);
    }

    public function pheDuyet(Request $request)
    {
        // Lấy dữ liệu từ Ajax request
        $idHangCuuTro = $request->input('idHangCuuTro');
        $soLuongThucNhan = $request->input('soLuongThucNhan');
        $idUngHo=$request->input('idUngHo');

        // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
        DB::table('chiTietungHoHang')
            ->where('idHangCuuTro', $idHangCuuTro)
            ->where('idungho', $idUngHo) // Thêm điều kiện idungho
            ->update([
                'trangThaiPheDuyet' => 2, // Đã phê duyệt
                'soLuongThucNhan' => $soLuongThucNhan
            ]);


        // Trả về kết quả thành công (hoặc bất kỳ thông báo nào bạn muốn)
        return response()->json(['success' => true]);
    }
    public function pheDuyetAll(Request $request)
    {
        // Lấy dữ liệu từ Ajax request
        $idHangCuuTroList = $request->input('idHangCuuTroList');
        $soLuongThucNhanList = $request->input('soLuongThucNhanList');
        $idUngHo = $request->input('idUngHo');

// Sử dụng vòng lặp for để duyệt qua từng phần tử trong danh sách idHangCuuTroList
        for ($i = 0; $i < count($soLuongThucNhanList); $i++) {
            $idHangCuuTro = $idHangCuuTroList[$i];
            $soLuongThucNhan = $soLuongThucNhanList[$i];

            // Cập nhật trạng thái và số lượng thực nhận bằng cách sử dụng DB facade
            DB::table('chiTietungHoHang')
                ->where('idHangCuuTro', $idHangCuuTro)
                ->where('idungho', $idUngHo) // Thêm điều kiện idungho
                ->update([
                    'trangThaiPheDuyet' => 2, // Đã phê duyệt
                    'soLuongThucNhan' => $soLuongThucNhan
                ]);
        }



        // Trả về kết quả thành công (hoặc bất kỳ thông báo nào bạn muốn
        return response()->json(['success' => true]);
    }

    public function KhaiBaoThietHai()
    {
        //
        $DotLuLut = DB::table('DotLuLut')->where('khaiBao',2)->get();
        $HangCT = DB::table('HangCuuTro')->get();
        if ($DotLuLut->count()>0){
            $MucDos = DB::table('MucDoThietHai')->where('idDotLuLut',$DotLuLut[0]->idDotLuLut)->get();
        }else{
            $MucDos = DB::table('MucDoThietHai')->where('idDotLuLut',-1)->get();
        }
        $result=DB::table('ThietHai')->where('idHoGiaDinh','=',Auth::user()->hoTen)->where('idDotLuLut','=',$DotLuLut[0]->idDotLuLut)->get();
        return view('Admin.ToKhai.tokhaithiethai',[
            'HangCT'=>$HangCT,
            'DotLuLut'=>$DotLuLut,
            'MucDos'=>$MucDos,
            'result'=>$result
        ]);
    }
    public function GuiToKhai(Request $request)
    {
        //
//        dd($request);
        $idHoGiaDinh = $request->input('idHoGiaDinh');
        $idDotLuLut = $request->input('idDotLuLut');
        $thietHaiVeTaiSan = $request->input('thietHaiVeTaiSan');
        $UocTinhTongThietHai = $request->input('UocTinhTongThietHai');
        $idMucDoThietHai = $request->input('idMucDoThietHai');
//        dd($idHoGiaDinh,$idDotLuLut,$thietHaiVeTaiSan,$UocTinhTongThietHai,$idMucDoThietHai);

        $result=DB::table('ThietHai')->where('idHoGiaDinh','=',$idHoGiaDinh)->where('idDotLuLut','=',$idDotLuLut)->get();
        if ($result->count()==0){
            $abc=DB::table('ThietHai')->insert([
                'idHoGiaDinh' => $idHoGiaDinh,
                'idDotLuLut' => $idDotLuLut,
                'thietHaiVeTaiSan' => $thietHaiVeTaiSan,
                'uocTinhTongThietHai' => $UocTinhTongThietHai,
                'idMucDoThietHai'=>$idMucDoThietHai,
                'trangThaiPheDuyet' =>'Chờ phê duyệt'
            ]);
        }else{
            $abc=DB::table('ThietHai')
                ->where('idHoGiaDinh','=',$idHoGiaDinh)->where('idDotLuLut','=',$idDotLuLut)
                ->update([
                    'thietHaiVeTaiSan' => $thietHaiVeTaiSan,
                    'uocTinhTongThietHai' => $UocTinhTongThietHai,
                    'idMucDoThietHai'=>$idMucDoThietHai,
                    'trangThaiPheDuyet' =>'Chờ phê duyệt'
            ]);
        }
        if ($abc){
            Session::flash('success','Đã gửi');
        }else{
            Session::flash('error','Đã xảy ra lỗi');
        }
        return redirect()->route('HoGiaDinh');
    }
}

<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'email' => 'required|email',
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
                    return redirect()->route('user');
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
        $DotLuLut = DB::table('DotLuLut')->get();
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
            ->select('ChiTietUngHoHang.*', 'HangCuuTro.tenHangCuuTro','HangCuuTro.donViTinh', 'UngHo.thoiGianUngHo','NguoiDung.hoTen','NguoiDung.idQuyen')
            ->where('ChiTietUngHoHang.idUngHo', $request->id)
            ->get();

        return view('Admin.UngHo.chitiet',[
            'chiTietList'=>$chiTietList
        ]);
    }
}

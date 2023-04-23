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
}

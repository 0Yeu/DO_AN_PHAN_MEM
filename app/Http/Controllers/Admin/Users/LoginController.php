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
        //dd($request->input());
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = DB::table('NguoiDung')
        ->where('taiKhoan', $request->input('email'))
        ->where('idQuyen',1)
        ->first();

        if ($user && Hash::check($request->password,$user->matKhau)){
            Auth::loginUsingId($user->idNguoiDung,$request->input('remember'));
            if (Auth::check()){
                return redirect()->route('admin');
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
}

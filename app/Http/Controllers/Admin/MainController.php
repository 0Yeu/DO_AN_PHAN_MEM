<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $BaiDangs = DB::table('BaiDang')
            ->orderBy('idBaiDang', 'asc')
            ->paginate(8);
//        return response()->json([
//            'success' => true,
//            'message' => 'Posts retrieved successfully',
//            'data' => $BaiDangs
//        ]);
        return view('admin.home',[
            'title'=>'Trang quản trị',
            'BaiDangs'=> $BaiDangs
        ]);
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
    public function indexCTV()
    {
        //
        $BaiDangs = DB::table('BaiDang')
            ->orderBy('idBaiDang', 'asc')
            ->paginate(8);
//        return response()->json([
//            'success' => true,
//            'message' => 'Posts retrieved successfully',
//            'data' => $BaiDangs
//        ]);
        return view('CTV.home',[
            'title'=>'Trang quản trị',
            'BaiDangs'=> $BaiDangs
        ]);
    }
}

<?php
namespace App\Http\Service\Menu;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuService{
    public function create($request){
        try {
            DB::table('DanhMucHangCuuTro')->insert(
                [
                    'tenDanhMuc' => $request->input('tenDanhMuc'),
                    'moTa' => $request->input('content'),
                ]
            );
            return redirect()->route('listDanhMuc');
            Session::flash('succes','Thêm danh mục thành công');
        }catch (\ErrorException $e){
            Session::flash('error',$e->getMessage());
            return false;
        }
        return true;

    }
    public function getTop10(){
        return $data = DB::table('DanhMucHangCuuTro')
            ->orderBy('idDanhMuc', 'asc')
            ->paginate(10);
    }
    public function edit($request){
        DB::table('DanhSachDanhMuc')
            ->where('idDanhMuc', $request->query('idDanhMuc'))
            ->update(['name' => 'New Name', 'email' => 'newemail@example.com']);

    }
    public function destroy($request){
        $menu = DB::table('DanhMucHangCuuTro')
            ->where('idDanhMuc', $request->query('idDanhMuc'));

        if ($menu){
            return DB::table('DanhMucHangCuuTro')->where('idDanhMuc', '=', $request->query('idDanhMuc'))->delete();
        }
        return false;
    }
}

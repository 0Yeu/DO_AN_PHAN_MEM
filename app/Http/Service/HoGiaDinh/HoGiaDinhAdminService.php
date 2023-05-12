<?php
namespace App\Http\Services\HoGiaDinh;

use App\Models\LoaiHoGD;
use App\Models\HoGiaDinh;

class HoGiaDinhAdminService
{
	public function getLoaiHoGD()
	{
		return LoaiHoGD::where('active',1)->get();
	}

	public function get()
	{
		return HoGiaDinh::with('loaiHoGD')
			->orderByDesc('id')->paginate(15);
	}
}
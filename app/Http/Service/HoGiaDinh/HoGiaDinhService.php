<?php


namespace App\Http\Services\HoGiaDinh;


use App\Models\HoGiaDinh;

class HoGiaDinhService
{
    const LIMIT = 16;

    public function get($page = null)
    {
        return HoGiaDinh::select('idHoGiaDinh', 'idLoaiHoGD', 'soLuongThanhVien', 'diaChi')
            ->orderByDesc('idHoGiaDinh')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($idHoGiaDinh)
    {
        return HoGiaDinh::where('idHoGiaDinh', $idHoGiaDinh)
            ->where('active', 1)
            ->with('loaiHoGD')
            ->firstOrFail();
    }

    public function more($idHoGiaDinh)
    {
        return HoGiaDinh::select('idHoGiaDinh', 'idLoaiHoGD', 'soLuongThanhVien', 'diaChi')
            ->where('idHoGiaDinh', '!=', $idHoGiaDinh)
            ->orderByDesc('idHoGiaDinh')
            ->limit(8)
            ->get();
    }
}
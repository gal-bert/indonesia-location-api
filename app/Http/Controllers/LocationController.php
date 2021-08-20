<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function all($limit, $offset)
    {

        if($limit == null) $limit = 80000;

        $query = DB::table('provinsi')
            ->select('kelurahan.kelurahan_id AS id', 'provinsi.name AS provinsi', 'kota.name AS kota', 'kecamatan.name AS kecamatan', 'kelurahan.name AS kelurahan')
            ->join('kota', 'provinsi.provinsi_id', '=', 'kota.provinsi_id')
            ->join('kecamatan', 'kota.kota_id', '=', 'kecamatan.kota_id')
            ->join('kelurahan', 'kecamatan.kecamatan_id', '=', 'kelurahan.kecamatan_id')
            ->limit($limit)
            ->offset($offset)
            ->get();

        $data = [
            'location' => $query
        ];

        return $data;
    }

    public function province($province)
    {
        $query = DB::table('provinsi')
            ->select('kelurahan.kelurahan_id AS id', 'provinsi.name AS provinsi', 'kota.name AS kota', 'kecamatan.name AS kecamatan', 'kelurahan.name AS kelurahan')
            ->join('kota', 'provinsi.provinsi_id', '=', 'kota.provinsi_id')
            ->join('kecamatan', 'kota.kota_id', '=', 'kecamatan.kota_id')
            ->join('kelurahan', 'kecamatan.kecamatan_id', '=', 'kelurahan.kecamatan_id')
            ->where('provinsi.name', 'LIKE', '%'.$province.'%')
            ->get();

        $data = [
            'location' => $query
        ];

        return $data;
    }
}

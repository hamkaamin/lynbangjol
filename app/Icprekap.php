<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use DB;

class Icprekap extends Model
{
    protected $table = "icp_rekaps";

    public static function getRekaps()
    {
        return DB::select('SELECT  r.id, u.email, m.nik, m.nama, r.issue, r.urgensi, r.harapan, r.manfaat, k.nama AS kategori_nama, s.namasatker
        FROM icp_rekaps r
        LEFT JOIN users u ON u.id = r.user_id
        LEFT JOIN icp_satkerprovs s ON s.id = u.satker_id
        LEFT JOIN icp_kategoris k ON k.id = r.kategori_id
        LEFT JOIN masyarakats m ON m.id = u.masyarakat_id
        ORDER BY r.updated_at DESC');
    }

    public static function getRekap($rekap_id)
    {
        return DB::table('icp_rekaps as r')
        ->select('r.id', 'r.issue', 'r.urgensi', 'r.harapan', 'r.manfaat', 'm.nik', 'm.nama', 'm.alamat', 'm.no_telp', 'm.status', 'm.bidang', 's.namasatker', 'k.nama as nama_kategori')
        ->leftJoin('users as u', 'u.id', '=', 'r.user_id')
        ->leftJoin('masyarakats as m', 'm.id', '=', 'u.masyarakat_id')
        ->leftJoin('icp_satkerprovs as s', 's.id', '=', 'u.satker_id')
        ->leftJoin('icp_kategoris as k', 'k.id', '=', 'r.kategori_id')
        ->where('r.id','=', $rekap_id)
        ->get();
    }

    public static function getRekapUser($user_id)
    {
        return DB::table('icp_rekaps as r')
        ->select('r.id', 'r.issue', 'r.urgensi', 'r.harapan', 'r.manfaat', 'm.nik', 'm.nama', 'm.alamat', 'm.no_telp', 'm.status', 'm.bidang', 's.namasatker', 'k.nama as nama_kategori')
        ->leftJoin('users as u', 'u.id', '=', 'r.user_id')
        ->leftJoin('masyarakats as m', 'm.id', '=', 'u.masyarakat_id')
        ->leftJoin('icp_satkerprovs as s', 's.id', '=', 'u.satker_id')
        ->leftJoin('icp_kategoris as k', 'k.id', '=', 'r.kategori_id')
        ->where('r.user_id','=', $user_id)
        ->orderBy('r.updated_at', 'DESC')
        ->get();
    }

    public function owner(): HasOne
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}

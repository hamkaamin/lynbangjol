<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    //
    protected $fillable = [
        'judul', 'kategori_penelitian', 'jenis_penelitian', 'tahun_penelitian', 'lama', 'anggaran', 'sumber_dana', 'abstrak', 'keyword', 
        'halaman', 'tipe', 'lapkir_filename', 'eksum_filename', 'halaman_show', 'cover_filename', 'tahun_watermark'
    ];
    
    protected $table = 'laporans';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function laporanAuthors()
    {
        return $this->hasMany('App\LaporanAuthor');
    }
    
    public function laporanKategoris()
    {
        return $this->hasMany('App\LaporanKategori');
    }
    
    public function laporanLokasis()
    {
        return $this->hasMany('App\LaporanLokasi');
    }
    
    public function laporanLembagas()
    {
        return $this->hasMany('App\LaporanLembaga');
    }
    //----------------------------------------------------------
}

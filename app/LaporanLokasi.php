<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanLokasi extends Model
{
    //
    protected $fillable = [
        'laporan_id', 'lokasi_id'
    ];
    
    protected $table = 'laporan_lokasis';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function laporans()
   {
        return $this->belongsTo('App\Laporan', 'laporan_id');
   }
   public function lokasis()
   {
        return $this->belongsTo('App\Lokasi', 'lokasi_id');
   }
//------------------------------------------------------------------------
}

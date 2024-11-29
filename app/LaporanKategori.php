<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanKategori extends Model
{
    //
    protected $fillable = [
        'laporan_id', 'kategori_id'
    ];
    
    protected $table = 'laporan_kategoris';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function laporans()
   {
        return $this->belongsTo('App\Laporan', 'laporan_id');
   }
   public function kategoris()
   {
        return $this->belongsTo('App\Kategori', 'kategori_id');
   }
//------------------------------------------------------------------------
}

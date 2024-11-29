<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanLembaga extends Model
{
    //
    protected $fillable = [
        'laporan_id', 'lembaga_id'
    ];
    
    protected $table = 'laporan_lembagas';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function laporans()
   {
        return $this->belongsTo('App\Laporan', 'laporan_id');
   }
   public function lembagas()
   {
        return $this->belongsTo('App\Lembaga', 'lembaga_id');
   }
//------------------------------------------------------------------------
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    //
    protected $fillable = [
        'nama'
    ];
    
    protected $table = 'lokasis';

    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
   public function laporanLokasis()
    {
        return $this->hasMany('App\LaporanLokasi');
    }
    //----------------------------------------------------------
}

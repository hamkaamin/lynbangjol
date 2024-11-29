<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lembaga extends Model
{
    //
    protected $fillable = [
        'nama', 'alamat', 'no_telp'
    ];
    
    protected $table = 'lembagas';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
   public function laporanLembaga()
    {
        return $this->hasMany('App\LaporanLembaga');
    }
    
    public function authors()
    {
        return $this->hasMany('App\Author');
    }
    //----------------------------------------------------------
}

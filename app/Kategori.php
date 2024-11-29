<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $fillable = [
        'nama'
    ];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function laporanKategoris()
    {
        return $this->hasMany('App\LaporanKategori');
    }
    
    public function bukuKategoris()
    {
        return $this->hasMany('App\BukuKategori');
    }
    
    public function jurnalKategoris()
    {
        return $this->hasMany('App\JurnalKategori');
    }
    
    public function majalahKategoris()
    {
        return $this->hasMany('App\MajalahKategori');
    }
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
    //----------------------------------------------------------
}

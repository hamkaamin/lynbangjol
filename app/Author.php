<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    //
    protected $fillable = [
        'nama', 'gender', 'alamat', 'no_telp', 'email', 'lembaga_id', 'jabatan'
    ];
    
    protected $table = 'authors';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
   public function laporanAuthors()
    {
        return $this->hasMany('App\LaporanAuthor');
    }
    
    public function bukuAuthors()
    {
        return $this->hasMany('App\BukuAuthor');
    }
    
    public function jurnalAuthors()
    {
        return $this->hasMany('App\JurnalAuthor');
    }
    
    public function majalahAuthors()
    {
        return $this->hasMany('App\MajalahAuthor');
    }
    //----------------------------------------------------------
    
    public function lembagas()
    {
        return $this->belongsTo('App\Lembaga', 'lembaga_id');
    }
    
}

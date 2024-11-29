<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurnal extends Model
{
    //
    protected $fillable = [
        'nama', 'penerbit', 'volume', 'tgl_publikasi', 'halaman', 'doc_filename', 'cover_filename', 'cover_filename'
    ];
    
    protected $table = 'jurnals';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function jurnalArtikels()
    {
        return $this->hasMany('App\JurnalArtikel');
    }
    
    public function jurnalKategoris()
    {
        return $this->hasMany('App\JurnalKategori');
    }
    
    //----------------------------------------------------------
}

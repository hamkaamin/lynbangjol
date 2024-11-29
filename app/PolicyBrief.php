<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolicyBrief extends Model
{
    //
    protected $fillable = [
        'nama', 'penerbit', 'edisi', 'tgl_publikasi', 'halaman', 'doc_filename', 'cover_filename', 'cover_filename'
    ];
    
    protected $table = 'policy_briefs';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    /*public function majalahArtikels()
    {
        return $this->hasMany('App\MajalahArtikel');
    }
    
    public function majalahKategoris()
    {
        return $this->hasMany('App\MajalahKategori');
    }*/
    
    //----------------------------------------------------------
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    //
    protected $fillable = [
        'judul', 'penerbit', 'tgl_publikasi', 'doc_filename', 'cover_filename', 'cover_filename'
    ];
    
    protected $table = 'bukus';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function bukuAuthors()
    {
        return $this->hasMany('App\BukuAuthor');
    }
    
    public function bukuKategoris()
    {
        return $this->hasMany('App\BukuKategori');
    }
    
    //----------------------------------------------------------
}

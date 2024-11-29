<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuKategori extends Model
{
    //
    protected $fillable = [
        'buku_id', 'kategori_id'
    ];
    
    protected $table = 'buku_kategoris';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function bukus()
   {
        return $this->belongsTo('App\Buku', 'buku_id');
   }
   public function kategoris()
   {
        return $this->belongsTo('App\Kategori', 'kategori_id');
   }
//------------------------------------------------------------------------
}

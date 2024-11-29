<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajalahKategori extends Model
{
    //
    protected $fillable = [
        'majalah_id', 'kategori_id'
    ];
    
    protected $table = 'majalah_kategoris';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function majalahs()
   {
        return $this->belongsTo('App\Majalah', 'majalah_id');
   }
   public function kategoris()
   {
        return $this->belongsTo('App\Kategori', 'kategori_id');
   }
//------------------------------------------------------------------------
}

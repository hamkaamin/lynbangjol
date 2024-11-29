<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurnalKategori extends Model
{
    //
    protected $fillable = [
        'jurnal_id', 'kategori_id'
    ];
    
    protected $table = 'jurnal_kategoris';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function jurnals()
   {
        return $this->belongsTo('App\Jurnal', 'jurnal_id');
   }
   public function kategoris()
   {
        return $this->belongsTo('App\Kategori', 'kategori_id');
   }
//------------------------------------------------------------------------
}

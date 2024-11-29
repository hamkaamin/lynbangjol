<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanAuthor extends Model
{
    //
    protected $fillable = [
        'laporan_id', 'author_id', 'jabatan'
    ];
    
    protected $table = 'laporan_authors';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function laporans()
   {
        return $this->belongsTo('App\Laporan', 'laporan_id');
   }
   public function authors()
   {
        return $this->belongsTo('App\Author', 'author_id');
   }
//------------------------------------------------------------------------
   
}

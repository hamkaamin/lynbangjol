<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajalahAuthor extends Model
{
    //
    protected $fillable = [
        'artikel_id', 'author_id'
    ];
    
    protected $table = 'majalah_authors';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function majalahArtikels()
   {
        return $this->belongsTo('App\MajalahArtikel', 'artikel_id');
   }
   public function authors()
   {
        return $this->belongsTo('App\Author', 'author_id');
   }
//------------------------------------------------------------------------
}

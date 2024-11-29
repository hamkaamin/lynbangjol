<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuAuthor extends Model
{
    //
    protected $fillable = [
        'buku_id', 'author_id'
    ];
    
    protected $table = 'buku_authors';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------------------- RELASI N-1 -----------------------------
    public function bukus()
   {
        return $this->belongsTo('App\Buku', 'buku_id');
   }
   public function authors()
   {
        return $this->belongsTo('App\Author', 'author_id');
   }
//------------------------------------------------------------------------
}

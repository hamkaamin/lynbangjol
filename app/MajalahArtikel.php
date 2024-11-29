<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajalahArtikel extends Model
{
    //
    protected $fillable = [
        'judul', 'halaman', 'majalah_id'
    ];
    
    protected $table = 'majalah_artikels';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function majalahs()
    {
        return $this->belongsTo('App\Majalah', 'majalah_id');
    }
    
    public function majalahAuthors()
    {
        return $this->hasMany('App\MajalahAuthor', 'artikel_id');
    }
    
    //----------------------------------------------------------
}

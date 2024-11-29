<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JurnalArtikel extends Model
{
    //
    protected $fillable = [
        'judul', 'halaman', 'jurnal_id'
    ];
    
    protected $table = 'jurnal_artikels';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
    
    //------------------- RELASI 1-N ---------------------------
    public function jurnals()
    {
        return $this->belongsTo('App\Jurnal', 'jurnal_id');
    }
    
    public function jurnalAuthors()
    {
        return $this->hasMany('App\JurnalAuthor', 'artikel_id');
    }
    
    //----------------------------------------------------------
}

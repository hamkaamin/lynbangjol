<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSlide extends Model
{
    
    protected $fillable = [
        'image_filename', 'isAktif'
    ];
    
    protected $table = 'home_slides';

    use SoftDeletes;
    protected $dates = ['delete_at'];
	
    protected $hidden = ['id'];
}

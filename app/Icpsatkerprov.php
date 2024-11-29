<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icpsatkerprov extends Model
{
    protected  $table = 'icp_satkerprovs';

    public function Customers()
    {
        return $this->hasMany('App\Customer');
    }


    public static function GetSatkerSelect($satker_id = 0)
    {
        $html = "<label for='satker_id' class='control-label'>Satker</label><select class='form-control' id='satker_id' name = 'satker_id'  placeholder='<< Isikan satker anda >>'>";

        $satkers = Icpsatkerprov::orderBy("namasatker", "ASC")->get();
        if($satkers) foreach($satkers as $satker) {
            $html .= ($satker->id==$satker_id)? 
            "<option value='$satker->id' selected=''>$satker->namasatker</option>":
            "<option value='$satker->id'>$satker->namasatker</option>";
        }

        $html.="</select>";
        return $html;
    }
}

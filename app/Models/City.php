<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';

    public function getCities($arrs){
        $data = [];
        foreach ($arrs as $arr){
            $data[] = City::select('zipCode','lat','long')->where('zipCode',$arr['zip'])->first();
        }

        return $data;
    }
}

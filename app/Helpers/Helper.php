<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Helper
{

    static function getPrice($zips, $vehicles){
        $dests = 0;
        $arrs = [];
        for ($i=0;$i<count($zips)-1;$i++){
            $dests += self::getDestination($zips[$i]['lat'],$zips[$i+1]['lat'],$zips[$i]['long'],$zips[$i+1]['long']);
        }

        foreach ($vehicles as $vehicle){
            if ($vehicle['minimum'] > $dests*$vehicle['cost_km']/1000){
                $arrs[] =   [
                    'vehicle_type'=>$vehicle['number'],
                    'price'=>$vehicle['minimum']
                    ];
            }
            else{
                $arrs[] =   [
                    'vehicle_type'=>$vehicle['number'],
                    'price'=>floatval(number_format(($dests/1000)*$vehicle['cost_km'],2))
                ];
            }
        }

        return $arrs;

    }

    private function getDestination($lat1,$lat2,$long1,$long2){
        $api = "https://maps.googleapis.com/maps/api/directions/json?origin=".$lat1."%2C".$long1."&destination=side_of_road%3A".$lat2."%2C".$long2."&key=AIzaSyA_z4H4vBv0Mn8og2T4c2_iWqJrfiLAIqY";
        $response = Http::get($api);
        $des = $response->json()['routes'][0]['legs'][0]['distance']['value'];
        return $des;
    }



}

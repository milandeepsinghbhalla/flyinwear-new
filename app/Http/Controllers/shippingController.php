<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\vendor;

class shippingController extends Controller
{
    //
    public function get_distances(Request $req){
        
        $vids = json_decode($req->vids);
        $api_key = "AIzaSyAGFJ_tbc0FYdLc3jwtHMg7BNCnRpODL-o";
        $origins = "";
        for($i=0;$i<count($vids);$i++){
            $current_vendor = vendor::find($vids[$i]);
            $current_address = json_decode($current_vendor->vendor_address_book);
            $current_pin = $current_address[0]->pincode;
            $origins .= $current_pin."|";
        }
        $origins =substr_replace($origins, "", -1);
        $destinations = $req->pincode;
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origins."&destinations=".$destinations."&key=".$api_key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);   
        return ["result"=>$res];
        //$origins = ""
        // $url = "https://www.javatpoint.com/";   
        // $curl = curl_init();
        // $res = curl_exec($ch);   
    }
}

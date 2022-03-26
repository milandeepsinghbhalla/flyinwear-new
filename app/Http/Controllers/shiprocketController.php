<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shiprocketController extends Controller
{
    //

    public function get_tocken(){
        $result= shiprocket_tockens::find(1);
        if($result){
            $cur_time = strtotime("now");
            $chk_time = $cur_time - 860400;
            if(((int)$result->created_time)>=$chk_time)
                return ['status'=>1,
                        'tocken'=>$result->tocken       
                ];
            else
                return ['status'=>0,'time_now'=> strtotime("now")];
        }
        else
            return ['status'=>0];
        return $result;
    }
    public function add_tocken(Request $req){
        if(shiprocket_tockens::find(1)){
            $result = shiprocket_tockens::find(1);
            $result->tocken = $req->tocken;
            $created_time = strtotime($req->created_time);
            $result->created_time = (string)$created_time;
            $result->save();
        }
        else{
            $new_tocken = new shiprocket_tockens;
            $new_tocken->tocken = $req->tocken;
            $created_time = strtotime($req->created_time);
            $new_tocken->created_time = (string)$created_time;
            $new_tocken->save();
        }
    }
    public function get_tocken_ship(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email": "milansingh7696@gmail.com",
            "password": "Milansingh@1"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return ["result"=> $response];
    }
}

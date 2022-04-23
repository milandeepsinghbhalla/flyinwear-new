<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\vendor;
use App\Models\user;

class vendorController extends Controller
{
    //
    public function add_vendor(Request $req){
        
        $vendor = vendor::where('vendor_email','=',$req->vendor_email)->first();
        if(!$vendor){
            $user = user::find($req->vid);
            if($user->role == "vendor" || $user->role =="admin_vendor"){
                return ["msg"=>"you are already a vendor","status"=>0];
            }
            else{
                if($user->role == "admin"){
                    $user->role = "admin_vendor";
                    $user->save();
                }
                else{
                    $user->role = "vendor";
                    $user->save();
                }
            }
            $new_vendor = new vendor();
            $new_vendor->vid = $req->vid;
            $new_vendor->name = $req->name;
            $new_vendor->vendor_email = $req->vendor_email;
            $new_vendor->shop_name = $req->shop_name;
            $new_vendor->vendor_phn_no = $req->vendor_phn_no;
            $new_vendor->vendor_address_book = $req->vendor_address_book;
            if($req->vendor_alternate_phn_no)
            $new_vendor->vendor_alternate_phn_no = $req->vendor_alternate_phn_no;
            $new_vendor->save();
            return ["msg"=>"Congrats..!! You are now a vendor...!!","status"=>1];

        }
        else{
            return ["msg"=>"sorry but that email is taken..!!","status"=>0];
        }
    }
    public function update_vendor_order(Request $req){
        $vendor = vendor::find($req->id);
        if($vendor->orders){
            $old_array = json_decode($vendor->orders);
            $new_array = json_decode($req->orders);
            $updated_array = array_merge($old_array,$new_array);
            $vendor->orders = json_encode($updated_array);
            $vendor->save();
        }
        else{
            $vendor->orders = $req->orders;
            $vendor->save();
        }
    }
    public function get_vendor_orders(Request $req){
        $vendor = vendor::find($req->id);
        if($vendor->orders){
            return ["orders"=> $vendor->orders];
        }
        else{
            $empty_array = [];
            $empty_array = json_encode($empty_array);
            return ["orders"=> $empty_array];
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\user;

class user_controller extends Controller
{
    //

    public function add_user(Request $req){
        $new_user = new user;
        if(!(user::where('email','=',$req->email)->exists())){
            $new_user->name = $req->name;
            $new_user->email = $req->email;
            $new_user->number = $req->number;
            $new_user->role = $req->role;
            $new_user->password = Hash::make($req->password);
            $new_user->cart = $req->cart;
            $result = $new_user->save();
            if($result){
                return ['result'=>'user signed up as ' . $req->name,
                        'check_status'=> 1        
                ];
            }
        }
        else{
            return ['result'=>'user with that email already present',
                    'check_status'=> 0,
                    'req'=> $req->email
            ];
        }
    }
    public function add_vendor(Request $req){
        if(user::where('email','=',$req->email)->exists()){
            $user  = user::where('email','=',$req->email)->first();
            if($user->role == "vendor" || $user->role =="admin_vendor"){
                return ["result"=>"user already a vendor", "status"=>0];
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
                return ["result"=>"user added as vendor", "status"=>1];
            }
        }
        else{
            return ["result"=>"no user with that email", "status"=>0];
        }

    }
    public function remove_vendor(Request $req){
        if(user::where('email','=',$req->email)->exists()){
            $user  = user::where('email','=',$req->email)->first();
            if($user->id!=1){
                if($user->role != "vendor" && $user->role !="admin_vendor"){
                    return ["result"=>"user already not a vendor", "status"=>0];
                }
                else{
                    if($user->role == "admin_vendor"){
                        $user->role = "admin";
                        $user->save();
                    }
                    else{
                        $user->role = "user";
                        $user->save();
                    }
                    return ["result"=>"user removed as vendor", "status"=>1];
                }
            }
            else{
                return ["result"=>"cant remove uper user","status"=>0];
            }
        }
        else{
            return ["result"=>"no user with that email", "status"=>0];
        }

    }
    public function add_admin(Request $req){
        if(user::where('email','=',$req->email)->exists()){
            $user  = user::where('email','=',$req->email)->first();
            if($user->role == "admin" || $user->role == "admin_vendor"){
                return ["result"=>"user already an admin", "status"=>0];
            }
            else{
                if($user->role == "vendor"){
                    $user->role = "admin_vendor";
                    $user->save();
                }
                else{
                    $user->role = "admin";
                    $user->save();
                }
                return ["result"=>"user added as admin", "status"=>1];
            }
        }
        else{
            return ["result"=>"no user with that email", "status"=>0];
        }
    }
    public function remove_admin(Request $req){
        if(user::where('email','=',$req->email)->exists()){
            $user  = user::where('email','=',$req->email)->first();
            if($user->id !=1){
                if($user->role != "admin" && $user->role != "admin_vendor"){
                    return ["result"=>"user already not an admin", "status"=>0];
                }
                else{
                    if($user->role == "admin_vendor"){
                        $user->role = "vendor";
                        $user->save();
                    }
                    else{
                        $user->role = "user";
                        $user->save();
                    }
                    return ["result"=>"user removed as admin", "status"=>1];
                }
            }
            else{
                return ["result"=>"cant remove super user","status"=>0];
            }
        }
        else{
            return ["result"=>"no user with that email", "status"=>0];
        }
    }
    public function login_user(Request $req){
        
        $user = user::where("email","=",$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                
                    $req_cart = json_decode($req->cart);
                    $current_cart = json_decode($user->cart);
                    $new_cart = [];
                    for($i=0;$i<count($req_cart);$i++){
                        $chk = 0;
                        for($x=0;$x<count($current_cart);$x++){
                            if($current_cart[$x]->cart_id==$req_cart[$i]->cart_id){
                                $chk = 1;
                                // return ["msg" =>"chked"];
                                break;
                            }

                        }
                        if($chk==0){
                            array_push($new_cart,$req_cart[$i]);
                        }
                    }
                    $current_cart = array_merge($current_cart,$new_cart);
                    $user->cart = json_encode($current_cart);
                    $user->save();
                $current_user  = $user;
               
                $current_user->password = null;
                
                return ["status"=>1,"current_user"=> $current_user,"msg"=>"Logged successfully"];
            }
            else{
                return["status"=>0,"msg"=>"wrong password"];
            }
        }
        else{
            return ["msg"=> "there is no user with that email"];
        }
    }
    public function update_cart(Request $req){
        $user = user::find($req->id);
        $user->cart = $req->cart;
        $user->save();
    }
    public function get_wishlist(Request $req){
        $user = user::find($req->id);
        if($user->wishlist){
            return ["wishlist"=> $user->wishlist];
        }
        else{
            $empty_array = [];
            $empty_array = json_encode($empty_array);
            return ["wishlist"=> $empty_array];
        }
    }
    public function update_wishlist(Request $req){
        $user = user::find($req->id);
        $user->wishlist = $req->wishlist;
        $user->save();
    }
    public function update_address_book(Request $req){
        $user = user::find($req->id);
        $user->address_book = $req->address_book;
        $user->save();
    }
    public function get_address_book(Request $req){
        $user = user::find($req->id);
        if($user->address_book){
            return ["address_book"=> $user->address_book];
        }
        else{
            $empty_array = [];
            $empty_array = json_encode($empty_array);
            return ["address_book"=> $empty_array];
        }
    }
    public function update_user_order(Request $req){
        $user = user::find($req->id);
        
        if($user->orders){
            $old_array = json_decode($user->orders);
            $new_array = json_decode($req->orders);
            $updated_array = array_merge($old_array,$new_array);
            $user->orders = json_encode($updated_array);
            $user->save();
        }
        else{
            $user->orders = $req->orders;
            $user->save();
        }

    }
    public function get_user_orders(Request $req){
        $user = user::find($req->id);
        if($user->orders){
            return ["orders"=> $user->orders];
        }
        else{
            $empty_array = [];
            $empty_array = json_encode($empty_array);
            return ["orders"=> $empty_array];
        }
    }
}

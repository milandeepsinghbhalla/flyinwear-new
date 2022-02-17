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
}

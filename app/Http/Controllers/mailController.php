<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use Mail;
class mailController extends Controller
{
    //
    public function send_order_mail(Request $req){
        $vendor = vendor::find($req->id);
        $email = $vendor->vendor_email;
        $name = $vendor->name;
        $data = ["vendor_name"=>$name];
        Mail::send('order_mail',$data,function($messages) use ($email){
            $messages->to($email);
            $messages->subject('You got a new order');
        });
    }
}

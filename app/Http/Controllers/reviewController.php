<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review;

class reviewController extends Controller
{
    //
    public  function post_review(Request $req){
        $new_review = new review();
        $new_review->uid = $req->uid;
        $new_review->pid = $req->pid;
        $new_review->review_data = $req->review_data;
        $new_review->save();
        return ["status"=>1,"msg"=>"review posted successfully..!!"];
    }
    public function check_review(Request $req){
        $review = review::where('pid','=',$req->pid)->where('uid','=',$req->uid)->get();
        if(count($review)>0){
            return ["status"=>1];
        }
        else{
            return ["status"=>0];
        }
    }
    public function get_reviews(Request $req){
        $reviews = review::where('pid','=',$req->pid)->get();
        return ["reviews"=> $reviews];
    }
}

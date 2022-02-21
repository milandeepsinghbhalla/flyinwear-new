<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\all_product;

class productcontroller extends Controller
{
    //
    public function add_product_clothing(Request $req){
        DB::beginTransaction();
        $new_product = new all_product();
        $new_product->title = $req->title;
        $new_product->stock = (int) $req->stock;
        $new_product->t_name = $req->t_name;
        $result1 = $new_product->save();
        $id = $new_product->id;
        $t_name = $new_product->t_name;
        if($result1){
            $ext = $req->file('img_1')->extension();
            $req->file('img_1')->storeAs('public/product_images','img_1_'.$id.'.'.$ext);
            $main_img_link = 'storage/product_images/img_1_'.$id.'.'.$ext;
            $other_imgs_links = array();
            for($counter=2;$counter<=($req->img_no);$counter++){
                $ext = $req->file('img_'.$counter)->extension();
                $req->file('img_'.$counter)->storeAs('public/product_images','img_'.$counter.'_'.$id.'.'.$ext);
                $link = 'storage/product_images/img_'.$counter.'_'.$id.'.'.$ext;
                array_push($other_imgs_links,$link);
            }
            $key = "clothing-".$req->t_name."-". $id;
            $result2 = DB::table($t_name)->insert([
                'id'=> (int)$id,
                'title'=> $req->title,
                'card_img'=> $main_img_link,
                'price'=> (float)$req->price,
                'stock'=> (int)$req->stock,
                'weight'=> $req->weight,
                'colors'=> json_encode(json_decode($req->colors)),
                'fabric'=> $req->fabric,
                'images'=> json_encode($other_imgs_links),
                'bid'=> $req->bid,
                'stock_s'=> (int)$req->stock_s,
                'stock_m'=> (int)$req->stock_m,
                'stock_l'=> (int)$req->stock_l,
                'stock_xl'=> (int)$req->stock_xl,
                'stock_2xl'=> (int)$req->stock_2xl,
                'stock_3xl'=> (int)$req->stock_3xl,
                'stock_4xl'=> (int)$req->stock_4xl,
                'stock_5xl'=> (int)$req->stock_5xl,
                'key'=> $key,
                'keywords'=> $req->keywords
            ]);
            if($result2){
                DB::commit();
                return ['status'=>1,'message'=>'product added successfuly!!'];
            }
            else{
                DB::rollback();
                return ['status'=>0,'message'=>'error in adding result 2'];
               
            }
        }
        else{
            DB::rollback();
            return ['status'=>-1,'message'=>'error in adding result 1'];
        }
    }
    public function add_product_other(Request $req){
        DB::beginTransaction();
        $new_product = new all_product();
        $new_product->title = $req->title;
        $new_product->stock = (int) $req->stock;
        $new_product->t_name = $req->t_name;
        $result1 = $new_product->save();
        $id = $new_product->id;
        $t_name = $new_product->t_name;
        if($result1){
            $ext = $req->file('img_1')->extension();
            $req->file('img_1')->storeAs('public/product_images','img_1_'.$id.'.'.$ext);
            $main_img_link = 'storage/product_images/img_1_'.$id.'.'.$ext;
            $other_imgs_links = array();
            for($counter=2;$counter<=($req->img_no);$counter++){
                $ext = $req->file('img_'.$counter)->extension();
                $req->file('img_'.$counter)->storeAs('public/product_images','img_'.$counter.'_'.$id.'.'.$ext);
                $link = 'storage/product_images/img_'.$counter.'_'.$id.'.'.$ext;
                array_push($other_imgs_links,$link);
            }
            $key = "other-".$req->t_name."-". $id;
            $result2 = DB::table($t_name)->insert([
                'id'=> (int)$id,
                'title'=> $req->title,
                'card_img'=> $main_img_link,
                'price'=> (float)$req->price,
                'stock'=> (int)$req->stock,
                'weight'=> $req->weight,
                'colors'=> json_encode(json_decode($req->colors)),
                'images'=> json_encode($other_imgs_links),
                'bid'=> $req->bid,
                'features'=> $req->features,
                'key'=> $key,
                'keywords'=> $req->keywords
            ]);
            if($result2){
                DB::commit();
                return ['status'=>1,'message'=>'product added successfuly!!'];
            }
            else{
                DB::rollback();
                return ['status'=>0,'message'=>'error in adding result 2'];
               
            }
        }
        else{
            DB::rollback();
            return ['status'=>-1,'message'=>'error in adding result 1'];
        }
    }
    public function get_all_products(){
        $result= DB::table('all_products')->get();
        return $result;
    }
    public function get_products(Request $req){
        $result = DB::table($req->t_name)->get();
        $result->product_details = null;
        return $result;
    }
    public function delete_product(Request $req){
        
    }
}

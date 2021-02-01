<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\cart;


class ProductController extends Controller
{
    //
    public function addproduct(Request $req){
        // return'hejj';
        $user=   
        $validator=Validator::make($req->all(),
        [
            "dishname"=>"required",
            "available"=>"required",
            "price"=>"required",
        ]
    );
    if($validator->fails()) {
        return response()->json(["validation_errors" => $validator->errors()]);
    }
        $task=array(
        "dishname"=>$req->dishname,
        "available"=>$req->available,
        "price"=>$req->price,
    );
        $task=Product::create($task);
        if(!is_null($task)) {
            return response()->json(["status" =>200, "success" => true, "data" => $task]);
        }

        else {
            return response()->json(["status" => "failed","success" => false, "message" => "task not created."]);
        }
        
    }
    public function update(Request $req){
        $data=Product::find($req->id);
        $data->dishname=$req->dishname;
        $data->available=$req->available;
        $data->price=$req->price;
        $result=$data->save();
        if($result){
            return response()->json(["status" =>200, "success" => true,"message" => "Data has been updated." ]);
        }

        else {
            return response()->json(["status" => "failed","success" => false, "message" => "Failed to update data."]);
        }
    }


    public function delete($task_id){
        $user=Auth::user();
        if($task_id == 'undefined' || $task_id == "") {
            return response()->json(["status" => "failed", "success" => false, "message" => "Alert! enter the task id"]);
        }
        $task=Product::find($task_id);
        if(!is_null($task)) {
            $delete_status=Product::where("id", $task_id)->delete();
            if($delete_status == 1) {

                return response()->json(["status" =>200, "success" => true, "message" => "Success! Product deleted"]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Alert! product not deleted"]);
            }
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Alert! product not found"]);
        }
    }
    public function addtocart(Request $req){
        // return'hejj';
        $user=   
        $validator=Validator::make($req->all(),
        [
            "product_id"=>"required",
            "user_id"=>"required",
        ]
    );
    if($validator->fails()) {
        return response()->json(["validation_errors" => $validator->errors()]);
    }
        $task=array(
        
        "product_id"=>$req->product_id,
        "user_id"=>$req->user_id
    );
        $task=Cart::create($task);
        if(!is_null($task)) {
            return response()->json(["status" =>200, "success" => true, "data" => $task]);
        }

        else {
            return response()->json(["status" => "failed","success" => false, "message" => "task not created."]);
        }
        
    }
       
    public function cartlist(){
        $tasks=array();
        $user=Auth::user();
        $tasks=Cart::all();
        if(count($tasks) > 0) {
            return response()->json(["status" =>200, "success" => true, "count" => count($tasks), "data" => $tasks]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => " found"]);
        }
    }
    public function destroy($id) {
        $data = Cart::find($id);

        $data->delete();

        return response()->json(["status" => "failed", "success" => false, "message" => "Remoed  from cart"]);
    }

}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [UserController::class,'login']);

Route::post('/register',[UserController::class,'register']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', [UserController::class,'details']);
Route::post("addproduct", [ProductController::class,'addproduct']);
Route::put("update", [ProductController::class,'update']);
Route::delete("delete/{task_id}", [productController::class,'delete']); 
Route::post("addtocart", [productController::class,'addtocart']);
Route::get("cartlist", [productController::class,'cartlist']);

Route::delete("remove/{id}", [productController::class,'remove']); 
});
    

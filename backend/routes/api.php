<?php
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Char;
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::get('/csrf-token',function(){
  return  response()->json(['token'=>csrf_token()]);
});
Route::middleware('auth:sanctum')->get('/checkrole',[authcontroller::class,'checkRole']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[authcontroller::class,'logout']);


Route::get('/products',[ProductController::class,'index']);
Route::post('/products/create',[ProductController::class,'store']);
Route::get('product/{id}/edit',[ProductController::class,'edit']);
Route::post('product/{id}/update',[ProductController::class,'update']);
Route::delete('product/{id}',[ProductController::class,'destroy']);
Route::get("/products/{id}",[ProductController::class,'singleProduct']);



Route::get('/message',[MessageController::class,'index']);
Route::post('/message/create',[MessageController::class,'store']);



Route::get('/categories',[CategoryController::class,'index']);
Route::post('/categoryies/create',[CategoryController::class,'store']);
Route::delete('/categories/{category}/delete',[CategoryController::class,'destroy']);
Route::post('/categories/{category}/update',[CategoryController::class,'update']);
Route::get('/categories/{category}/edit',[CategoryController::class,'edit']);



Route::get('/orders',[OrderController::class,'index']);
Route::post('/orders/create',[OrderController::class,'store']);
Route::put('/orders/{order}/update', [OrderController::class, 'update']);



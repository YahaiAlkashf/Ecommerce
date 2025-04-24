<?php
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Char;
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/csrf-token',function(){
    return  response()->json(['token'=>csrf_token()]);
});
Route::middleware('auth:sanctum')->get('/checkrole',[authcontroller::class,'checkRole']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[Authcontroller::class,'logout']);
Route::get('/auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::apiResource('products',ProductController::class);
Route::get('/search',[ProductController::class,'search']);
Route::apiResource('messages',MessageController::class)->only([
    'index','store'
]);

Route::apiResource('categories',CategoryController::class);

Route::apiResource('orders',OrderController::class)->only([
    'index','store','update'
]);


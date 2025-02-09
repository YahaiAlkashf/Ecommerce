<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommercecontroller;



Route::get('/home',[Ecommercecontroller::class,'index'] )->name('home');

Route::get('/dashboard',[Ecommercecontroller::class,'dashboard'])->name('dashboard');

Route::get('/pruducts/create',[Ecommercecontroller::class,'create'])->name('pruducts.create');

Route::post('/pruducts',[Ecommercecontroller::class,'store'])->name('pruducts.store');

Route::get('/pruducts/{pruduct}/edit',[Ecommercecontroller::class,'edit'])->name('pruducts.edit');

Route::put('/pruducts/{product}',[Ecommercecontroller::class,'update'])->name('products.update');

Route::delete('/pruducts/{product}',[Ecommercecontroller::class,'delete'])->name('products.delete');
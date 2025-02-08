<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommercecontroller;



Route::get('/home',[Ecommercecontroller::class,'index'] )->name('home');

Route::get('/dashboard',[Ecommercecontroller::class,'dashboard'])->name('dashboard');

Route::get('/pruducts/create',[Ecommercecontroller::class,'create'])->name('pruducts.create');

Route::post('/pruducts',[Ecommercecontroller::class,'store'])->name('pruducts.store');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ecommercecontroller extends Controller
{
    public function index(){
        return view('index');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function create(){
     return view('create');
    }

    public function store(){
        return to_route('dashboard');
    }
}

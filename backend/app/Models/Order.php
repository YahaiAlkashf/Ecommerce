<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable=['name','status','phone','address','products','alternative_phone','total_price','payment_method'];

    public function products(){
      return  $this->belongsToMany(Product::class);
    }
}

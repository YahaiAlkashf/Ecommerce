<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table ='productimages';
    protected $fillable=['product_id','productImage'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

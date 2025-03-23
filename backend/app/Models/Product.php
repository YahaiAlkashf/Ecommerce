<?php

namespace App\Models;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $fillable=[
        'name',
        'description',
        'price',
        'rating',
        'category_id',

    ];

    public function Orders(){
       return $this->belongsToMany(Order::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}

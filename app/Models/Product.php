<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory , softDeletes;

    protected $fillable = [
        'title',
        'shop_id',
        'price',
        'discount',
        'image',
        'description',
        
    ];


    protected $cost = ['cost'];

    public function getCostAttribute(){
        return $this->price - (($this->price * $this->discount) / 100);
    }

    public function shop(){
        return $this->belongsTo(Shop::class , 'shop_id');
    }


    public function isInCart(){
        $user = auth()->user();
        if($user){
            $cart = Cart::where('user_id' , $user->id)->where('paid' , 0 )->first();
            if($cart){
                return CartItem::where('cart_id' , $cart->id)->where('product_id' , $this->id)->first();
            }
        }
    }



    public function comments()
    {
        return $this->morphMany(Comment::class , 'owner');
    }
}

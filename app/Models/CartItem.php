<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'cart_id',
    //     'product_id',
    //     'count',
    //     'pay',
    //     'created_at',
    //     'updated_at'
    // ];

    protected $guarded = ['id'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function cart()
    {
        return $this->belongsTo(Cart::class , 'cart_id' , 'id');
    }


}

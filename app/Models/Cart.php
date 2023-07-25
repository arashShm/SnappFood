<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;

class Cart extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'created_at',
    //     'updated_at'
    // ];

    protected $guarded = ['id'];
    protected $appends = ['sum', 'count'];


    public function items()
    {
        return $this->hasMany(CartItem::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function getSumAttribute()
    {
        return CartItem::where('cart_id', $this->id)->sum('pay');
    }



    public function getCountAttribute()
    {
        return CartItem::where('cart_id', $this->id)->sum('count');
    }



}

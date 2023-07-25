<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory , softDeletes;
    
    protected $fillable = [
        'title',
        'user_id',
        'first_name',
        'last_name',
        'telephone',
        'address'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name ; 
    }



    public function user(){
        return $this->belongsTo(User::class , 'user_id' );
    }

    
    protected $appends2 = ['full_rest'];

    public function getFullRestAttribute(){
        return $this->id . ' - ' . $this->title ; 
          
    }


    public function products(){
        return $this->hasMany(Product::class) ;
    }



    public function comments()
    {
        return $this->morphMany(Comment::class , 'owner');
    }

    
}

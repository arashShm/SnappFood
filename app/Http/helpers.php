<?php 

use App\Models\Shop ;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;




function persianDate($enDate){
    $perDate = \Morilog\Jalali\Jalalian::fromCarbon($enDate);
    return $perDate->format('Y-m-d');
}

function short($string, $max=50)
{
    return mb_strlen($string) > $max ? mb_substr($string, 0, $max).'...' : $string;
}

function upload($newFile)
{
    $filename = randomSHA().".".$newFile->getClientOriginalExtension();
    $newFile->move(base_path('storage/app/public'), $filename);
    return "storage/$filename";
}

function deleteFile($path)
{
    \File::delete($path);
}

function randomSHA()
{
    return bin2hex(random_bytes(10));
}


function currentShopId(){
    $shop = Shop::where('user_id', auth()->id())->first();
    return $shop->id ?? 0 ;
}




function checkPolicy($case , $object){
    switch ($case) {
        case 'product':
            if($object->shop_id != currentShopId() ){
                abort(404);
            }
        break;
        
        default:
            abort(404);
            break;
    }
}


function cartCount(){

    $user = auth()->user();
    $count = 0;
    
    if($user){
        $cart = Cart::where('user_id' , $user->id)->where('paid' , 0 )->first();
        if($cart){
            $count =CartItem::where('cart_id', $cart->id)->sum('count');
        }

    }
    
    return $count ;
}





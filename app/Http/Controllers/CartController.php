<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Log\Events\MessageLogged;

class CartController extends Controller
{




    public function manage(Product $product, Request $request)
    {
        
        $type = $request->type;
        $currentLoggedInUser = auth()->user();
        if ($currentLoggedInUser) {
            // $cart = Cart::where('user_id' , $currentLoggedInUser->id)->first();
            // if(!$cart){
            //     $cart = Cart::create([
            //         'user_id' => $currentLoggedInUser->id
            //     ]);
            // }
            // dd($cart);

            $cart = Cart::firstOrCreate(['user_id' => $currentLoggedInUser->id, 'paid' => 0]);
            if ($cart_item = $product->isInCart()) {
                if ($type == 'add')
                    $cart_item->count++;
                elseif ($type == 'minus') {
                    $cart_item->count--;
                }
                if ($cart_item->count == 0) {
                    $cart_item->destroy($cart_item->id);
                } else {
                    $cart_item->pay = $cart_item->count * $product->cost;
                    $cart_item->save();
                }
            } else {
                $cart_item = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'count' => 1,
                    'pay' => $product->cost
                ]);
            }


            return [
                'count' => $cart_item->count,
                'totalCount' => $cart->count
            ];
        } else {

            return [
                'error' => '!Please LOGIN to your ACCOUNT first'
            ];
        }
    }



    public function destroy(CartItem $cart_item)
    {
        $cart_item->delete();
        return back()->withMessage('!Food REMOVED from your cart SUCCESSFULLY');
    }



    public function pay()
    {
        // $currentLoggedInUser = auth()->user();
        $cart = Cart::where('user_id', auth()->id())->where('paid', 0)->first();
        if (!$cart) {
            return back()->withError('!No Carts FOUND');
        }
        $cart->paid = 1;
        $cart->code = rand(10000, 99999);
        $cart->save();
        return back()->withMessage("!Your Bill is PAID SUCCESSFULLY . Your Code is : $cart->code");
    }
}

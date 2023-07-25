<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product ;
use App\Models\Cart ;
use App\Models\Shop;

class PublicController extends Controller
{
    


    public function public(){

        return view('welcome');
    }


    


    public function products(Request $request){

        $products= Product::query();

        if(request('food')){       //$p = request('food')
            $products= $products->where('title', 'like' , "%$request->food%");
        }

        if(request('order')){
            if(request('order') == 1){
                $products = $products->orderBy('price' , 'DESC');
            }elseif(request('order') == 2 ){
                $products = $products->orderBy('price', 'ASC');
            }elseif(request('order') == 3){
                $products = $products->orderBy('created_at' ,'DESC');
            }
        }

        $products = $products->paginate(6);
        return view('public.products' , compact('products'));
    }




    public function shops(){

        $shops = Shop::paginate(6);
        return view('public.shops' , compact('shops'));
    }


    public function carts(){

        $user_id = auth()->id();
        $cart = Cart::where('user_id' , $user_id)->where('paid', 0)->first();
        return view('public.cart' , compact('cart'));
    }



    public function showShop(Shop $shop){

        $products = Product::where('shop_id', $shop->id)->paginate(6);
        return view('public.shop.shop' , compact('shop' , 'products'));
    }



    public function showShopInfo(Shop $shop){

        return view('public.shop.info'  , compact('shop'));
    }



    public function showShopProduct(Shop $shop){

        // $products = Product::where('shop_id', $shop->id);
        // $products->paginate(6);
        $products = $shop->products()->paginate(6) ;
        return view('public.shop.product' , compact('shop' , 'products'));
    }


    public function singleProduct(Product $product){
        
        return view('public.product' , compact('product')) ;
    }
}

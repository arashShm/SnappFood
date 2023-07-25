<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart as Order ;
use App\Models\CartItem ;
use App\Models\Product ;
use App\Models\Shop ;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only('destroy');
        $this->middleware('admins')->only('changeStatus');
    }


    public function index()
    {
        $currentLoggedInUser = auth()->user();
        if($currentLoggedInUser->role == 'shop'){

            $currentShop= Shop::where('user_id', $currentLoggedInUser->id)->first();
            $product_id = Product::where('shop_id' , $currentShop->id)->pluck('id')->toArray();
            $items = CartItem::whereIn('product_id' , $product_id)->paginate(10);
            return view('order.shop_index' , compact('items'));
        }else{
            $orders = Order::query();
            if($currentLoggedInUser->role == 'user'){
                $orders= $orders->where('user_id' , $currentLoggedInUser->id);
            }
        }


        $orders = $orders->paginate(10);
        return view('order.index', compact('orders'));
    }



    public function show(Order $order)
    {
        return view('order.show' , compact('order'));
    }




    public function changeStatus(CartItem $cart_item , Request $request)
    {
        $cart_item->status = $request->status ;
        $cart_item->save() ;
        return back()->withMessage('The Order Status CHANGED SUCCESSFULLY!') ;
    }



    public function destroy(Order $order)
    {
        $order->delete();
        CartItem::where('cart_id', $order->id)->delete();
        return back()->withMessage('The Order DELETED SUCCESSFULLY!') ;
    }




}

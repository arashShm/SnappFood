<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Shop;

class ProductController extends Controller
{






    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }








    public function index(Request $request)
    {

        $shops = Shop::all();
        $products = Product::query();



        if (auth()->user()->checking('admin')) {

            if ($request->byResturant) {
                $products = $products->where('shop_id', $request->byResturant);
            }
        } elseif(auth()->user()->checking('shop')) {
            if($request->byResturant){
                $products = $products->where('shop_id', currentShopId(), $request->byResturant);
            }else{
                $products = $products->where('shop_id', currentShopId());
            }
        }

        //title input
        if ($request->byTitle) {
            $products = $products->where('title', 'like', "%$request->byTitle%");
        }

        //Deleted options CheckBox
        if ($request->byDeleted) {
            $products = $products->withTrashed();
        }


        if ($order = $request->order) {
            if ($order == 1) {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($order == 2) {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($order == 3) {
                $products = $products->orderBy('created_at', 'DESC'); ///latest() == orderBy('created_at', 'DESC');
            } elseif ($order == 4) {
                $products = $products->orderBy('created_at', 'ASC');
            }
        }
        $products = $products->paginate(10);
        return view('product.index', compact('products', 'shops'));
    }





    public function create()
    {
        $shops = Shop::all();
        return view('product.create', compact('shops'));
    }






    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|between:0,100',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);


        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }


        if (!$data['discount']) {
            $data['discount'] = 0;
        }


        $user = auth()->user();
        if ($user->checking('admin')) {
            $data['shop_id'] = $request->shop_id;
        } else {
            $data['shop_id'] = currentShopId();
        }

        Product::create($data);
        return redirect()->route('product.index')->withMessage('Your Food is ADDED to list SUCCESSFULLY!');
        // dd($request->all());

    }









    public function edit(Product $product, Request $request)
    {

        // checkPolicy('product', $product);
        if (auth()->user()->checking('admin')) {
            $data['shop_id'] = $request->shop_id;
        } else {
            checkPolicy('product', $product);
        }

        $shops = Shop::all();
        return view('product.edit', compact('product', 'shops'));
    }







    public function update(Request $request, Product $product)
    {
        // checkPolicy('product', $product);
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'price' => 'required|integer',
            'discount' => 'nullable|integer|between:0,100',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if (auth()->user()->checking('admin')) {
            $data['shop_id'] = $request->shop_id;
        } else {
            checkPolicy('product', $product);
        }

        // $user = auth()->user();
        // if ($user->checking('admin')) {
        //     $data['shop_id'] == $request->shop_id;
        // }
        // }else{
        //     // Access and Edit own products
        //     checkPolicy('product', $product);
        // };



        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }

        $product->update($data);
        return redirect()->route('product.index')->withMessage('Food is UPDATED SUCCESSFULLY!');
    }





    public function destroy(Product $product, Request $request)
    {
        if (auth()->user()->checking('admin')) {
            $data['shop_id'] = $request->shop_id;
        } else {
            checkPolicy('product', $product);
        }
        $product->delete();
        return redirect()->route('product.index')->withMessage('Food DELETED SUCCESSFULLY!');
    }




    public function restore($id)
    {
        // checkPolicy('product', $id);


        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('product.index')->withMessage('Food RESTORED SUCCESSFULLY!');
    }
}

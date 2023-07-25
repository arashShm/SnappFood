<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use App\Notifications\NewShop;

class ShopController extends Controller
{


    public function __construct(){
        $this->middleware(['auth' , 'admin']);
    }


    public function index(Request $request)
    {
        $shops = Shop::query();


        //order
        if($order = $request->order){
            if($order ==1){
                $shops = $shops->orderBy('created_at', 'DESC');
            }elseif($order == 2){
                $shops = $shops->orderBy('created_at', 'ASC');
            }
        }


        //Title input
        if($request->byName){
            $shops = $shops->where('title' ,'like' ,"%$request->byName%");
        }

        //phone input
        if($request->byPhone){
            $shops = $shops->where('telephone' ,'like' ,"%$request->byPhone%");
        }

        //Deleted options CheckBox
        if ($request->byDeleted) {
            $shops = $shops->withTrashed();
        }



        $shops= $shops->paginate(10);
        return view('shop.index' , compact('shops')) ;
    }









    public function create()
    {
        return view('shop.create');
    }






    public function store(Request $request)
    {

        //validate incoming data(Request)
        $data = $request->validate([
            'title' => 'required|string|unique:shops,title|between:3,100',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,name',
            'address' => 'nullable',
        ]);


        //create user in db
        $randomPass = rand(1000 , 9999);
        $user = User::create([
            'name' => $request->username,
            'email' =>$request->email,
            'role' => 'shop',
            'email_verified_at' => now(),
            'password' => bcrypt($randomPass) 
        ]);

        // create Shop in db
        Shop::create([
            'title' => $request->title,
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'address'=> $request->address
        ]);


        $user->notify(new NewShop($user->email , $randomPass));

        return redirect()->route('shop.index')->withMessage('A New Resturant ADDED SUCCESSFULLY!') ;
    
    }

    public function show(Shop $shop)
    {
        //
    }

    public function edit(Shop $shop)
    {
        return view('shop.edit' , compact('shop'));
    }


    public function update(Request $request, Shop $shop)
    {
        //edition validate
        $data = $request->validate([
            'title' => 'required|string|between:3,100|unique:shops,title,'.$shop->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'address' => 'nullable',
        ]);
        $shop->update($data);
        return redirect()->route('shop.index')->withMessage('Resturant UPDATED SUCCESSFULLY!');
    }



    public function destroy(Shop $shop)
    {
        User::where('id',$shop->user_id)->delete();
        $shop->delete();
        return redirect()->route('shop.index')->withMessage('Resturant DELETED SUCCESSFULLY!');
    }




    public function restore($id)
    {
        // checkPolicy('product', $id);


        $shop = Shop::withTrashed()->find($id);
        $shop->restore();
        return redirect()->route('shop.index')->withMessage('Resturant RESTORED SUCCESSFULLY!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment ;

class CommentController extends Controller
{



    public function store(Request $request)
    {

        $currentLoggedInUser = auth()->user();

        $class = 'App\Models\\'.$request->owner_type ;
        Comment::create([
            'text' => $request->text ,
            'user_id' => $currentLoggedInUser->id ,
            'owner_id' => $request->owner_id,
            'owner_type' => $class,

        ]);

        return back()->withMessage('Your Comment is SENT SUCCESSFULLY');


    }


}

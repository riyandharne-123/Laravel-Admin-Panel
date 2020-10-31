<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\User;

class UserController extends Controller
{
	//upload profile picture
    public function upload(Request $request)
    {

    	if($request->hasFile('image'))
    	{
        $filename =$request->image->getClientOriginalName(); 
        $this->deleteOldImage();
       $request->image->storeAs("images",$filename,"public");
       auth()->user()->update(['avatar' => $filename]);
       $request->session()->flash('message','Image Uploaded');
    }
    $request->session()->flash('error','Image Not Uploaded');
    return redirect()->back();
    }

	//delete old profile picture
    protected function deleteOldImage()
    {
    	        if(auth()->user()->avatar)
        {
        	Storage::delete('/public/images/'.auth()->user()->avatar);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\sortDesc;
use Illuminate\Support\Facades\Hash;
use App\Charts\UserChart;
use App\User;

class AdminController extends Controller
{


    public function index(Request $request)
    {
    	        if(auth()->user()->user_type == 'Admin')
        {
        	$data = User::all()->sortDesc();
            $total_users =User::count();
            $admin_users =User::where('user_type' , 'Admin')->count();
            $standard_users =User::where('user_type' , 'Standard')->count();
            //creating user charts
            $chart = new UserChart;
            $chart->labels(User::pluck('created_at')->values());
            $chart->dataset('Total Users' ,'bar',User::pluck('created_at')->keys());

        return view('admin.index')->with([
            'users' => $data,'total_users' => $total_users,
            'admin_users' => $admin_users,
            'standard_users' => $standard_users,
            'user_chart' =>$chart,
            ]);
        }
        else
        {
        	$request->session()->flash('error','Forbidden');
           return redirect()->back();
        }
    }

     public function store(Request $request)
    {
   User::create([
            'name' => $request['username'],
            'email' => $request['useremail'],
            'user_type' => $request['usertype'],
            'password' => Hash::make($request['userpassword']),
        ]);
}

public function destroy(Request $request)
{
//dd($request->all());
    User::where('id' ,$request->user_id)->delete();
        $request->session()->flash('message','User Deleted');
        return redirect()->back();
}

public function update(Request $request)
{
//dd($request->all());
     User::Where('id',$request->user_id) ->update([
    'name' => $request->username,
    'user_type' =>$request->usertype,
  ]);
        $request->session()->flash('message','User Updated');
         return redirect()->back();
}


}

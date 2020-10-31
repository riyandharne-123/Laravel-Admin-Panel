<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Database\Eloquent\sortDesc;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::all()->sortDesc();
    	return view('todos.index')->with('todos',$data);
    }

      public function store(Request $request)
    {
    	Todo::create($request->all());
         $request->session()->flash('message','Todo Created');
            return redirect()->back();
    }
    public function destroy(Request $request)
{
//dd($request->all());
    Todo::where('id' ,$request->todo_id)->delete();
        $request->session()->flash('message','Todo Deleted');
        return redirect()->back();
}


     public function edit(Request $request)
    {
    	//dd($request->all());
        $status=0;
        if($request->status == 'true')
        {
             $status=1;
        }
      else if($request->status == 'flase')
        {
             $status=0;
        }
     Todo::Where('id',$request->todo_id) ->update([
    'title' => $request->title,
    'completed' =>$status,
  ]);
        $request->session()->flash('message','Todo Updated');
         return redirect()->back();
    }
}

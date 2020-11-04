<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Database\Eloquent\sortDesc;
use App\Charts\TodoChart;

class TodoController extends Controller
{
    public function index()
    {
      $userId = Auth::user()->id;
      $data = Todo::where('user_id',$userId)->get();
//todo charts
$complete_todos =Todo::where(['completed' => '1', 'user_id' => $userId,])->count();
$incomplete_todos =Todo::where(['completed' => '0', 'user_id' => $userId,])->count();
    $chart = new TodoChart;
    $chart->labels(['','']);
    $chart->dataset('Complete Todos' ,'line',[$complete_todos])->backgroundColor('#7FFF00');
    $chart->dataset('Incomplete Todos' ,'line',[$incomplete_todos])->backgroundColor('#B22222');

      return view('todos.index')->with([
        'todos' => $data,
        'todo_chart' =>$chart,
      ]);
    }

      public function store(Request $request)
    {
        $userId = Auth::user()->id;
      //dd($request->all());
    	 Todo::create([
            'title' => $request['title'],
            'user_id'=> $userId,
            'description' => $request['description'],
        ]);
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
    'description' => $request->description,
    'completed' =>$status,
  ]);
        $request->session()->flash('message','Todo Updated');
         return redirect()->back();
    }
}

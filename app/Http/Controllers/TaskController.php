<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    public function index()
    {
        // $tasks = DB::table('tasks')->get();
        $tasks = task::where('user_id',Auth::id())-> orderBy('created_at', 'Desc')->paginate(5);

        // $tasks = task::all();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        //   DB::table('tasks')->insert([
        // //   'name' => $request->name,
        // //   'created_at' => now(),
        // //    'updated_at' =>now()
        //   ]);
$validated = $request->validate([
    'name'=>'required|max:10',
    ]);
        $task = new Task();
        $task->name = $request->name;
        $task->user_id = Auth::id();
        $task->save();
        return Redirect()->back();
    }


    public function update(Request $request, $id)
    {

        $task = Task::find($id);
        $task->name = $request->name;
        $task->save();
        return Redirect('/');
    }


    public function edit($id)
    {
      $task = Task::all();
      $task = Task::find($id);
      return view('layouts.edit',compact('task'));

    }


    public function delete($id)
    {
        // DB::table('tasks')->where('id','=',$id)->delete();
        // $task = task::find($id)->delete();
        $task = Task::find($id)->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::latest()->get();
        return view('index', compact('todos'));
    }

    public function addTodo(Request $request){
        $todo = new Todo();
        $todo->name = $request->input('name');
        $todo->save();
        return redirect()->route('todo.index');
    }

    public function deleteTodo($id)
    {
        Todo::find($id)->delete();
        return redirect()->route('todo.index');
    }

    public function readyTask(Request $request){

        $taskId = $request->input('task_id');
        $task = Todo::find($taskId);

        if($task){
            $task->save();
            return response()->json(['success' => true,'ready'=>true]);
        }


    }
}

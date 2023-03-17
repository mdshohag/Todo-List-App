<?php

namespace App\Http\Controllers;


use App\Models\Todolist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodolistControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists =  Todolist::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $posts = Todolist::where('completed','1')->where('user_id', Auth::user()->id)->get();
        $posts_pending = Todolist::where('completed','0')->where('user_id', Auth::user()->id)->get();
        return view('home', compact('todolists','posts','posts_pending'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $todo = new  Todolist;
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');

        if($request->has('completed')){
            $todo->completed = true;
        }

        $todo->user_id = Auth::user()->id;

        $todo->save();

        return back()->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function taskview($id)
    {
        $todolist =  Todolist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('view_todo', compact('todolist'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todolist =  Todolist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('view_todo', compact('todolist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todolist =  Todolist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('edit_todo', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $todo =  Todolist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');

        if($request->has('completed')){
            $todo->completed = true;
        }else{
            $todo->completed = false;
        }

        $todo->save();

        return back()->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo =  Todolist::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Item deleted successfully');
    }

}

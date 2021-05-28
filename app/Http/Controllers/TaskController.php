<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::all()->sortByDesc('id');
        return view('index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $statuses = [
            [
                'label' => 'Todo',
                'value' => 'Todo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
        ];
        $priorities = [
            [
                'label' => 'High',
                'value' => 'High'
            ],
            [
                'label' => 'Normal',
                'value' => 'Normal'
            ],
            [
                'label' => 'Low',
                'value' => 'Low'
            ]
        ];
        return view('create' , compact('statuses', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->dueDate = $request->dueDate;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task=Task::findOrFail($id);
        $statuses = [
            [
                'label' => 'Todo',
                'value' => 'Todo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
        ];
        $priorities = [
            [
                'label' => 'High',
                'value' => 'High'
            ],
            [
                'label' => 'Normal',
                'value' => 'Normal'
            ],
            [
                'label' => 'Low',
                'value' => 'Low'
            ]
        ];
        return view('edit' , compact('statuses','priorities', 'task'));
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
        $task = Task::findOrFail($id);
        $request->validate([
            'title' => 'required'
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->save();

        return redirect()->route('index');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('index');
    }
}

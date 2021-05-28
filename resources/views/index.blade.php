@extends('layout')

@section('mainContent')

    @if (count($tasks) === 0)
        <div class="alert">
            <a href="{{route('task.create')}}" class="btn btn-info"><h2>Get busy!</h2></a>
        </div>
    @else

    <div>
        <div class="float-start">
            <h4 class="pb-3">My Tasks</h4>
        </div>
        <div class="float-end">
            <a href="{{ route('task.create') }}" class="btn btn-primary">
                Create Task
            </a>

        </div>
    <div class="clearfix"></div>
    </div>

    @foreach($tasks as $task)


        <div class="card">
            <div class="card-header">
                @if ($task->status === "Todo")
                    {{$task->title}}
                @else
                    <del>{{$task->title}}</del>
                @endif
                <span class="badge bg-info text-dark">
                <h6>Created at: {{$task->created_at}}</h6>
                </span>
                @if($task->dueDate ==! null)
                        <span class="badge bg-warning text-dark">
                    <h6>Deadline: {{$task->dueDate}}</h6>
                        </span>
                    @endif

            </div>
            <div class="card-body">
                <div class="card-text">
                    <div class="float-start">
                        @if ($task->status === "Todo")
                            {{$task->description}}
                        @else
                            <del>{{$task->description}}</del>
                        @endif
                        <br>
                            @if($task->priority==="High")
                                <div class="alert alert-danger" role="alert">
                                    High priority
                                </div>
                                @elseif($task->priority==="Normal")
                                <div class="alert alert-warning" role="alert">
                                    Normal priority
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    Low priority
                                </div>
                                @endif
                            <br>
                        @if ($task->status === "Todo")
                        <span class="badge bg-info text-dark">
                    ToDo
                </span>
                        @else
                            <span class="badge bg-success text-white">
                    Done
                </span>
                        @endif
                        <small>Last Updated:{{$task->updated_at}}</small>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-success">
                            Edit
                        </a>
                        <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>


                    </div>
                    <div class="clearfix"></div>


                </div>
            </div>
        </div>


    @endforeach
    @endif



@endsection

@extends('layout')

@section('mainContent')

    <div>
        <div class="float-start">
            <h4 class="pb-3">Edit Task <span class="badge bg-warning">{{ $task->title }}</span></h4>
        </div>
        <div class="float-end">
            <a href="{{ route('index') }}" class="btn btn-primary">
                Create Task
            </a>

        </div>
        <div class="clearfix"></div>
    </div>


    <div class="card card-body bg-light p-4">
        <form action="{{route('task.update', $task->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select name="priority" id="priority" class="form-control">
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority['value'] }}"{{ $task->priority === $priority['value'] ? 'selected':  '' }}>{{$priority['label']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="dueDate" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="dueDate" name="dueDate">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" rows="5" >{{ $task->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach ($statuses as $status)
                        <option value="{{ $status['value'] }}"{{ $task->status === $status['value'] ? 'selected':  '' }}>{{$status['label'] }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


@endsection


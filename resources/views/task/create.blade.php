@extends('layouts.app')

@section('content')
<div class="container">
    <form action="#" method="post" id="taskForm">
        @csrf
        <div class="form-group">
            <input type="text" name="user_id" id="user_id" value="{{ Auth::id() }}" style="display: none">
            <label for="text">Task</label>
            <input type="text" class="form-control" name="task" id="taskName" placeholder="Enter your task">
        </div>
        <div>
            <label for="text">Status</label>
            <select name="status" id="taskStatus" class="form-control" value="pending">
                <option value="pending">Pending</option>
                <option value="done">Done</option>    
            </select>
        </div>
    </form>
    <button class="btn btn-primary" id="taskFormSubmit" style="margin-top: 1%">Submit</button>
</div>
@endsection
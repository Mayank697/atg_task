@extends('layouts.app')

@section('content')
<div class="container">
    <form action="#" method="post" id="taksUpdate">
        @csrf
        <div class="form-group">
            <input type="text" name="task_id" id="taskid" value="{{ $id }}" style="display: none">
            <label for="text">Status</label>
            <select name="status" id="updstatus" class="form-control" value="pending">
                <option value="pending">Pending</option>
                <option value="done">Done</option>    
            </select>
        </div>
    </form>
    <button class="btn btn-primary" id="taskUpdateSubmit" style="margin-top: 1%">Submit</button>
</div>
@endsection
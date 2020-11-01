@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.flash')
            <div class="card">
                <div class="card-header"><h4>Your todos</h4></div>

                <div class="card-body">
    <button class="btn btn-primary"
data-toggle="modal" data-target="#AddTodoModal"
    >Add Todo</button>
    <hr>
    <div class="table-responsive">
    <table id="todo-table" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Todo</th>
          <th>Status</th>
           <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($todos as $todo)
      <tr>
        <td>{{$todo->title}}</td>
        <td>
          @if($todo->completed == "1")
        <strong class="text-success">
        Complete
          </strong>
          @else
            <strong class="text-danger">
        Incomplete
          </strong>
          @endif
        </td>
          <td><strong class="text-black">
         {{$todo->created_at}}
          </strong></td>
          <td>
            <button class="btn btn-success"
data-toggle="modal" data-target="#Modal{{$todo->id}}"
            >View</button>
            <button class="btn btn-primary"
data-toggle="modal" data-target="#EditModal{{$todo->id}}"
            >Edit</button>
            <button class="btn btn-danger"
     onclick="$('#delete_form').submit();">
            Delete</button>
          </td>
      </tr>
      <!-- The Modal -->
<div class="modal" id="Modal{{$todo->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Todo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

     <h4>
          <label for="todo">Title:</label>
      {{$todo->title}}
     <br>
       <label for="todo">Description:</label>
         {{$todo->description}}
     <br>
       <label for="todo">Status:</label>
       @if($todo->completed == "1")
        <strong class="text-success">
        Complete
          </strong>
          @else
            <strong class="text-danger">
        Incomplete
          </strong>
          @endif
      </h4>
      </div>
<div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>
    </div>
  </div>
</div>
      <!-- The Modal -->
<div class="modal" id="EditModal{{$todo->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Todo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="/todos/edit" method="POST">
        @csrf
        <div class="form-group">
  <label for="todo">Todo:</label>
  <input type="hidden" name="todo_id" value="{{$todo->id}}">
  <input name="title" class="form-control" id="title" required value="{{$todo->title}}"/>
</div>
<div class="form-group">
  <label for="todo">Description:</label>
  <input name="description" class="form-control" value="{{$todo->description}}" required/>
</div>
    <div class="form-group">
           @if($todo->completed == "1")
  <label for="todo">Status:</label>
 <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="true" checked>Complete
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" name="status" value="false" class="form-check-input">Incomplete
  </label>
</div>
</div>
@else
    <div class="form-group">
  <label for="todo">Status:</label>
 <div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" name="status" value="true" class="form-check-input">Complete
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" value="false" checked>Incomplete
  </label>
</div>
</div>
@endif

        <hr>
        <button class="btn btn-primary" 
type="submit" 
        >Edit Todo</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </form>
      </div>
    </div>
  </div>
</div>
 <!-- The Modal -->
<div class="modal" id="DeleteModal{{$todo->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Todo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <h1>Do you Want to delete todo {{$todo->title}}?</h1>
        <br>
      <form action="/todos/delete" method="POST" id="delete_form">
        @csrf
        <div class="row">
          <div class="col-md-4" style="margin: 0 auto;">
            <input type="hidden" name="todo_id" value="{{$todo->id}}">
            <button type="submit" class="btn btn-success btn-lg">YES</button>
          </div>
            <div class="col-md-4" style="margin: 0 auto;">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>
          </div>

        </div>

      </form>
      </div>
    </div>
  </div>
</div>

      @endforeach
    </tbody>
  </table>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="AddTodoModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Todo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form id="addTodoForm" action="/todos/create" method="POST">
        @csrf
        <div class="form-group">
  <label for="todo">Todo:</label>
  <input name="title" class="form-control"  id="title" required/>
</div>
   <div class="form-group">
      <label for="todo">Description:</label>
  <input name="description" class="form-control" required/>
</div>
        <hr>
        <button class="btn btn-primary" 
type="submit" 
        >Add Todo</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </form>
      </div>

    </div>
  </div>
</div>

@endsection

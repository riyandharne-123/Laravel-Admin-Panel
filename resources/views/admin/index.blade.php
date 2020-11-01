@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.flash')
            <div class="card">
                <div class="card-header"><h4>All Users</h4></div>
     <div class="card-body">
<div class="row">
  <div class="col-md-4" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-success" style="text-align: center;">
        <h2><i class="fa fa-users" aria-hidden="true"></i> Total Users: {{$total_users}}</h2>
      </div>
    </div>
  </div>
    <div class="col-md-4" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-primary" style="text-align: center;">
        <h2><i class="fa fa-user" aria-hidden="true"></i> Standard Users: {{$standard_users}}</h2>
      </div>
    </div>
  </div>
    <div class="col-md-4" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-danger" style="text-align: center;">
        <h2><i class="fa fa-lock" aria-hidden="true"></i> Admin Users: {{$admin_users}}</h2>
      </div>
    </div>
  </div>
</div>
      <br>
         <button class="btn btn-outline-primary"
data-toggle="modal" data-target="#AddUserModal"
    ><i class="fa fa-user-plus" aria-hidden="true"></i> Add User</button>
    <hr>
<!--User charts-->
<div class="container">
  <div class="row" style="height: auto; max-height: 200px;">
{{ $user_chart->container() }}
{{ $user_chart->script() }}
</div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
           <div class="table-responsive container">
                <table id="user-table" class="table table-bordered table-hover">
    <thead>
      <tr>
         <th>User Image</th>
        <th>User Name</th>
           <th>Email</th>
           <th>User Type</th>
           <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
         <td>
          @if($user->avatar == null)
          <strong>No Image Uploaded</strong>
          @else
          <img class="img-fluid rounded" src="{{
          asset('/storage/images/'.$user->avatar) }}" style="height: 80px;" alt="avatar" />
       @endif
        </td>
        <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td><strong class="text-dark">
           {{$user->user_type}}
          </strong></td>
          <td>
            <strong>{{$user->created_at}}</strong>
          </td>
          <td>
            <button class="btn btn-success"
            data-toggle="modal" data-target="#Modal{{$user->id}}"
            ><i class="fa fa-eye" aria-hidden="true"></i> View</button>
            <button class="btn btn-primary"
            data-toggle="modal" data-target="#EditModal{{$user->id}}"
            ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
            <button class="btn btn-danger"
       data-toggle="modal" data-target="#DeleteModal{{$user->id}}"
            ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
          </td>
      </tr>
            <!-- The Modal -->
<div class="modal" id="Modal{{$user->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
   <strong>
    <div class="row">
         @if($user->avatar == null)
          <strong style="padding:10px;">No Image Uploaded</strong>
          @else
          <h5 style="padding:10px;">User Profile Picture:</h5>
          <img class="img-fluid rounded" src="{{
          asset('/storage/images/'.$user->avatar) }}" style="height: auto; width: 100%; padding:10px; " alt="avatar" />
       @endif
    </div>
     <h5>Name: {{$user->name}}</h5>
      <h5>Email: {{$user->email}}</h5>
       <h5>User Type: {{$user->user_type}}</h5>
   <h5>Created At: {{$user->created_at}}</h5>
   </strong>
      </div>
<div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
</div>
    </div>
  </div>
</div>
 <!-- The Modal -->
<div class="modal" id="EditModal{{$user->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="/users/update" method="POST">
        @csrf
          <div class="form-group">
  <label>User Name:</label>
  <input type="hidden" name="user_id" value="{{$user->id}}">
  <input name="username" class="form-control"  id="username" type="text" value="{{$user->name}}" required/>
</div>
  <div class="form-group">
  <label>User Type:</label>
   <select class="form-control" name="usertype" id="usertype">
    @if($user->user_type =="Admin")
    <option>Admin</option>
        <option>Standard</option>
            @else
                    <option>Standard</option>
                <option>Admin</option>
        @endif
  </select>
</div>
        <hr>
        <button class="btn btn-primary" 
type="submit" 
        ><i class="fa fa-check" aria-hidden="true"></i> Update User</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
      </form>
      </div>
    </div>
  </div>
</div>
 <!-- The Modal -->
<div class="modal" id="DeleteModal{{$user->id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <h1>Do you Want to delete user {{$user->name}}?</h1>
        <br>
      <form action="/users/delete" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-4" style="margin: 0 auto;">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check" aria-hidden="true"></i> YES</button>
          </div>
            <div class="col-md-4" style="margin: 0 auto;">
          <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
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
<!-- The Modal -->
<div class="modal" id="AddUserModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form id="addUserForm" method="POST">
        @csrf
        <div class="form-group">
  <label>User Name:</label>
  <input name="username" class="form-control"  id="username" type="text" required/>
</div>
     <div class="form-group">
  <label>User Email:</label>
  <input name="useremail" class="form-control"  id="useremail" type="email" required/>
</div>
  <div class="form-group">
  <label>User Type:</label>
   <select class="form-control" name="usertype" id="usertype">
    <option>Standard</option>
    <option>Admin</option>
  </select>
</div>
  <div class="form-group">
  <label>User Password:</label>
  <input name="userpassword" class="form-control"  id="userpassword" type="password" required/>
</div>
        <hr>
        <button class="btn btn-primary" 
type="submit" 
        ><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
      </form>
      </div>

    </div>
  </div>
</div>
@endsection

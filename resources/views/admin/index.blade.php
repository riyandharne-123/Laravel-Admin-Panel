@extends('layouts.app')
    <style type="text/css">
        /* The sidebar menu */
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 180px; /* Set the width of the sidebar */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: #111; /* Black */
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 20px;
}

/* The navigation menu links */
.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #fff;
  display: block;
}


/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Style page content */
.main {
  margin-left: 160px; /* Same as the width of the sidebar */
}

/* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
@section('content')
            <!-- Side navigation -->
<div class="sidenav">

    <a href="#" role="button" >         
     {{ Auth::user()->name }}
     <br>
     @if(Auth::user()->avatar)
                      <img class="img-fluid rounded" src="{{
                                    asset('/storage/images/'.Auth::user()->avatar)
                                }}" alt="avatar" />
                    
                    @else
                   <p>No Image uploaded</p>
                     @endif
  </a>
                       
<a href="/home">Profile</a>
<a href="/todos">Todos</a>
     @if(Auth::user()->user_type == 'Admin')
<a href="/admin">Admin</a>
     @endif
     <a  href="{{ route('logout') }}" 
             onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">

    {{ __('Logout') }}
 </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           @csrf
         </form>

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.flash')
            <div class="card">
                <div class="card-header"><h4>All Users</h4></div>
     <div class="card-body">
<div class="row">
  <div class="col-md-3" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-success" style="text-align: center;">
        <h2>Total Users: {{$total_users}}</h2>
      </div>
    </div>
  </div>
    <div class="col-md-4" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-primary" style="text-align: center;">
        <h2>Standard Users: {{$standard_users}}</h2>
      </div>
    </div>
  </div>
    <div class="col-md-3" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body text-white bg-danger" style="text-align: center;">
        <h2>Admin Users: {{$admin_users}}</h2>
      </div>
    </div>
  </div>
</div>
      <br>
         <button class="btn btn-outline-primary"
data-toggle="modal" data-target="#AddUserModal"
    >Add User</button>
    <hr>
<!--User charts-->
<div class="container">
  <div class="row" style="height: auto; max-height: 450px;">
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
            >View</button>
            <button class="btn btn-primary"
            data-toggle="modal" data-target="#EditModal{{$user->id}}"
            >Edit</button>
            <button class="btn btn-danger"
       data-toggle="modal" data-target="#DeleteModal{{$user->id}}"
            >Delete</button>
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
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
        >Update User</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
        >Submit</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </form>
      </div>

    </div>
  </div>
</div>
@endsection

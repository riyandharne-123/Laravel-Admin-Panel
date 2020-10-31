@extends('layouts.app')
    <style type="text/css">
        /* The sidebar menu */
.sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  width: 160px; /* Set the width of the sidebar */
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
 <div>

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
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('layouts.flash')
            <div class="card">
                <div class="card-header"><h4>Welcome {{ Auth::user()->name }}</h4></div>

                <div class="card-body">
                  <div class="col-md-6">
                    <label>Profile Image:</label>
                    @if(Auth::user()->avatar)
                      <img class="img-fluid" src="{{
                                    asset('/storage/images/'.Auth::user()->avatar)
                                }}" alt="avatar" />
                    
                    @else
                   <p>No Image uploaded</p>
                     @endif
                  </div>
                  <hr>
                  <div class="col-md-6">
              <form action="/uploadImg" method="POST" enctype="multipart/form-data">
                @csrf
  <label>Update Profile Image:</label>
  <br>
  <input type="file" name="image" />
  <br>
  <br>
  <input type="submit" name="Upload" value="upload image" class="btn btn-primary"/>
</form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

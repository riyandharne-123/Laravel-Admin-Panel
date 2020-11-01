@extends('layouts.app')
@section('content')

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
                                    asset('storage/images/'.Auth::user()->avatar)
                                }}" alt="avatar" />
                    
                    @else
                   <p>No Image uploaded</p>
                     @endif
                  </div>
                  <hr>
                  <div class="col-md-6">
              <form action="/uploadImg" method="POST" enctype="multipart/form-data">
                @csrf
  <label>Update Profile Image: ( Sorry files cannot be stored on heroku server :(   )</label>
  <br>
  <input type="file" name="image" />
  <br>
  <br>
  <button type="submit" name="Upload" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
</form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

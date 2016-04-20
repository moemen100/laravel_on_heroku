@extends('Layout.master')
@section('title')
Welcome

@endsection
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-5 "  >
    <h3>Sign in </h3>
        <form action ="{{route('signin')}}" method="post">
        <div class="form-group">
        <label for="email"> Your mail</label>
        	<input class="form-control" type="email" name="email" id="email" placeholder="Enter Your E-Mail @ Example.com" >
        	</div>
        	<div class="form-group">
        <label for="pass"> Your password </label>
        	<input class="form-control" type="password" name="password" id="password" placeholder="Enter Password"  >
        	</div>
        	<button type="submit" class="btn btn-primary">Sign in</button>
        	   <input type="hidden" name="_token" value="{{Session::token()}}">
        	</form>
        </div>
        
        
        
    <div class="col-md-5 col-md-offset-2">
      <h3>Sign up </h3>
        <form action ="{{route('signup')}}" method="post">
        <div class="form-group @foreach ($errors->all() as $error)
                @if($error=="The email field is required."||$error== "The email must be a valid email address.")
                 has-error
                   @break;
                  @endif
            @endforeach">
        <label for="email"> Your email</label>
        	<input class="form-control" type="email" name="email" id="email" placeholder="Enter Your E-Mail @ Example.com" value="{{ Request::old('email') }}" >
          @if (count($errors) > 0)
    
        
           @foreach ($errors->all() as $error)
                 @if($error=="The email field is required."||$error== "The email must be a valid email address.")
                  <div class="alert alert-danger">
        <ul> 
        {{$error}}
         <ul>
          </div>
          @break;
           @endif
            @endforeach
     
    @endif
        	</div>
        	<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        <label for="first_name"> Your first name </label>
        	<input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter your First name" value="{{ Request::old('first_name') }}" >
        	</div>
        	 <div class="form-group @foreach ($errors->all() as $error)
                @if($error=="The password field is required."||$error== "The password must be at least 8 characters.")
                 has-error
                   @break;
                  @endif
            @endforeach">
        <label for="password" >Your password </label>
        	<input class="form-control" type="password" name="password" id="password" placeholder="Enter Password" value="{{ Request::old('password') }}">
        	</div>
        	<button type="submit" class="btn btn-primary">Sign up</button>
        	<input type="hidden" name="_token" value="{{Session::token()}}">
        	</form>
        </div>
        </div>

@endsection

@extends('layouts.app')

@section('title', 'Login')

@section('content')

	<div class="container">

	  <form class="form-login callout" method="POST">
	    <h1>Login</h1>
	    <br>

	    {{ csrf_field() }}

	    <label for="username" class="sr-only">Username/NIM</label>
	    <div class="input-group @if ($errors->has('username')) has-error @endif">
	      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
	      <input type="text" name="username" class="form-control" placeholder="Username/NIM" value="{{ old('username') }}" required autofocus>
	    </div>

	    <label for="password" class="sr-only">Password</label>
	    <div class="input-group @if ($errors->has('password')) has-error @endif">
	      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
	      <input type="password" name="password" class="form-control" placeholder="Password" required>
	    </div>

	    <br>
	    <a href="{{ url('register') }}">Belum terdaftar?</a>
	    <button class="btn btn-primary btn-block" type="submit">Masuk <span class="glyphicon glyphicon-log-in"></span></button>
	    
	    @if ($errors->has())
	    	@foreach ($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
		@endif
	    
	  </form>

	</div>

@endsection
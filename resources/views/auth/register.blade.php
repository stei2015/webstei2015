@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

	<div class="container">

	  <form class="form-register callout" method="POST">
	    <h1>Daftar</h1>
	    <br>

	    {{ csrf_field() }}

	    <div class="form-group @if ($errors->has('nim')) has-error @endif">
	      <label for="nim">NIM</label>
	      <input type="text" id="nim" name="nim" class="form-control" required autofocus value="{{ old('nim') }}">
	      <label class="error-text">{{ $errors->first('nim') }}</label>
	    </div>

	    <div class="form-group @if ($errors->has('username')) has-error @endif">
	      <label for="username">Username</label>
	      <input type="text" id="username" name="username" class="form-control" required value="{{ old('username') }}">
	      <label class="error-text">{{ $errors->first('username') }}</label>
	    </div>

	    <div class="form-group @if ($errors->has('password')) has-error @endif">
	      <label for="password">Password</label>
	      <input type="password" name="password" class="form-control" required>
	      <label class="error-text">{{ $errors->first('password') }}</label>
	    </div>

	    <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
	      <label for="confirmPassword">Konfirmasi Password</label>
	      <input type="password" name="password_confirmation" class="form-control" required>
	      <label class="error-text">{{ $errors->first('password_confirmation') }}</label>
	    </div>

	    @if (config('app.regcode'))
			<div class="form-group @if ($errors->has('regcode')) has-error @endif">
				<label for="regcode">Kode Registrasi</label>
				<input type="password" name="regcode" class="form-control" required value="{{ old('regcode') }}">
				<label>Kode registrasi dapat ditanyakan di group LINE STEI</label>
			</div>
		@endif
	    
	    <br>
	    <button class="btn btn-primary">Daftar <span class="glyphicon glyphicon-list-alt"></span></button>
	    <br>
	    
	  </form>

	</div>

@endsection
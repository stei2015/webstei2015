@extends('layouts.app')

@section('title', 'Edit Foto Profil')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'studentdata'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')

		<div class="page-header">
			<h1>Edit Foto Profil <small>{{ $nim }}</small></h1>
			<a href="{{ url('studentdata/'.$nim) }}">&laquo; Kembali</a>
    		/
			<a href="{{ url('studentdata/'.$nim.'/edit') }}">Edit data diri</span></a>
		</div>

		<p>Foto sebaiknya foto wajah dan bukan foto grup. Ukuran file maksimal 256 KB.</p>
		<hr>
	
		<form action="{{ url('profilepictures/'.$nim) }}" method="POST" enctype="multipart/form-data">
		
		    {{ method_field('put') }}
		    {{ csrf_field() }}

		    <div class="form-group">
		      <input name="profilepicture" type="file">
		    </div>
		    
		    @if ($hasPicture)
		          <div style="max-width: 250px; max-height:250px;">
		            <div style="background: url('{{ url('profilepictures/'.$nim) }}') repeat scroll center center / cover #ccc; padding-bottom:100%;"></div>
		          </div>
		    @endif

		    <br>

		    <button class="btn btn-primary">Upload <span class="glyphicon glyphicon-upload"></span></button>

		</form>
		<br><br>


	</div>

@endsection
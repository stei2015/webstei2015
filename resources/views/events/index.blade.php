@extends('layouts.app')

@section('title', 'Events')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'events'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')

		<div class="page-header">
			<h1>Events</h1>
		</div>

		<a href="{{ url('events/angelsandmortals') }}" class="panel panel-default panel-grid-item">
		  <div class="panel-heading">
		  	<h3 class="panel-title">Angels &amp; Mortals</h3>
		  	<span>Jan-Feb 2016</span>
		  </div>
		  <div class="panel-body">
		    <div class="panel-image" style="background: url('{{ url('img/events/angelsandmortals.jpg') }}') repeat scroll center center / cover #ccc;"></div>
		    Deskripsi
		  </div>
		</a>


	</div>

@endsection
@extends('layouts.app')

@section('title', 'Profil')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'studentdata'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')
	
		<div class="page-header">
			<h1>Profil <small>{{ $studentData['username'] }}</small></h1>

			<a href="{{ url('studentdata') }}">&laquo; Kembali</a>
			@can('studentdata-edit', $studentData)
				/
				<a href="{{ url('studentdata/'.$studentData['nim'].'/edit') }}">Edit data diri</a>
				/
				<a href="{{ url('profilepictures/'.$studentData['nim'].'/edit') }}">Edit foto</span></a>
			@endcan
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div style="background: url('{{ url('profilepictures/'.$studentData['nim']) }}') repeat scroll center center / cover #aaa; padding-bottom:100%;"></div>
			</div>
			<div class="col-sm-9">
				<h2>{{ $studentData['nama_lengkap'] }}</h2>
				<hr>

				<table class="basic-table">
					@foreach ($studentData->toArray() as $column => $value)
						<tr>
							<th><span>{{ ucfirst(trans('validation.attributes.'.$column)) }}</span></th>
							<td>{{ $value }}</td>
						</tr>
					@endforeach
				</table>
				
				<br>
			</div>
		</div>

	</div>

@endsection
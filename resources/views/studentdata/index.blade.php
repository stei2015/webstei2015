@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'studentdata'])
@endsection

@section('content')

	<div class="page-container">
	
		<div class="page-header">
			<h1>Data Mahasiswa</h1>

			<form class="form-inline" method="GET">
				<div class="input-group">
					<input type="search" name="search" placeholder="Cari..." class="form-control" value="{{ $search }}">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
				<select name="by" class="form-control">
					<?php $selectedKey = $by != '' ? $by : 'nama_lengkap'; ?>
					@foreach ($studentDataColumns as $column)
						<option value="{{ $column }}" {{ $column == $selectedKey ? 'selected' : '' }}>{{ ucfirst(trans('validation.attributes.'.$column)) }}</option>
					@endforeach
				</select>
			</form>

		</div>
		
		<div class="table-responsive">
		  	<table class="table table-hover">

		  		<thead>
			  		<tr>
						@foreach ($studentDataColumns as $column)
		  					<th>{{ ucfirst(trans('validation.attributes.'.$column)) }}</th>
		  				@endforeach
					</tr>
				</thead>

				<tbody>
			  		@forelse ($studentData as $student)

			  			<tr onclick="document.location='{{ url('studentdata/'.$student['nim']) }}';" >
							@foreach ($studentDataColumns as $column)
			  					<td>{{ $student[$column] }}</td>
			  				@endforeach
						</tr>

			  		@empty
			  			<tr><td colspan="{{ count($studentDataColumns) }}">Tidak ada data.</td></tr>
			  		@endforelse
			  	</tbody>

			</table>
		</div>

	</div>

@endsection
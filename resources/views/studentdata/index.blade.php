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
		
		{{ $studentData }}

		<div class="table-responsive">

		  	<table class="table table-hover">




	  		
			  

			</table>
		</div>

	</div>

@endsection
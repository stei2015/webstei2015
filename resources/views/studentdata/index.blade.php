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
					<input type="search" name="search" placeholder="Cari..." class="form-control" value="{{ old('search') }}">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
				<select name="by" class="form-control">
					<?php
						/*if(isset($_GET['by'])) $selectedKey = $_GET['by']; else $selectedKey = 'namalengkap';
						foreach($searchColumns as $key => $val){
							if($key == $selectedKey) $selected = 'selected'; else $selected = '';
							echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
						}*/
					?>
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
@extends('layouts.app')

@section('title', 'Angels & Mortals')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'events'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')

		<div class="page-header">
			<h1>Angels &amp; Mortals</h1>
		</div>

		<h3>A&amp;M Round 2!</h3>

		<hr>
			<p>
				@if ($isPlayer)
					<i>Kamu sudah terdaftar. Game akan dimulai pada {{ $gameStartDate }}</i>

				@else

					@if
						<form action="{{ url('events/angelsandmortals/register') }}" method="POST">
							{{ csrf_field() }}
							<button class="btn btn-primary">Daftar</button>
						</form>

					@elseif
						<a href="#" class="btn btn-default">Pendaftaran belum dibuka</a>

					@else
						<i>Game telah dimulai, pendaftaran sudah ditutup.</i>
					@endif

				@endif
			</p>
		<hr>

		<!-- TODO: change all game, registration dates to use protected controller properties -->
		<!-- TODO: define GM contact info in protected controller properties -->

		<p>Panitia Angels &amp; Mortals akan mengadakan A&amp;M round 2!<br>
		Pendaftaran akan dibuka mulai <strong>Senin, 8 Februari 2016</strong> dan berakhir ketika Round 2 dimulai pada <strong>Jumat, 12 Februari 2016</strong>.</p>

		<h4>Apa sih A&amp;M?</h4>

		<p>Dalam game ini, bla bla bla</p>

		<h4>Gimana cara daftarnya?</h4>

		<p>Setelah pendaftaran dibuka, kunjungi halaman ini dan klik <strong>Daftar</strong>.</p>

		<h4>Kalau mau tanya-tanya ke siapa ya?</h4>

		<p>Untuk informasi, hubungi <a href="{{ url('/studentdata/16515120') }}">Tessa Angela</a>.<br>
		Untuk dukungan teknis (masalah web) hubungi <a href="{{ url('/studentdata/16515119') }}">Jonathan Christopher</a>.
		</p>

	</div>

@endsection
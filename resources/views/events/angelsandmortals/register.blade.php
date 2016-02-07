@extends('layouts.app')

@section('title', 'Angels & Mortals')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'events'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')

		<div class="page-header">
			<h1>Angels &amp; Mortals <small>Round {{ $gameInfo['round'] }}</small></h1>
		</div>

		<p>
			@if ($isPlayer)
				<i>Kamu sudah terdaftar. Game akan dimulai pada {{ $gameInfo['gameStartDate']->format('j M Y, H:i') }}.</i>

			@else

				<?php $now = new DateTime("now"); ?>

				@if (($now >= $gameInfo['registrationStartDate']) && ($now <= $gameInfo['registrationEndDate']))
					<form action="{{ url('events/angelsandmortals/register') }}" method="POST">
						{{ csrf_field() }}
						<button class="btn btn-primary">Daftar</button>
					</form>

				@elseif ($now < $gameInfo['registrationStartDate'])
					<i>Pendaftaran akan dimulai pada {{ $gameInfo['registrationStartDate']->format('j M Y, H:i') }}.</i>

				@else
					<i>Pendaftaran sudah ditutup. Game dimulai pada {{ $gameInfo['gameStartDate']->format('j M Y, H:i') }}</i>
				@endif

			@endif
		</p>
		<hr>

		<!-- TODO: define GM contact info in protected controller properties -->

		<p>Panitia Angels &amp; Mortals akan mengadakan A&amp;M round {{ $gameInfo['round'] }}!</p>
		<p>Pendaftaran dibuka mulai <strong>{{ $gameInfo['registrationStartDate']->format('j M Y, H:i') }}</strong> dan berakhir pada <strong>{{ $gameInfo['registrationEndDate']->format('j M Y, H:i') }}</strong>. Game akan dimulai pada <strong>{{ $gameInfo['gameStartDate']->format('j M Y, H:i') }}</strong> dan berakhir pada <strong>{{ $gameInfo['gameEndDate']->format('j M Y, H:i') }}</strong>.</p>

		<h4>Apa sih A&amp;M?</h4>

		<p>Dalam game ini, kamu sebagai seorang <i>angel</i> harus berbuat kebaikan kepada seseorang <i>mortal</i> yang akan dipilih secara acak, dengan catatan <i>mortal</i>-mu tidak boleh sampai mengetahui siapa kamu. Di saat yang sama, kamu harus menebak siapa <i>angel</i>-mu.</p>

		<h4>Gimana cara daftarnya?</h4>

		<p>Setelah pendaftaran dibuka, kunjungi halaman ini dan klik <strong>Daftar</strong>.</p>

		<h4>Kalau mau tanya-tanya ke siapa ya?</h4>

		<p>
			Untuk informasi, hubungi <a href="{{ url('/studentdata/16515006') }}">Edbert</a>, <a href="{{ url('/studentdata/16515214') }}">Cisco</a> atau <a href="{{ url('/studentdata/16515186') }}">Tasha</a>.
			<br>
			Untuk dukungan teknis (masalah web) hubungi <a href="{{ url('/studentdata/16515119') }}">Jonathan Christopher</a>.
		</p>

	</div>

@endsection
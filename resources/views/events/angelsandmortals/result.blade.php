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

		<h3>A&amp;M Round {{ $gameInfo['round'] }} telah selesai!</h3>
		<p>Terima kasih atas partisipasinya!</p>

		@if ($isPlayer)

			<hr>

				@if (($guess !== null) && ($guess !== 0) && ($angel !== null) && ($angel !== 0) && ($guess === $angel))
					<h4>Selamat, tebakanmu benar!</h4>
				@elseif (($guess === null) || ($guess === 0))
					<h4>Tidak ada tebakan</h4>
				@else
					<h4>Sayang sekali, tebakanmu salah :(</h4>
				@endif

				<p>
					@if (($guess !== null) && ($guess !== 0))
						<strong>Tebakanmu:<strong> {{ $guessName }}
						<br>
					@endif

					@if (($angel !== null) && ($angel !== 0))
						<strong><i>Angel</i>-mu:<strong> {{ $angelName }}
					@else
						<i>Kamu tidak memiliki angel :(</i>
					@endif
				</p>

			<hr>

		@endif

		@if ($gameInfo['completeResultsLink'] !== null && $gameInfo['completeResultsLink'] !== '')
			<p>Hasil selengkapnya dapat dilihat di <a href="{{ asset($completeResultsLink) }}">sini</a>.
		@endif

		<p>
			Untuk informasi, hubungi <a href="{{ url('/studentdata/16515006') }}">Edbert</a>, <a href="{{ url('/studentdata/16515214') }}">Cisco</a> atau <a href="{{ url('/studentdata/16515186') }}">Tasha</a>.
			<br>
			Untuk dukungan teknis (masalah web) hubungi <a href="{{ url('/studentdata/16515119') }}">Jonathan Christopher</a>.
		</p>

	</div>

@endsection
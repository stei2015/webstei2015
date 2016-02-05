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

		<h3>A&amp;M Round 1 telah selesai!</h3>

		<p>Terima kasih atas partisipasinya!</p>

		@if ($isPlayer)

			<hr>

				@if (($guess !== null) && ($guess !== 0) && ($angel !== null) && ($angel !== 0) && ($guess === $angel))
					<h4>Selamat, tebakanmu benar!</h4>
				@else
					<h4>Sayang sekali, tebakanmu salah :(</h4>
				@endif

				<p>
					@if (($guess !== null) && ($guess !== 0))
						<strong>Tebakanmu:<strong> {{ $guessName }}
					@else
						<i>Tidak ada tebakan</i>
					@endif

					<br>

					@if (($angel !== null) && ($angel !== 0))
						<strong><i>Angel</i>-mu:<strong> {{ $angelName }}
					@else
						<i>Kamu tidak memiliki angel</i>
					@endif
				</p>

			<hr>

		@endif

		<p>Hasil selengkapnya dapat dilihat di <a href="{{ asset($completeResultsLink) }}">sini</a>.

		<p>Untuk informasi, hubungi <a href="{{ url('/studentdata/16515120') }}">Tessa Angela</a>.<br>
		Untuk dukungan teknis (masalah web) hubungi <a href="{{ url('/studentdata/16515119') }}">Jonathan Christopher</a>.
		</p>

	</div>

@endsection
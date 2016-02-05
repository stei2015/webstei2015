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

		<p>Panitia Angels &amp; Mortals akan mengadakan A&amp;M round 2!<br>
		Pendaftaran akan dibuka mulai <strong>Senin, 8 Februari 2016</strong> dan berakhir ketika Round 2 dimulai pada <strong>Jumat, 12 Februari 2016</strong>.</p>

		<h3>Apa sih A&amp;M?</h3>

		<p>Dalam game ini, bla bla bla</p>

		<h3>Gimana cara daftarnya?</h3>

		<p>Setelah pendaftaran dibuka, kunjungi halaman ini dan klik <strong>Register</strong>.</p>

		<h3>Kalau mau tanya-tanya ke siapa ya?</h3>

		<p>Untuk informasi, hubungi <a href="{{ url('/studentdata/16515120') }}">Tessa Angela</a>.<br>
		Untuk dukungan teknis (masalah web) hubungi <a href="{{ url('/studentdata/16515119') }}">Jonathan Christopher</a>.
		</p>

	</div>

@endsection
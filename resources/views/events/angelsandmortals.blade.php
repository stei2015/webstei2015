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

		<p>Jadi begini, ada ide buat mewarnai hari-hari kuliah semester 2 nih.. jadi kita bakal main ANGELS AND MORTALS</p>

		<ol>
			<li>Kita bakal bikin undian. Nama semua peserta bakal ada di dalam undian.</li>
			<li>Nama yang kita ambil dari undian adalah Mortal kita, orang yang kudu kita beri kebaikan. Orang yang berbuat kebaikan (kita) disebut Angel.</li>
			<li>Kebaikannya bisa berupa ngasih kado, atau kasih kata2 penyemangat. pokoknya, IDENTITAS KITA KUDU DIRAHASIAKAN.</li>
			<li>Tenang aja, pasti ada seseorang di luar sana yang merupakan Angel kita. Jadi pasti kita menerima kebaikan juga.</li>
			<li>Pas makrab, kita kumpul lagi. Kalo bisa nebak siapa Angel kita (orang yangg baik ke kita), dapet hadiah. Kalo ga bisa nebak, Angelnya pasti sedih.</li>
		</ol>

		<p>Yang berminat buat join bisa hubungi gue (Tessa Angela) yaaaa udah ada beberapa orang yang ikut. dijamin seru dah :))))</p>

	</div>

@endsection
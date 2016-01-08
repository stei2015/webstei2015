@extends('layouts.app')

@section('title', 'Data Diri')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'studentdata'])
@endsection

@section('content')

	<div class="page-container">

		@include('parts.alert')
	
		<div class="page-header">
			<h1>Data Diri <small>{{ $studentData['nim'] }}</small></h1>
    		<a href="{{ url('studentdata/'.$studentData['nim']) }}">&laquo; Kembali</a>
    		/
			<a href="{{ url('profilepictures/'.$studentData['nim'].'/edit') }}">Edit foto</span></a>
		</div>

		<p>Isian bertanda <span class="text-muted glyphicon glyphicon-lock"></span> tidak akan dipublikasikan</p>
		<hr>

		<form action="{{ url('studentdata/'.$studentData['nim']) }}" method="POST">

			{{ method_field('put') }}
			{{ csrf_field() }}

		    <div class="form-group @if ($errors->has('nama_lengkap')) has-error @endif">
		      <label for="nama_lengkap">Nama lengkap</label>
		      <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') !== null ? old('nama_lengkap') : $studentData['nama_lengkap'] }}" required>
		      <label class="error-text">{{ $errors->first('nama_lengkap') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('nama_panggilan')) has-error @endif">
		      <label for="nama_panggilan">Nama panggilan</label>
		      <input type="text" name="nama_panggilan" class="form-control" value="{{ old('nama_panggilan') !== null ? old('nama_panggilan') : $studentData['nama_panggilan'] }}" required>
		      <label class="error-text">{{ $errors->first('nama_panggilan') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('tempat_lahir')) has-error @endif">
		      <label for="tempat_lahir">Tempat lahir <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') !== null ? old('tempat_lahir') : $studentData['tempat_lahir'] }}" required>
		      <label class="error-text">{{ $errors->first('tempat_lahir') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('tanggal_lahir')) has-error @endif">
		      <label for="tanggal_lahir">Tanggal lahir <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input id="tanggal_lahir" type="text" name="tanggal_lahir" class="form-control" placeholder="yyyy-mm-dd" value="{{ old('tanggal_lahir') !== null ? old('tanggal_lahir') : $studentData['tanggal_lahir'] }}" required>
		      <label class="error-text">{{ $errors->first('tanggal_lahir') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('sma')) has-error @endif">
		      <label for="sma">SMA asal</label>
		      <input type="text" name="sma" class="form-control" value="{{ old('sma') !== null ? old('sma') : $studentData['sma'] }}" required>
		      <label class="error-text">{{ $errors->first('sma') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('alamat_asal')) has-error @endif">
		      <label for="alamat_asal">Alamat asal <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <textarea rows="4" name="alamat_asal" class="form-control" required>{{ old('alamat_asal') !== null ? old('alamat_asal') : $studentData['alamat_asal'] }}</textarea>
		      <label class="error-text">{{ $errors->first('alamat_asal') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('kota_asal')) has-error @endif">
		      <label for="kota_asal">Kota asal</label>
		      <input type="text" name="kota_asal" class="form-control" value="{{ old('kota_asal') !== null ? old('kota_asal') : $studentData['kota_asal'] }}">
		      <label class="error-text">{{ $errors->first('kota_asal') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('provinsi_asal')) has-error @endif">
		      <label for="provinsi_asal">Provinsi asal</label>
		      <select name="provinsi_asal" class="form-control">
		        <?php
		          $options = [
		            '',
		            'Aceh',
		            'Bali',
		            'Banten',
		            'Bengkulu',
		            'Gorontalo',
		            'Jakarta',
		            'Jambi',
		            'Jawa Barat',
		            'Jawa Tengah',
		            'Jawa Timur',
		            'Kalimantan Barat',
		            'Kalimantan Selatan',
		            'Kalimantan Tengah',
		            'Kalimantan Timur',
		            'Kalimantan Utara',
		            'Kepulauan Bangka Belitung',
		            'Kepulauan Riau',
		            'Lampung',
		            'Maluku',
		            'Maluku Utara',
		            'Nusa Tenggara Barat',
		            'Nusa Tenggara Timur',
		            'Papua',
		            'Papua Barat',
		            'Riau',
		            'Sulawesi Barat',
		            'Sulawesi Selatan',
		            'Sulawesi Tengah',
		            'Sulawesi Tenggara',
		            'Sulawesi Utara',
		            'Sumatera Barat',
		            'Sumatera Selatan',
		            'Sumatera Utara',
		            'Yogyakarta'
		          ];
		          $selected = old('provinsi_asal') !== null ? old('provinsi_asal') : $studentData['provinsi_asal'];
		        ?>
		        @foreach($options as $val){
		            @if ($selected == $val)
		            	<option selected>{{ $val }}</option>
		            @else
		            	<option>{{ $val }}</option>
		            @endif
		        @endforeach
		        
		      </select>
		      <label class="error-text">{{ $errors->first('provinsi_asal') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('kode_pos_asal')) has-error @endif">
		      <label for="kode_pos_asal">Kode pos asal <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input type="text" name="kode_pos_asal" class="form-control" value="{{ old('kode_pos_asal') !== null ? old('kode_pos_asal') : $studentData['kode_pos_asal'] }}">
		      <label class="error-text">{{ $errors->first('kode_pos_asal') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('alamat_studi')) has-error @endif">
		      <label for="alamat_studi">Alamat di Bandung <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <textarea rows="4" name="alamat_studi" class="form-control" required>{{ old('alamat_studi') !== null ? old('alamat_studi') : $studentData['alamat_studi'] }}</textarea>
		      <label class="error-text">{{ $errors->first('alamat_studi') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('kode_pos_studi')) has-error @endif">
		      <label for="kode_pos_studi">Kode pos di Bandung <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input type="text" name="kode_pos_studi" class="form-control" value="{{ old('kode_pos_studi') !== null ? old('kode_pos_studi') : $studentData['kode_pos_studi'] }}">
		      <label class="error-text">{{ $errors->first('kode_pos_studi') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('hp')) has-error @endif">
		      <label for="hp">Nomor HP <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input type="text" name="hp" class="form-control" value="{{ old('hp') !== null ? old('hp') : $studentData['hp'] }}" required>
		      <label class="error-text">{{ $errors->first('hp') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('telepon_darurat')) has-error @endif">
		      <label for="telepon_darurat">Nomor telepon darurat <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <input type="text" name="telepon_darurat" class="form-control" value="{{ old('telepon_darurat') !== null ? old('telepon_darurat') : $studentData['telepon_darurat'] }}" required>
		      <label class="error-text">{{ $errors->first('telepon_darurat') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('email')) has-error @endif">
		      <label for="email">Email</span></label>
		      <input type="email" name="email" class="form-control" value="{{ old('email') !== null ? old('email') : $studentData['email'] }}" required>
		      <label class="error-text">{{ $errors->first('email') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('email_students')) has-error @endif">
		      <label for="email_students">Email students.itb.ac.id</label>
		      <input type="email" name="email_students" class="form-control" value="{{ old('email_students') !== null ? old('email_students') : $studentData['email_students'] }}" required>
		      <label class="error-text">{{ $errors->first('email_students') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('line')) has-error @endif">
		      <label for="line">LINE</label>
		      <input type="text" name="line" class="form-control" value="{{ old('line') !== null ? old('line') : $studentData['line'] }}">
		      <label class="error-text">{{ $errors->first('line') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('twitter')) has-error @endif">
		      <label for="twitter">Twitter</label>
		      <input type="text" name="twitter" class="form-control" value="{{ old('twitter') !== null ? old('twitter') : $studentData['twitter'] }}">
		      <label class="error-text">{{ $errors->first('twitter') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('facebook')) has-error @endif">
		      <label for="facebook">Facebook</label>
		      <input type="text" name="facebook" class="form-control" value="{{ old('facebook') !== null ? old('facebook') : $studentData['facebook'] }}">
		      <label class="error-text">{{ $errors->first('facebook') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('golongan_darah')) has-error @endif">
		      <label for="golongan_darah">Golongan darah <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <select name="golongan_darah" class="form-control">
		        <?php
		          $options = ['', 'A', 'B', 'AB', 'O'];
		          $selected = old('golongan_darah') !== null ? old('golongan_darah') : $studentData['golongan_darah'];
		        ?>
		        @foreach($options as $val){
		            @if ($selected == $val)
		            	<option selected>{{ $val }}</option>
		            @else
		            	<option>{{ $val }}</option>
		            @endif
		        @endforeach
		      </select>
		      <label class="error-text">{{ $errors->first('golongan_darah') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('riwayat_penyakit')) has-error @endif">
		      <label for="riwayat_penyakit">Riwayat penyakit <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <textarea rows="4" name="riwayat_penyakit" class="form-control">{{ old('riwayat_penyakit') !== null ? old('riwayat_penyakit') : $studentData['riwayat_penyakit'] }}</textarea>
		      <label class="error-text">{{ $errors->first('riwayat_penyakit') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('unit')) has-error @endif">
		      <label for="unit">Unit/organisasi/aktivitas kemahasiswaan</label>
		      <textarea rows="4" name="unit" class="form-control">{{ old('unit') !== null ? old('unit') : $studentData['unit'] }}</textarea>
		      <label class="error-text">{{ $errors->first('unit') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('bio')) has-error @endif">
		      <label for="bio">Bio/deskripsi diri</label>
		      <textarea rows="4" name="bio" class="form-control">{{ old('bio') !== null ? old('bio') : $studentData['bio'] }}</textarea>
		      <label class="error-text">{{ $errors->first('bio') }}</label>
		    </div>

		    <div class="form-group @if ($errors->has('catatan')) has-error @endif">
		      <label for="catatan">Catatan/keterangan lainnya <span class="text-muted glyphicon glyphicon-lock"></span></label>
		      <textarea rows="4" name="catatan" class="form-control">{{ old('catatan') !== null ? old('catatan') : $studentData['catatan'] }}</textarea>
		      <label class="error-text">{{ $errors->first('catatan') }}</label>
		    </div>

		    <button class="btn btn-primary">Simpan <span class="glyphicon glyphicon-check"></span></button>
		    
		</form>
		<br><br>

	</div>

@endsection

@section('script')

	<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.id.js') }}"></script>

	<script>
	  window.onload = function(){
	    $('#tanggal_lahir').datetimepicker({
	      format: "yyyy-mm-dd",
	      language: "id",
	      startView: 4,
	      minView: 2,
	      initialDate: new Date('1997'),
	      autoclose: true
	    });
	  };
	</script>

@endsection
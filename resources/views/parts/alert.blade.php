<div class="alert-container">

	@if ($errors->has())
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger">{{ $error }}</div>
		@endforeach
	@endif

	@if (session('info') !== null)
		<div class="alert alert-info">{{ session('info') }}</div>
	@endif

	@if (session('warning') !== null)
		<div class="alert alert-warning">{{ session('warning') }}</div>
	@endif

</div>

@extends('layouts.app')

@section('title', 'Angels & Mortals')

@section('navigation')
	@include('parts.navigation', ['activeSection' => 'events'])
@endsection

@section('content')

	<style>

		.mortal-name {
			font-weight: 300;
			font-size: 20px;
		}

		.mortal-nim {
			font-weight: 700;
			color: gray;
			font-size: 16px;
		}

		.hint {
			font-size: 10px;
		}

		.chat-window {
			max-height: 400px;
			margin-bottom: 20px;
			overflow-y: auto;
			margin-right: -5px;
			padding-right: 5px;
		}

		.chat {
			margin-bottom: 10px;
		}

		.chat.self {
			text-align: right;
		}

		.chat .chat-bubble {
			background-color: #eee;
			padding: 10px;
			display:inline-block;
		}

		.chat.self .chat-bubble {
			background-color: #cfdfff;
		}

		.chat .chat-timestamp {
			font-size: 10px;
			margin-top: 2px;
		}

		@media (min-width: 992px){
			.top-panel {
				height:120px;
				text-overflow: ellipsis;
				white-space: nowrap;
				overflow:hidden;
			}
		}
		
	</style>

	<div class="page-container">

		@include('parts.alert')

		<div class="page-header">
			<h1>Angels &amp; Mortals <small>Round {{ $gameInfo['round'] }}</small></h1>
		</div>

		<div class="row">

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body top-panel">
						<p>Lakukanlah kebaikan untuk <i>mortal</i>-mu!</p>
						<div class="mortal-name"><a href="{{ url('studentdata/'.$mortal) }}">{{ $mortalName }}</a></div>
						<div class="mortal-nim">{{ $mortal }}</div>
				    </div>
			    </div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body top-panel">

						<form action="{{ url('events/angelsandmortals/guess') }}" method="POST">
							{{ csrf_field() }}
							<div class="input-group @if ($errors->has('nim')) has-error @endif">
						      <input type="text" name="nim" class="form-control" value="{{ old('nim') !== null ? old('nim') : '' }}" placeholder="Tebak NIM angel-mu disini!">
						      <span class="input-group-btn">
						      	<button class="btn btn-primary">Tebak</button>
						      </span>
						    </div>
						</form>
						<div style="height:5px;"></div>
						<p class="hint">Petunjuk: cari NIM <i>mortal</i>-mu di <a href="{{ url('studentdata') }}">Data Mahasiswa STEI</a></p>

					    <strong>Tebakan saat ini: </strong> 
					    @if ($guess !== null)
					    	<a href="{{ url('studentdata/'.$guess) }}">{{ $guessName }}</a>
					    @else
					    	Belum ada tebakan
					    @endif
				    </div>
			    </div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="chat-window">

							@forelse ($mortalMessages as $message)

								<div class="chat @if ($message->from==auth()->user()->nim) self @endif">
									<div class="chat-bubble">{{ $message->content }}</div>
									<div class="chat-timestamp"><?php echo ($message->from == auth()->user()->nim) ? 'You' : 'Mortal'; ?> [{{ $message->created_at }}]</div>
								</div>

							@empty
								<div class="hint"><i>Belum ada pesan masuk.</i></div>
							@endforelse

						</div>

						<form action="{{ url('events/angelsandmortals/messagemortal') }}" method="POST">
							{{ csrf_field() }}
							<div class="input-group @if ($errors->has('message')) has-error @endif">
						      <input type="text" name="message" class="form-control" value="{{ old('message') !== null ? old('message') : '' }}" placeholder="Kirim pesan untuk mortal-mu" required>
						      <span class="input-group-btn">
						      	<button class="btn btn-primary">Kirim</button>
						      </span>
						    </div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="chat-window">

							@forelse ($angelMessages as $message)

								<div class="chat @if ($message->from==auth()->user()->nim) self @endif">
									<div class="chat-bubble">{{ $message->content }}</div>
									<div class="chat-timestamp"><?php echo ($message->from == auth()->user()->nim) ? 'You' : 'Angel'; ?> [{{ $message->created_at }}]</div>
								</div>

							@empty
								<div class="hint"><i>Belum ada pesan masuk.</i></div>
							@endforelse

						</div>

						<form action="{{ url('events/angelsandmortals/messageangel') }}" method="POST">
							{{ csrf_field() }}
							<div class="input-group @if ($errors->has('message')) has-error @endif">
						      <input type="text" name="message" class="form-control" value="{{ old('message') !== null ? old('message') : '' }}" placeholder="Kirim pesan untuk angel-mu" required>
						      <span class="input-group-btn">
						      	<button class="btn btn-primary">Kirim</button>
						      </span>
						    </div>
						</form>
					</div>
				</div>
			</div>

		</div>

	</div>

@endsection

@section('script')

	<script>

		// Scroll all chat windows to bottom at page load

		$('.chat-window').each(function (index, item) {
			this.scrollTop = this.scrollHeight;
		});

	</script>

@endsection
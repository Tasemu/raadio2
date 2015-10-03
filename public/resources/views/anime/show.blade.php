@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-3">
		<img src="{{ $anime->image }}" alt="{{ $anime->name }}" style="width:100%">
	</div>
	<div class="col-md-9">
		<h1>{{ $anime->name }}</h1>
		<p>{{ $anime->synopsis }}</p>
		<div class="home-tracks">
			@foreach($anime->tracks as $t)
			<div class="new-track">
				<span class="new-track--link" data-href="https://s3-us-west-2.amazonaws.com/raadiotracks/{{$t->id}}.mp3">
					<div class="new-track--thumbnail" style="background-image:url({{ $t->anime->image }})">
						<i class="fa new-track--play-icon fa-play hidden"></i>
						<i class="fa new-track--pause-icon fa-pause hidden"></i>
						<i class="fa new-track--loading-icon fa-circle-o-notch fa-spin hidden"></i>
					</div>
					<span class="new-track--details">
						<div class="new-track--visual"></div>
						<div class="new-track--title">
							<span>{{ $t->name }}</span>
						</div>
					</span>
				</span>
			</div>
			@endforeach
		</div>
	</div>	
</div>
@endsection
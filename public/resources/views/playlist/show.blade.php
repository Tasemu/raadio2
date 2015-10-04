@extends('layouts.master')
@section('content')
<div class="row">
	<h1>{{ $playlist->name }}</h1>
	<div class="home-tracks">
		@foreach($playlist->tracks as $t)
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
					<div class="new-track--anime">
						<a class="new-track--anime-link" href="{{ url('anime', [$t->anime->id]) }}"><span>{{ $t->anime->name }}</span></a>
					</div>
				</span>
			</span>
		</div>
		@endforeach
	</div>
</div>
@endsection
@extends('layouts.master')
@section('content')
<div class="row">
	<form class="playlist-builder" action="{{ route('playlists.store') }}" method="post">
		<input type="hidden" name="playlist_name" value="{{ $playlist_name }}">
		<div class="col-md-6 playlist-builder--chooser">
			<input type="text" class="playlist-builder--search">
			<ul class="playlist-builder-anime-list">
				@foreach($anime as $series)
				<li class="playlist-builder--anime">
					<img src="{{ $series->image }}" alt="{{ $series->name }}" width="50px">
					<span class="playlist-builder--anime-name">{{ $series->name }}</span>
					<ul class="playlist-builder--anime-track-list">
						@foreach($series->tracks as $track)
						<li class="playlist-builder--track" data-id="{{ $track->id }}">
							<span class="playlist-builder--track-name">{{ $track->name }}</span>
						</li>
						@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
		<div class="col-md-6 playlist-builder--chosen">
			<ul class="playlist-builder--selected-tracks"></ul>
		</div>
	</form>
</div>
@endsection
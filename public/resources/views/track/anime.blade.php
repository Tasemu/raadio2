@extends('layouts.master')

@section('content')
	<div class="col-md-6 col-md-push-3 new-track-form">
		<form action="{{ route('tracks.store') }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="anime_name" value="">
			<input type="hidden" name="anime_image" value="">
			<input type="hidden" name="anime_synopsis" value="">
			<input type="hidden" name="anime_url" value="">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<div class="form-group">
				<label for="name">Track Name</label>
				<input type="text" name="name" class="form-control" value="{{ $track }}">
			</div>
			<div class="form-group new-track-form--series-list">
				<ul>
					@foreach ($series as $s)
					<li class="new-track-form--series" data-anime="{{ JSON_encode($s) }}">
						<div class="new-track-form--series-image" style="background-image:url({{ $s['cover_image'] }})" width="120" height="120"></div>
						<div class="new-track-form--series-details">
							<span class="anime-title">{{ $s['title'] }}</span>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="form-group">
				<label for="track">Track MP3</label>
				<input type="file" name="track">
			</div>
			<div class="form-group">
				<input type="submit" value="next" class="btn">
			</div>
		</form>
	</div>
@endsection
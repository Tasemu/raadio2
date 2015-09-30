@extends('layouts.master')

@section('content')
	<div class="col-md-4 col-md-push-4">
		<form action="{{ route('tracks.setanime') }}" method="get">
			<div class="form-group">
				<label for="name">Track Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="anime">Anime Name</label>
				<input type="text" name="anime" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" value="next" class="btn">
			</div>
		</form>
	</div>
@endsection
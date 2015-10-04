@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-4 col-md-push-4">
		<form action="{{ route('playlists.build') }}" method="get">
			<div class="form-group">
				<label for="name">Playlist Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" value="next" class="btn">
			</div>
		</form>
	</div>
</div>
@endsection
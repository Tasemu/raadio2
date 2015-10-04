<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Anime;
use App\Track;
use App\Playlist;
use Auth;
use Storage;

class HomeController extends Controller {
	public function getIndex()
	{
		$tracks = Track::with('anime')->limit(10)->get();
		$playlists = Playlist::limit(10)->get();

		return view('home', ['tracks' => $tracks, 'playlists' => $playlists]);
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laracurl;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Anime;
use App\Track;
use Auth;
use Storage;

class TrackController extends Controller
{

    public function slugify($text)
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
      $text = trim($text, '-');

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function setAnime(Request $req)
    {
        $track = $req->input('name');
        $anime = $req->input('anime');
        $slug = $this->slugify($anime);

        $series = json_decode(Laracurl::get('http://hummingbird.me/api/v1/search/anime?query=' . $slug), true);

        return view('track.anime', ['track' => $track, 'anime' => $anime, 'series' => $series]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('track.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        // Check to see if anime exists, if not then create new anime record
        $series = Anime::where('url', $request->input('anime_url'))->first();
        if ($series === null) {
            $series = new Anime;
            $series->name = $request->input('anime_name');
            $series->user_id = Auth::user()->id;
            $series->image = $request->input('anime_image');
            $series->synopsis = $request->input('anime_synopsis');
            $series->url = $request->input('anime_url');
            $series->save();
        }

        $mp3 = $request->file('track');

        $track = new Track;
        $track->name = $request->input('name');
        $track->user_id = Auth::user()->id;
        $track->anime_id = $series->id;
        $track->track = $mp3->getClientOriginalExtension();
        $track->save();

        if (!$request->hasFile('track'))
            return "no file uploaded";

        //Use some method to generate your filename here. Here we are just using the ID of the image
        $filename = $track->id . "." . $track->track;
     
        //Push file to S3
        Storage::disk('s3')->put($filename, file_get_contents($mp3));

        return redirect()->route('home')->with('status', 'Track Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

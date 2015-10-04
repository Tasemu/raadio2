var TrackAnimeSelector = require('./modules/track-anime-selector.js');
var MusicPlayer = require('./modules/music-player.js');
var PlaylistBuilder = require('./modules/playlist-builder.js');

$(function () {
	TrackAnimeSelector.init();
	var musicPlayer = new MusicPlayer();

	$('.new-track--link').click(e => {
		musicPlayer.setSource($(e.currentTarget).attr('data-href'), $(e.currentTarget));
		musicPlayer.play();
		e.preventDefault();
	});

	$('.new-track--anime-link').click(e => {
		e.stopPropagation();
	});

	$('.playlist-builder').each(() => {

		var playlistBuilder = new PlaylistBuilder();

		$('.playlist-builder--track').click(e => {
			playlistBuilder.selectSong({name: $(e.currentTarget).text(), id: $(e.currentTarget).attr('data-id')});
		});

		$('.playlist-builder--selected-tracks').on('click', '.playlist-builder--selected-track', e => {
			playlistBuilder.removeSong({name: $(e.currentTarget).text(), id: $(e.currentTarget).attr('data-id')});
		});

	});
});
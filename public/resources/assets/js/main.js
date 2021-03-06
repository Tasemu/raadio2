var TrackAnimeSelector = require('./modules/track-anime-selector.js');
var MusicPlayer = require('./modules/music-player.js');

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
});
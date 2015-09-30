var TrackAnimeSelector = (function () {
	var _active = null;

	var _setActiveSeries = (anime) => {
		console.log(anime);
		$('input[name="anime_id"]').val(anime.slug);
		$('input[name="anime_name"]').val(anime.title);
		$('input[name="anime_image"]').val(anime.cover_image);
		$('input[name="anime_synopsis"]').val(anime.synopsis);
		$('input[name="anime_url"]').val(anime.url);
	}

	var _setListeners = () => {
		$('.new-track-form--series').on('click', function () {
			_setActiveSeries(JSON.parse($(this).attr('data-anime')));
			$('.new-track-form--series').removeClass('active');
			$(this).addClass('active');
		});
	}

	var init = () => {
		_setListeners();
	}

	return {
		init: init
	}

})();

module.exports = TrackAnimeSelector;
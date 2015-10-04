(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var TrackAnimeSelector = require('./modules/track-anime-selector.js');
var MusicPlayer = require('./modules/music-player.js');
var PlaylistBuilder = require('./modules/playlist-builder.js');

$(function () {
	TrackAnimeSelector.init();
	var musicPlayer = new MusicPlayer();

	$('.new-track--link').click(function (e) {
		musicPlayer.setSource($(e.currentTarget).attr('data-href'), $(e.currentTarget));
		musicPlayer.play();
		e.preventDefault();
	});

	$('.new-track--anime-link').click(function (e) {
		e.stopPropagation();
	});

	$('.playlist-builder').each(function () {

		var playlistBuilder = new PlaylistBuilder();

		$('.playlist-builder--track').click(function (e) {
			playlistBuilder.selectSong({ name: $(e.currentTarget).text(), id: $(e.currentTarget).attr('data-id') });
		});

		$('.playlist-builder--selected-tracks').on('click', '.playlist-builder--selected-track', function (e) {
			playlistBuilder.removeSong({ name: $(e.currentTarget).text(), id: $(e.currentTarget).attr('data-id') });
		});
	});
});

},{"./modules/music-player.js":2,"./modules/playlist-builder.js":3,"./modules/track-anime-selector.js":4}],2:[function(require,module,exports){
'use strict';

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var MusicPlayer = (function () {
	function MusicPlayer() {
		_classCallCheck(this, MusicPlayer);

		this.isPlaying = false;
		this.isLoading = false;
		this.isPaused = false;
		this.sound = null;
		this.activeVisual = null;
	}

	_createClass(MusicPlayer, [{
		key: 'setListeners',
		value: function setListeners() {
			var _this = this;

			this.sound.on('play', function () {
				console.log('play');
				_this.isLoading = false;
				_this.isPlaying = true;
				_this.render();

				var songPing = setInterval(function () {
					_this.update();
				}, 200);
			});

			this.sound.on('pause', function () {
				console.log('pause');
				_this.isPaused = true;
				_this.isPlaying = false;
				_this.render();
			});

			this.sound.on('end', function () {
				console.log('end');
				_this.stopSong();
			});

			$(this.activeVisual).find('.new-track--play-icon').on('click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				_this.pause();
			});

			$(this.activeVisual).find('.new-track--pause-icon').on('click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				_this.resume();
			});
		}
	}, {
		key: 'play',
		value: function play() {
			console.log('play function');
			this.isLoading = true;
			this.isPaused = false;
			this.render();
			this.sound.play();
		}
	}, {
		key: 'resume',
		value: function resume() {
			this.isPlaying = true;
			this.isPaused = false;
			this.render();
			this.sound.play();
		}
	}, {
		key: 'setSource',
		value: function setSource(song, element) {

			if (this.sound !== null) {
				console.log('unloading instance');
				this.stopSong();
				this.sound.unload();
			}

			console.log('setting new visual node');
			this.activeVisual = $(element);

			console.log('starting new instance');
			this.sound = new Howl({
				src: [song],
				html5: true
			});
			console.log('setting listeners');
			this.setListeners();
		}
	}, {
		key: 'pause',
		value: function pause() {
			this.sound.pause();
		}
	}, {
		key: 'stopSong',
		value: function stopSong() {
			console.log('stopSong');
			this.isPlaying = false;
			this.isLoading = false;
			this.isPaused = false;
			this.sound.stop();
			this.update();
			this.render();
		}
	}, {
		key: 'render',
		value: function render() {
			if (this.isLoading) {
				$(this.activeVisual).find('.new-track--loading-icon').removeClass('hidden');
			} else {
				$(this.activeVisual).find('.new-track--loading-icon').addClass('hidden');
			}

			if (this.isPlaying) {
				$(this.activeVisual).find('.new-track--play-icon').removeClass('hidden');
			} else {
				$(this.activeVisual).find('.new-track--play-icon').addClass('hidden');
			}

			if (this.isPaused) {
				$(this.activeVisual).find('.new-track--pause-icon').removeClass('hidden');
			} else {
				$(this.activeVisual).find('.new-track--pause-icon').addClass('hidden');
			}
		}
	}, {
		key: 'update',
		value: function update() {
			if (this.isPlaying || this.isPaused) {
				$(this.activeVisual).find('.new-track--visual').width(this.sound.seek() / 355 * 100 + '%');
			} else {
				$(this.activeVisual).find('.new-track--visual').width('0');
			}
		}
	}]);

	return MusicPlayer;
})();

module.exports = MusicPlayer;

},{}],3:[function(require,module,exports){
'use strict';

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

module.exports = (function () {
	function PlaylistBuilder() {
		_classCallCheck(this, PlaylistBuilder);

		this.selectedTracks = [];
	}

	_createClass(PlaylistBuilder, [{
		key: 'selectSong',
		value: function selectSong(track) {
			this.selectedTracks.push(track);
			console.log(this.selectedTracks);
			this.render();
		}
	}, {
		key: 'removeSong',
		value: function removeSong(track) {
			this.selectedTracks = _.filter(this.selectedTracks, function (selected) {
				return selected.id !== track.id;
			});
			this.render();
		}
	}, {
		key: 'createPlaylist',
		value: function createPlaylist() {}
	}, {
		key: 'render',
		value: function render() {
			var trackNodes = _.map(this.selectedTracks, function (track) {
				return '<li class="playlist-builder--selected-track" data-id="' + track.id + '">' + track.name + '</li>';
			});

			$('.playlist-builder--selected-tracks').html(trackNodes);
		}
	}]);

	return PlaylistBuilder;
})();

},{}],4:[function(require,module,exports){
'use strict';

var TrackAnimeSelector = (function () {
	var _active = null;

	var _setActiveSeries = function _setActiveSeries(anime) {
		console.log(anime);
		$('input[name="anime_id"]').val(anime.slug);
		$('input[name="anime_name"]').val(anime.title);
		$('input[name="anime_image"]').val(anime.cover_image);
		$('input[name="anime_synopsis"]').val(anime.synopsis);
		$('input[name="anime_url"]').val(anime.url);
	};

	var _setListeners = function _setListeners() {
		$('.new-track-form--series').on('click', function () {
			_setActiveSeries(JSON.parse($(this).attr('data-anime')));
			$('.new-track-form--series').removeClass('active');
			$(this).addClass('active');
		});
	};

	var init = function init() {
		_setListeners();
	};

	return {
		init: init
	};
})();

module.exports = TrackAnimeSelector;

},{}]},{},[1]);

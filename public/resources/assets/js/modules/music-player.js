class MusicPlayer {
	constructor () {
		this.isPlaying = false;
		this.isLoading = false;
		this.isPaused = false;
		this.sound = null;
		this.activeVisual = null;
	}

	setListeners () {

		this.sound.on('play', () => {
			console.log('play');
			this.isLoading = false;
			this.isPlaying = true;
			this.render();

			var songPing = setInterval(() => {
				this.update();
			}, 200);
		});

		this.sound.on('pause', () => {
			console.log('pause');
			this.isPaused = true;
			this.isPlaying = false;
			this.render();
		});

		this.sound.on('end', () => {
			console.log('end');
			this.stopSong();
		});

		$(this.activeVisual).find('.new-track--play-icon').on('click', (e) => {
			e.stopPropagation();
			e.preventDefault();
			this.pause();
		});

		$(this.activeVisual).find('.new-track--pause-icon').on('click', (e) => {
			e.stopPropagation();
			e.preventDefault();
			this.resume();
		});
	}

	play () {
		console.log('play function');
		this.isLoading = true;
		this.isPaused = false;
		this.render();
		this.sound.play();
	}

	resume () {
		this.isPlaying = true;
		this.isPaused = false;
		this.render();
		this.sound.play();
	}

	setSource (song, element) {

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

	pause () {
		this.sound.pause();
	}

	stopSong () {
		console.log('stopSong');
		this.isPlaying = false;
		this.isLoading = false;
		this.isPaused = false;
		this.sound.stop();
		this.update();
		this.render();
	}

	render () {
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

	update () {
		if (this.isPlaying || this.isPaused) {
			$(this.activeVisual).find('.new-track--visual').width((this.sound.seek() / 355) * 100 + '%');
		} else {
			$(this.activeVisual).find('.new-track--visual').width('0');
		}
	}
}

module.exports = MusicPlayer;
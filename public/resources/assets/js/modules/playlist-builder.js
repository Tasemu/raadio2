module.exports = class PlaylistBuilder {
	constructor () {
		this.selectedTracks = [];
	}

	selectSong (track) {
		this.selectedTracks.push(track);
		console.log(this.selectedTracks);
		this.render();
	}

	removeSong(track) {
		this.selectedTracks = _.filter(this.selectedTracks, selected => {
			return selected.id !== track.id;
		});
		this.render();
	}

	createPlaylist () {

	}

	render () {
		var trackNodes = _.map(this.selectedTracks, (track, index) => {
			return `<li class="playlist-builder--selected-track" data-id="${track.id}">
				${track.name}
				<input type="hidden" name="playlist_track[${index}]" value="${track.id}">
			</li>`;
		});

		$('.playlist-builder--selected-tracks').html(trackNodes);
	}
};
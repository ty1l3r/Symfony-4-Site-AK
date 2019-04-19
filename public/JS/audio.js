// DOM
var context = document.querySelector('.music-container');
var controls = document.querySelector('.controls');

//CONST
var CLIENTID = 'd438c4a17e1716c6db0c5fbefc2c8876';

// VARS
var audioPlayer;

// Init Soundcloud Widget
SC.initialize({
	client_id: CLIENTID,
	redirectURI: 'http://localhost:9001'
});

SC.stream('tracks/1326276').then(function(player) {
	audioPlayer = player;
	init();
});

function toggleHover() {
	context.classList.toggle('is-hovering');
}

// FN
function handleControlsClick(e) {
	var trgt = e.target;
	if (trgt.nodeName !== 'LABEL' && !audioPlayer) {
		return;
	}

	switch (trgt.className) {
		case 'lbl-btn-play':
			audioPlayer.play();
			break;
		case 'lbl-btn-pause':
			audioPlayer.pause();
			break;
		case 'lbl-btn-reset':
			audioPlayer.seek(0);
			audioPlayer.play();
			break;
		default:
			return false;
	}
}

function init() {
	context.classList.add('is-hovering');

	setTimeout(function() {
		controls.querySelector('input#btn-play').checked = true;
		audioPlayer.play();
	}, 1000);
	setTimeout(function() {
		context.classList.remove('is-hovering');
	}, 4000);

	controls.addEventListener('click', handleControlsClick);

	if (Modernizr.touch) {
		context.addEventListener('click', toggleHover);
	}
}

<div id="playlist_end"></div>
<!--	<iframe class="music-frame" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/145996694&amp;color=1485A1&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=false"></iframe>
	
	<iframe class="music-frame" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/127897553&amp;color=1485A1&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=false"></iframe>

	<iframe class="music-frame" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/141414055&amp;color=1485A1&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=false"></iframe>-->
	</div>   
    </div>
    <div id="audio">
       	<audio id="player" controls>
       		<source id="mp3" src="" type='audio/mpeg; codecs="mp3"'>
  			<source id="ogg" src="" type='audio/ogg; codecs="vorbis"'>
       	</audio>
        
        <div id="progress_bar">
        	<div id="progress_bar_load"></div>
        	<div id="progress_bar_play"></div>
		</div>
        <div id="button_panel">
        	<div id="prev"></div>
            <div id="play"></div>
            <div id="pause"></div>
            <div id="next"></div>
        </div>
        <div id="time">0:00:00</div>
        <div id="time_emerge"></div>
		<div id="volume_bar"></div>
        <div id="volume_now"></div>
	</div>
<script type="text/javascript">
	var player = document.getElementById('player');
	
	var song = {pause : false,
				firstPlay: true,
				firstSong: document.getElementById('inconteiner').children[0],
				playlistEnd: document.getElementById('playlist_end')};

	var playerPanel = {
					time : document.getElementById('time'),
					timeEmerge: document.getElementById('time_emerge'),
					progressBar : document.getElementById('progress_bar'),
					progressBarLoad : document.getElementById('progress_bar_load'),
					progressBarPlay : document.getElementById('progress_bar_play'),
					buttonPanel : document.getElementById('button_panel'),
					pauseButton : document.getElementById('pause'),
					playButton : document.getElementById('play'),
					prevButton : document.getElementById('prev'),
					nextButton : document.getElementById('next'),
					volumeBar: document.getElementById('volume_bar'),
					volumeNow: document.getElementById('volume_now'),
					defaultVolume : 0.3
					};

	var positionFixedLeft = Math.round((document.body.offsetWidth - playerPanel.progressBar.clientWidth)/2);
	
	playerPanel.progressBar.style.left = positionFixedLeft + "px";
	playerPanel.progressBarLoad.style.left = positionFixedLeft + "px";
	playerPanel.progressBarPlay.style.left = positionFixedLeft + "px";
	playerPanel.buttonPanel.style.left = positionFixedLeft - 120 + "px";
	playerPanel.time.style.left = positionFixedLeft + playerPanel.progressBar.clientWidth + 10 + "px";
	
	var timePosition = playerPanel.time.getBoundingClientRect();
	playerPanel.volumeBar.style.left = timePosition.right + 10 + "px";
	playerPanel.volumeNow.style.left = timePosition.right + 10 + "px";

	player.volume = playerPanel.defaultVolume;
	playerPanel.volumeNow.style.width = Math.round(playerPanel.volumeBar.clientWidth * playerPanel.defaultVolume) + "px";
	
	function volumeChange(){
		var e = event || window.event;
		player.volume = ((e.clientX - timePosition.right - 10)/playerPanel.volumeBar.clientWidth).toFixed(1);
		playerPanel.volumeNow.style.width = Math.round(playerPanel.volumeBar.clientWidth * player.volume) + "px";
		return false;
		}
	
	playerPanel.volumeBar.addEventListener("click",volumeChange);
	playerPanel.volumeNow.addEventListener("click", volumeChange);
	
	function playButtonsHide(){
		song.isPlaying.children[0].style.display = 'none';
		playerPanel.playButton.style.display = 'none';
		return false;
		}
	function pauseButtonsHide(){
		song.isPlaying.children[1].style.display = 'none';
		playerPanel.pauseButton.style.display = 'none';
		return false;
		}
	function playButtonsShow(){
		song.isPlaying.children[0].style.display = 'inline-block';
		playerPanel.playButton.style.display = 'inline-block';
		return false;
		}
	function pauseButtonsShow(){
		song.isPlaying.children[1].style.display = 'inline-block';
		playerPanel.pauseButton.style.display = 'inline-block';
		return false;
		}
	
	playerPanel.pauseButton.addEventListener("click", function(){
		pauseButtonsHide();
		playButtonsShow();
		player.pause();
		});
	playerPanel.playButton.addEventListener("click", function(){
		player.play();
		if(!song.firstPlay){
			playButtonsHide();
			pauseButtonsShow();
			}
		});
	playerPanel.nextButton.addEventListener("click", function(){
		playerPanel.playButton.style.display = 'none';
		playerPanel.pauseButton.style.display = 'inline-block';
		playSong(song.nextSong.children[0]);
		});
	playerPanel.prevButton.addEventListener("click", function(){
		playerPanel.playButton.style.display = 'none';
		playerPanel.pauseButton.style.display = 'inline-block';
		playSong(song.prevSong.children[0]);
		});

	function playSong(btn){			
		playerPanel.playButton.style.display = 'none';
		playerPanel.pauseButton.style.display = 'inline-block';
		
		var songDiv = btn.parentNode;
		var mp3Src = songDiv.children[3].innerHTML;
		var oggSrc = songDiv.children[4].innerHTML;
	
		var mp3 = document.getElementById('mp3');
		var ogg = document.getElementById('ogg');

		player.pause();
		
		playerPanel.progressBarLoad.style.width = 0 + "px";
		playerPanel.progressBarPlay.style.width = 0 + "px";
		
		song.prevSong = (songDiv != song.firstSong)?songDiv.previousSibling:song.playlistEnd.previousSibling;
		song.nextSong = (songDiv.nextSibling != song.playlistEnd)?songDiv.nextSibling:song.firstSong;
		
		if(songDiv != song.isPlaying){
			song.isPlaying = songDiv;
			song.isPlaying.children[0].style.display = 'none';
			song.isPlaying.children[1].style.display = "inline-block";
			song.isPlaying.children[2].style.backgroundColor = '#abc6e0';
			if (!song.firstPlay){
				song.wasPlaying.children[1].style.display = 'none';
				song.wasPlaying.children[0].style.display = "inline-block";
				song.wasPlaying.children[2].style.backgroundColor = 'transparent';
				}
			song.firstPlay = false;
			song.wasPlaying = song.isPlaying;
			}
	
		mp3.setAttribute('src', mp3Src);
		ogg.setAttribute('src', oggSrc);
		player.load();
		player.play();
		return false;
		};
	
	document.getElementById("inconteiner").addEventListener("click", function(){
		var e = event || window.event;
		if (e.target.className == "play_btn"){
			if(e.target.parentNode === song.isPlaying){
				if(song.pause){
					playButtonsHide();
					pauseButtonsShow();
					player.play();
					song.pause = false;
					} 
				else{playSong(e.target);}
				}
			else {playSong(e.target);}
			}
			
		if (e.target.className == "pause_btn"){
			player.pause();
			pauseButtonsHide();
			playButtonsShow();
			song.pause = true;
			}
		
		});
	
		player.addEventListener('ended', function(){
			song.nextSong = (song.isPlaying.nextSibling != song.playlistEnd)?song.isPlaying.nextSibling:song.firstSong;
			playSong(song.nextSong.children[0]);
			});
	
	function showProgressWidth(){
		playerPanel.progressBarPlay.style.width = Math.round(player.currentTime/player.duration*playerPanel.progressBar.clientWidth)+"px";
		return false;
		}
	function showTime(){
		playerPanel.time.innerHTML = numeral(Math.floor(player.currentTime)).format('00:00:00');/*numeral().format() - відображення часу в заданому форматі*/
		return false;
		};
	player.addEventListener("timeupdate", showProgressWidth);
	player.addEventListener("timeupdate", showTime);	
		
	player.addEventListener("progress",function(){
		playerPanel.progressBarLoad.style.width = Math.round(player.buffered.end(0)/player.duration*playerPanel.progressBar.clientWidth)+"px";
		});
	
	
	var playProgress = {
		pressState: false,
		coordinates: playerPanel.progressBar.getBoundingClientRect()}

	function showTimeEmerge(){
		e = event || window.event;
		playerPanel.timeEmerge.style.left = e.clientX - 45 + "px";
		var time = Math.round((e.clientX - playProgress.coordinates.left)/playerPanel.progressBar.clientWidth*player.duration);
		playerPanel.timeEmerge.innerHTML = playerPanel.timeEmerge.innerHTML = numeral(Math.floor(time)).format('00:00:00');
		playerPanel.timeEmerge.style.display = "inherit";
		}

	playerPanel.progressBar.addEventListener("mousemove", showTimeEmerge);
	playerPanel.progressBar.addEventListener("mouseout", function(){
		playerPanel.timeEmerge.style.display = "none";});
	
	function changeProgressWidth(){
		var e = event || window.event;
		
		var width = e.clientX - playProgress.coordinates.left;
		playerPanel.progressBarPlay.style.width = width + "px";
		playProgress.width = width;
		return false;
		}
	
	function progressPress(){
		var e = event || window.event;
		playProgress.pressState = true;
		player.removeEventListener("timeupdate", showProgressWidth);
		changeProgressWidth();
		return false;
		};
		
	function moveMouse(){
		if (playProgress.pressState){changeProgressWidth();};	
		}
		
	function goPlay(){
		if(playProgress.pressState){
			playProgress.pressState = false;
			player.addEventListener("timeupdate", showProgressWidth);
			player.pause();
			player.currentTime = Math.round(playProgress.width/playerPanel.progressBar.clientWidth*player.duration);
			player.play();
			playButtonsHide();
			pauseButtonsShow();
			return false;
			}
		}	
		
	document.getElementById('progress_bar').addEventListener("mousedown", progressPress);
	document.getElementById('audio').addEventListener("mousemove", moveMouse);
	document.body.addEventListener("mouseup", goPlay);
</script>
<div id="page_end"></div>
</body>
</html>

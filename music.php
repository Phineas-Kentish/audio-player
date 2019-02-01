<style>
    body{
        text-align: center;
        background-color: antiquewhite;
        color: indianred;
    }
    li{
        background-color: indianred;
        margin: 5px;
        border-radius: 34px;
        text-align: center;
    }
    button{
        background-color: transparent;
        border: none;
        color: antiquewhite;
    }
    button:focus {
        outline: 0;
    }
    #triangle{
        width: 0;
        height: 0;
        border-bottom: 20px solid transparent;
        border-top: 20px solid transparent;
        border-left: 30px solid indianred;
    }
    .pause{
        width: 10px;
        height: 36px;
        margin: 3px;
        background-color: indianred;
        display: inline-block;
    }
    .play-list{
        display: block;
    }
    .time{
        display: inline;
    }
    #time-bar{
        width: 100%;
        height: 2px;
        background-color: grey;
        display: flex;
        align-items: center;

    }
    #time-cursor{
        background-color: indianred;
        height: 10px;
        width: 10px;
        border-radius: 5px;
    }
</style>
<body>

    <div id="controls">
        <button id="play" class="controls"><div id="triangle"></div></button>
        <button id="pause" class="controls"><div class="pause"></div><div class="pause"></div></button>
        <div id="time" class="controls">
            <div class="time" id="timer" style="float: left"></div><div class="time" id="total-time" style="float: right"></div>
            <div class="time" id="time-bar"><div id="time-cursor"></div></div>
        </div>
    </div>
    <div id="play-list">
        <ol>
            <li><button class="play-list" id="0" value="music/reminisce.wav">reminisce</button></li>
            <li><button class="play-list" id="1" value="music/super-freak.mp3">super freak</button></li>
            <li><button class="play-list" id="2" value="music/reality-world.wav">reality world</button></li>
            <li><button class="play-list" id="3" value="music/the-girl-from-ipanema.wav">the girl from ipanema</button></li>
            <li><button class="play-list" id="4" value="music/bottles.wav">Bottles</button></li>
<!--            <li><button class="play-list" id="5" value="music/untitled1.wma">Untitled1</button></li>-->
<!--            <li><button class="play-list" id="6" value="music/untitled1.wma">Untitled1</button></li>-->
<!--            <li><button class="play-list" id="7" value="music/untitled2.wma">Untitled2</button></li>-->
            <li><button class="play-list" id="8" value="music/untitled3.wav">Untitled3</button></li>
<!--            <li><button class="play-list" id="9" value="music/untitled4.wma">Untitled4</button></li>-->
<!--            <li><button class="play-list" id="10" value="music/untitled5.wma">Untitled5</button></li>-->
        </ol>
    </div>
</body>

<script>

                              //VARIABLE//
    var list = document.getElementsByClassName("play-list");
    var playList = [];
    currentSong = 0;
    var playBtn = document.getElementById("play");
    var pauseBtn = document.getElementById("pause");
    var timer = document.getElementById("timer");
    var totalTime = document.getElementById("total-time");
    var timeCursor = document.getElementById("time-cursor");
    var timeBar = document.getElementById("time-bar");

                           //DEFINE THE CLASS//
    function Song(fileName){
        this.fileName = fileName;
        this.song = new Audio();
        this.song.src = this.fileName;

        this.playSong = function () {
            this.song.play();
        };

        this.pauseSong = function () {
            this.song.pause();
        };

    }

                    //MAKE AN OBJECT FOR EACH SONG//
    for(let i = 0; i < list.length; i++){
        playList.push(new Song(list[i].value))
    }

                //PLAY SONG ON CLICK//
    for(let i = 0; i < list.length; i++) {
        list[i].addEventListener("click", function () {
            playList[currentSong].pauseSong();
            currentSong = i;
            playList[i].playSong();
        });
    }

                      //PLAY ACTIVE TRACK//
    playBtn.addEventListener("click", function () {
        playList[currentSong].playSong();
    });


                      //PAUSE ACTIVE TRACK//
    pauseBtn.addEventListener("click", function () {
        playList[currentSong].pauseSong();
    });


    setInterval(function(){
        timer.innerHTML = (playList[currentSong].song.currentTime / 60).toFixed(2);
        totalTime.innerHTML = (playList[currentSong].song.duration / 60).toFixed(2);
        timeCursor.style.marginLeft = ((playList[currentSong].song.currentTime / 100) *  playList[currentSong].song.duration).toString() + "px";
    },100);

    timeBar.addEventListener("click", function(){
        var trackWidth = (window.innerWidth - 16);
        var timeSelect = (event.clientX - 8);
        var timeSelectPercentage = ((timeSelect / trackWidth) * 100);
        var timeSelectSeconds = (playList[currentSong].song.duration / 100) * timeSelectPercentage;
        console.log(timeSelectSeconds);
        playList[currentSong].song.currentTime = timeSelectSeconds;
    })
















    // var pauseSong = document.getElementById("pause");
    // var playList = document.getElementsByClassName("play-list");
    // var audio = document.getElementById("myAudio");
    //
    // console.log(audio.duration);
    // audio.play();



    // playSong.addEventListener("click",
    //     function playSong() {
    //     var song = new Audio("music/super-freak.mp3");
    //     song.play();
    //     console.log(song);
    // })


























    // for(let i = 0; i < playList.length; i++){
    //     audio[i] = new Audio(playList[i].value);
    // }

    // var song = new Audio("music/reality-world.wav");
    // // song.play();
    //
    // // audio[0].play();
    //
    // console.log(audio[0]);
    // console.log(playList[0].value);
    //


    // function playTrack(selectedTrack) {
    //     selectedTrack.play();
    // })


    // function pauseTrack(selectedTrack){
    //     selectedTrack.pause();
    // })

</script>
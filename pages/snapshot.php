<?php
include'../includes/connection.php';
include'../includes/header.php';
?>
<style type="text/css">
  video {
         display: block;
       }
       #videocontainer, canvas {
         width: 500px;
         margin: 10px auto;
       }
       #videocontainer img {
         display: block;
       }
       #videocontainer.playing img {
         display: block;
       }
      
       #cover {
         z-index: 10;
         background: transparent;
         display: none;
       }
       .reviewing #cover {
         display: block;
         -webkit-animation: flash 1s;
            -moz-animation: flash 1s;
          /*-o-animation: flash 1s;*/
             -ms-animation: flash 1s;
                 animation: flash 1s;
       }
       /*
         TODO:
         I turned off the flash animation for Opera as it got stuck
       */

       @-webkit-keyframes flash {
         0% { background: transparent; }
         50% { background: #fff; }
         100% { background: transparent;}
       }
       /*@-o-keyframes flash {
         0% { background: transparent; }
         50% { background: #fff; }
         100% { background: transparent;}
       }*/

       @-moz-keyframes flash {
         0% { background: transparent; }
         50% { background: #fff; }
         100% { background: transparent;}
       }
       @-ms-keyframes flash {
         0% { background: transparent; }
         50% { background: #fff; }
         100% { background: transparent;}
       }
       @keyframes flash {
         0% { background: transparent; }
         50% { background: #fff; }
         100% { background: transparent;}
       }

       /* states */
       .intro #videocontainer, 
       .testing #videocontainer, 
       .testing #canvas ,
       .intro #reset, 
       .intro #upload,
       .intro #uploading,
       .intro #finish,
       .playing #reset,
       .playing #uploading,
       .playing #finish, 
       .playing #upload,
       .uploaded #start,
       .uploaded #reset,
       .uploaded #upload,
       .uploaded #videocontainer,
       .uploaded #canvas{ display: none; }
       .playing #videocontainer { display: block; }
       .playing #canvas { display: none; }
       .reviewing #videocontainer{ display: none; }
       .reviewing #canvas { display: block; }
       #uploading{display: none;}
       #finish{display: none;}
       .uploaded #finish{display: block;}
       .uploading #uploading{display: block;}
       #start{
        display: block;
        margin: 5px auto;
       }
</style>

          <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
              <h4 class="m-2 font-weight-bold text-primary">Interaction cam&nbsp;<i class="fas fa-fw fa-camera"></i></h4>
              <p>This is a simple photo app, just click start streamimg, then capture image to take a photo.</p>
              <p>Then click the appropriate buttons to re-take the photo or upload it to the database.</p>
              <p>Press START STREAMING to start the show!</p>
            </div>
            
            <div class="card-body">
              <h4 class="text-success text-center" id="uploading">Uploading.................</h4>
              <div id="videocontainer">
              <video id="video"></video>
              </div>
              <canvas id="canvas"></canvas>
              <div id="cover"></div>
              <div class="clearfix">
                <button class="btn btn-danger btn-lg" id="reset">&lt; Uh, let's try that again&hellip;</button>
                <button class="btn btn-success btn-lg float-right" id="upload">Win! Upload this! &gt;</button>
              </div>
              <div>
                <button id="start" class="btn btn-primary">START STREAMING</button>
              </div>
              <audio src="snap.wav"></audio>
              <!-- http://www.freesound.org/people/thecheeseman/sounds/51360/ -->
              <audio src="rip.wav"></audio>
              <!-- http://www.freesound.org/people/aboe/sounds/68900/ -->
              <audio src="takeoff.wav"></audio>
              <!-- http://www.freesound.org/people/duckduckpony/sounds/130508/ -->
            </div>
          </div>
<script>
  (function() {
var   video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      vidcontainer = document.querySelector('#videocontainer'),
      resetbutton  = document.querySelector('#reset'),
      uploadbutton = document.querySelector('#upload'),
      start        = document.querySelector('#start');

 var ctx    = canvas.getContext('2d'),
     streaming    = false,
     width  = 400,
     height = 300,
     state  = 'intro';

 var audio = document.querySelectorAll('audio'),
     sounds = {
        shutter: audio[0],
        rip:     audio[1],
        takeoff: audio[2]
      };

  setstate(state);

  function init() {
    navigator.getMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    navigator.getMedia(
      {
        video: true,
        audio: false
      },
      function(stream) {
        if (navigator.mozGetUserMedia) {
          video.mozSrcObject = stream;
        } else {
          var vendorURL = window.URL || window.webkitURL;
          video.src = vendorURL ? vendorURL.createObjectURL(stream) : stream;
        }
        video.play();
        video.style.width = width + 'px';
        video.style.height = height + 'px';
      },
      function(err) {
        console.log("An error occured! " + err);
      }
    );
  }

  function takepicture() {
    sounds.shutter.play();
    ctx.save();
    ctx.translate(width, 0);
    ctx.scale(-1, 1);
    ctx.drawImage(video, 0, 0, width, finalheight);
    ctx.restore();
    ctx.scale(1, 1);
    ctx.drawImage(img, 590 - imgwidth, 440 - imgheight, imgwidth, imgheight);
  }

  function reshoot() {
    if (state === 'reviewing') {
      sounds.rip.play();
    }
    if (state === 'reviewing' || state === 'uploaded') {
      canvas.width = width;
      canvas.height = finalheight;
      ctx.drawImage(img, 590 - imgwidth, 440 - imgheight, imgwidth, imgheight);
      setstate('playing');
    }
  }

  function initiateupload() {
    if (state === 'reviewing') {
      sounds.takeoff.play();
      setstate('uploading');
      upload();
    }
  }

  function upload() {
    var head = /^data:image\/(png|jpeg);base64,/,
        data = '',
        fd = new FormData(),
        xhr = new XMLHttpRequest();

    setstate('uploading');
    data = canvas.toDataURL('image/jpeg', 0.9).replace(head, '');

      fd.append('contents', data);
      xhr.open('POST', 'helper_image_upload.php');
      xhr.addEventListener('error', function(ev) {
        alert('Upload Error!');
      }, false);
      xhr.addEventListener('load', function(ev) {
        setstate('uploaded');      window.location="account.php"
      }, false);
      xhr.send(fd);
  }

 function setstate(newstate) {
    state = newstate;
    document.body.className = newstate;
  }
  function store(name) {
    if (localStorage.interactionphotos === undefined) {
      localStorage.interactionphotos = '';
    }
    localStorage.interactionphotos += ' '+ name;
  }

  /* Event Handlers */
start.addEventListener('click',
 function(){
      if (state === 'intro') {
        setstate('playing');
        init();
        start.textContent='CAPTURE IMAGE';
      } else {
        setstate('reviewing');
        takepicture();
      }
    }
);

  video.addEventListener('play', function(ev){
    if (!streaming) {
      console.log(video.clientHeight);
      finalheight = video.clientHeight / (video.clientWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', finalheight);
      canvas.width = width;
      canvas.height = finalheight;
      ctx.drawImage(img, 590 - imgwidth, 440 - imgheight, imgwidth, imgheight);
      streaming = true;
      vidcontainer.classname = 'playing';
    }
  }, false);
  video.addEventListener('click', function(ev){
    setstate('reviewing');
    takepicture();
  }, false);

  resetbutton.addEventListener('click', function(ev){
    if (state === 'reviewing') {
      setstate('playing');
      init();
    }
    ev.preventDefault();
  }, false);
 uploadbutton.addEventListener('click', function(ev){
    if (state === 'reviewing') {
      setstate('uploading');
      upload();
    }
    ev.preventDefault();
  }, false);
})();
</script>
<?php
include'../includes/footer.php';
?>
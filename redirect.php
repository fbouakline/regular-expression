<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <style>


*,
*:after,
*:before {
    box-sizing: border-box;
}

html,
body{
  margin:0;
  height: 100%; 
}

body{
  background: rgba(255, 250, 245, 1);
}

.circle{
  border-radius: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -25px;
  margin-left: -25px;
  width: 50px;
  height: 50px;
}

.circle > li{
  display: block;
  position: absolute;
  z-index:-10;
}

.circle li:nth-child(1),
.circle li:nth-child(2),
.circle li:nth-child(3),
.circle li:nth-child(4){
  background: rgba(50, 50, 250, 0.6);
}

.circle li:nth-child(5),
.circle li:nth-child(6),
.circle li:nth-child(7),
.circle li:nth-child(8){
  background: rgba(255, 50, 150, 0.6);
}

.circle li:nth-child(1),
.circle li:nth-child(2),
.circle li:nth-child(3),
.circle li:nth-child(4),
.circle li:nth-child(5),
.circle li:nth-child(6),
.circle li:nth-child(7),
.circle li:nth-child(8){
  width: 50%;
  height: 50%;
  animation: rotar 1s infinite;
  -webkit-animation: rotar 1s infinite;
}

.circle li:nth-child(1){
  border-radius: 100px 0px 0px 0px;
  top: 0;
  left: 0;
  animation-delay: 0.1s;
  -webkit-animation-delay: 0.1s;
}

.circle li:nth-child(2){
  border-radius: 0px 100px 0px 0px;
  top: 0;
  left: 50%;
  animation-delay: 0.2s;
  -webkit-animation-delay: 0.2s;
}

.circle li:nth-child(3){
  border-radius: 0px 0px 0px 100px;
  top: 50%;
  left: 0;
  animation-delay: 0.3s;
  -webkit-animation-delay: 0.3s;
}

.circle li:nth-child(4){
  border-radius: 0px 0px 100px 0px;
  top: 50%;
  left: 50%;
  -webkit-animation-delay: 0.4s;
          animation-delay: 0.4s;
}

.circle li:nth-child(5){
  border-radius: 100px 0px 0px 0px;
  top: 0;
  left: 0;
  -webkit-transform: rotateZ(45deg);
          transform: rotateZ(45deg);
  -webkit-transform-origin: right bottom;
          transform-origin: right bottom;
  -webkit-animation-delay: 0.5s;
          animation-delay: 0.5s;
}

.circle li:nth-child(6){
  border-radius: 0px 100px 0px 0px;
  top: 0;
  left: 50%;
  -webkit-transform: rotateZ(45deg);
          transform: rotateZ(45deg);
  -webkit-transform-origin: left bottom;
          transform-origin: left bottom;
  -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
}

.circle li:nth-child(7){
  border-radius: 0px 0px 0px 100px;
  top: 50%;
  left: 0;
  -webkit-transform: rotateZ(45deg);
          transform: rotateZ(45deg);
  -webkit-transform-origin: right top;
          transform-origin: right top;
  -webkit-animation-delay: 0.7s;
          animation-delay: 0.7s;
}

.circle li:nth-child(8){
  border-radius: 0px 0px 100px 0px;
  top: 50%;
  left: 50%;
  -webkit-transform: rotateZ(45deg);
          transform: rotateZ(45deg);
  -webkit-transform-origin: left top;
          transform-origin: left top;
  -webkit-animation-delay: 0.8s;
          animation-delay: 0.8s;

}

@-webkit-keyframes rotar {
  45%{
    border-radius: 10px;
    background: rgba(150, 50, 250, 0.6);
  }
  55%{
    border-radius: 100px;
    background: rgba(50, 150, 150, 0.6);
  }
}

@keyframes rotar {
  45%{
    border-radius: 10px;
    background: rgba(150, 50, 250, 0.6);
  }
  55%{
    border-radius: 100px;
    background: rgba(50, 150, 150, 0.6);
  }
}

::-moz-selection {
    background-color: #444;
    color: #fff;
    text-shadow: 0 -1px 0 rgba(0,0,0,.25)
}

::selection {
    background-color: #444;
    color: #fff;
    text-shadow: 0 -1px 0 rgba(0,0,0,.25)
}

#countdown {
    background: rgba(255, 250, 245, 1);
    color: #888;
    font-family: Arial, Helvetica, sans-serif;
    position: absolute;
    top: 30em;
    left: 50%;
    width: 40%;
    text-align: center;
    text-shadow: 0 1px 0 #f5f5f5;
    padding: 1em 0;
    margin: -20em 0 0 -20%;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    box-shadow: inset 1px 1px 3px #ccc, 2px 2px 2px #fff;
}
  </style>

  <script>
 var interval;
    var minutes = 0;
    var seconds = 5;
    window.onload = function() {
        countdown('countdown');
    }

    function countdown(element) {
        interval = setInterval(function() {
            var el = document.getElementById(element);
            if(seconds == 0) {
                if(minutes == 0) {
                    window.location.replace('index.php')                  
                    clearInterval(interval);
                    return;
                } else {
                    minutes--;
                    seconds = 60;
                }
            }
            if(minutes > 0) {
                var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
            } else {
                var minute_text = '';
            }
            var second_text = seconds > 1 ? 'seconds' : 'second';
            el.innerHTML = 'You will be redirected in ' + minute_text + ' ' + seconds + ' ' + second_text ;
            seconds--;
        }, 1000);
    }

  </script>
</head>
<body>
<div id="countdown"></div>
<ul class="circle">
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ul>
</body>
</html>
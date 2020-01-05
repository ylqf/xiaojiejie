<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<title>JMW-小姐姐</title>
<style type="text/css">
*{
	margin:0px; 
	padding:0px;
	touch-action: pan-y;
	text-align: center;
}
.app{
	width: 100%; 
	height:100%; 
	position: absolute; 
	top:0px; 
	right:0px; 
	bottom: 0px; 
	left:0px; 
	overflow: hidden;
	background-color: #ffffff;
}
.video{
	width: 100%; 
	height: 100%;
}
#my-video{
	object-fit: cover; 
	object-position: center center;
}
canvas {
	display: block;
	position: absolute;
	bottom: 100px;
	right: -24px;
	z-index: 20;
	cursor: pointer;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
.journal-reward {
	position: absolute;
	bottom: 20px;
	right: 20px;
	height: 80px;
	width: 80px;
	display: block;
	z-index: 21;
}
.m {
	width: 240px;
	height: 320px;
	margin-left: auto;
	margin-right: auto;
}
</style>
<script>if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {/*无动作*/}else{window.location.href = "pass.html";}</script>
</head>
<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header ( "Content-Type: text/html;charset=utf-8" );
$filename='mp4.json';
//判断文件是否存在
if(false===file_exists($filename)){//不存在
    echo "<script> var url= 'http://jsmov2.a.yximgs.com/upic/2019/03/03/00/BMjAxOTAzMDMwMDMyNThfNTEzOTIxMzY1XzExMTM0MTI4NDg1XzFfMw==_b_B0354fedbbda282b709f44b23d889b75b.mp4?tag=1-1551544506-p-1-nzerfmw6b0-11e5b7d3fc8ffedc';</script>";
}else{//存在,读取
    $json_string = file_get_contents($filename);
    $datas = json_decode($json_string, true);
    $Count = count($datas['url']);//查询条目数
    echo '';
    //range 是将指定范围 列成一个数组
    $numbers = range (0,$Count);
    //shuffle 将数组顺序随即打乱
    shuffle ($numbers);
    //array_slice 取该数组中的某一段
    $result = array_slice($numbers,0,$Count);
    $num=$result[1];
    $url = $datas['url'][$num];
    echo "<script> var url= '".$url."';</script>";
}
?>
<body>
<div id="app" class="app">
    <video preload='auto' id='my-video' ref="video" :src="videoUrl" @click="player" loop autoplay="autoplay" webkit-playsinline='true' playsinline='true' x-webkit-airplay='true' x5-video-player-type='h5' x5-video-player-fullscreen='true'x5-video-ignore-metadata='true' width='100%' height='100%'><p>不支持video</p></video>
</div>
<span style="position:absolute;top:5px;right:5px;color:#fff;">视频库:[<span style="color: #FF4040;"><?php echo $Count; ?></span>]则</span>
<span style="position:absolute;top:25px;right:10px;color:#fff;">识别ID:[<span style="color: #4682B4;"><?php echo $num; ?></span>]</span>
<span style="position:absolute;top:5px;left:10px;color:#fff;">右/上滑切换下一个</span>
<span style="position:absolute;top:25px;left:10px;color:#fff;">点击播放/暂停</span>

<span style="position:absolute;bottom:10px;left:10px;color:#fff;">视频采集自网络</span>
<div class="m"> <img src="img/reward.png" class="journal-reward" /> </div>
<script src="flutter-hearts-zmt.js" type="text/javascript" charset="utf-8"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script type="text/javascript">
    // vue 解析
    var Application = new Vue({
        el: "#app",
        data: {
            videoUrl:'',
            video:null,
        },
        mounted: function(){
            this.videoUrl = url;
            this.video = this.$refs.video;
        },
        methods: {
            player:function(){
                if(this.video.paused){
                    // 播放
                    this.video.play();
                }else{
                    // 暂停
                    this.video.pause()
                };            
            }
        }
    });

var startx, starty;
 
//获得角度
function getAngle(angx, angy) {
    return Math.atan2(angy, angx) * 180 / Math.PI;
};
 
//根据起点终点返回方向 1向上滑动 2向下滑动 3向左滑动 4向右滑动 0点击事件
function getDirection(startx, starty, endx, endy) {
    var angx = endx - startx;
    var angy = endy - starty;
    var result = 0;
 
    //如果滑动距离太短
    if (Math.abs(angx) < 2 && Math.abs(angy) < 2) {
        return result;
    }
 
    var angle = getAngle(angx, angy);
    if (angle >= -135 && angle <= -45) {
        result = 1;
    } else if (angle > 45 && angle < 135) {
        result = 2;
    } else if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {
        result = 3;
    } else if (angle >= -45 && angle <= 45) {
        result = 4;
    }
    return result;
}
 
//手指接触屏幕
document.addEventListener("touchstart", function(e){
    startx = e.touches[0].pageX;
    starty = e.touches[0].pageY;
}, false);
 
//手指离开屏幕
document.addEventListener("touchend", function(e) {
    var endx, endy;
    endx = e.changedTouches[0].pageX;
    endy = e.changedTouches[0].pageY;
    var direction = getDirection(startx, starty, endx, endy);
    switch (direction) {
        case 1:
            location.assign(location);
            break;
        case 3:
            location.assign(location);
            break;
        }
}, false);
</script>
<script type="text/javascript">
        /*7Core-CN - 网页鼠标点击特效（爱心）*/
        !function (e, t, a) {function r() {for (var e = 0; e < s.length; e++) s[e].alpha <= 0 ? (t.body.removeChild(s[e].el), s.splice(e, 1)) : (s[e].y--, s[e].scale += .004, s[e].alpha -= .013, s[e].el.style.cssText = "left:" + s[e].x + "px;top:" + s[e].y + "px;opacity:" + s[e].alpha + ";transform:scale(" + s[e].scale + "," + s[e].scale + ") rotate(45deg);background:" + s[e].color + ";z-index:99999");requestAnimationFrame(r)}function n() {var t = "function" == typeof e.onclick && e.onclick;e.onclick = function (e) {t && t(), o(e)}}function o(e) {var a = t.createElement("div");a.className = "heart", s.push({el: a,x: e.clientX - 5,y: e.clientY - 5,scale: 1,alpha: 1,color: c()}), t.body.appendChild(a)}function i(e) {var a = t.createElement("style");a.type = "text/css";try {a.appendChild(t.createTextNode(e))} catch (t) {a.styleSheet.cssText = e}t.getElementsByTagName("head")[0].appendChild(a)}function c() {return "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"}var s = [];e.requestAnimationFrame = e.requestAnimationFrame || e.webkitRequestAnimationFrame || e.mozRequestAnimationFrame || e.oRequestAnimationFrame || e.msRequestAnimationFrame || function (e) {setTimeout(e, 1e3 / 60)}, i(".heart{width: 10px;height: 10px;position: fixed;background: #f00;transform: rotate(45deg);-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);}.heart:after,.heart:before{content: '';width: inherit;height: inherit;background: inherit;border-radius: 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;position: fixed;}.heart:after{top: -5px;}.heart:before{left: -5px;}"), n(), r()}(window, document);
</script>
<script type="text/javascript">
$(function(){
    var t = document.title ;
    var t01 = t + "♪♫¸（ >‿◠）✌";
    var t02 = t + "♪♫¸（⊙‿⊙）✌";
    var t03 = t + "♪♫¸（◠▽◠）✌";
    var t04 = t + "♪♫¸（ ô‿ô ） ✌";
    var t05 = t + "♪♫¸（͡° ʖ ͡°）✌";
    var t06 = t + "♪♫¸（͡ Ö‿Ö ） ✌";
    var t07 = t + "♪♫¸（＾▽＾）✌";
    var t08 = t + "♪♫¸（ •◡• ）✌";
    var t09 = t + "♪♫¸（ ¬‿¬ ）✌";
    var t10 = t + "♪♫¸（◉◡◉）✌";
    var t11 = t + "♪♫¸（◔◡◔）✌";
    var t12 = t + "♪♫¸（ˇωˇ）✌";
    var t13 = t + "♪♫¸（ô ◡ ô）✌";
    var t14 = t + "♪♫¸（∩▽∩）✌";
    var t15 = t + "♪♫¸（⊙△⊙）✌";
    var t16 = t + "♪♫¸（≧▽≦）✌";
    var t17 = t + "♪♫¸（ ^人^ ）✌";
    var t18 = t + "♪♫¸（°ω°）✌";
    var t19 = t + "♪♫¸（ˋωˊ）✌";
    var t20 = t + "♪♫¸（ˋ△ˊ）✌";
    var t21 = t + "♪♫¸（ˇ▽ˇ）✌";
    var t22 = t + "♪♫¸（°ο°）✌";
    var t23 = t + "♪♫¸（ˇ◡ˇ）✌";
    var t24 = t + "♪♫¸（ ⊙ʖ⊙）✌";
    var t25 = t + "♪♫¸（ˉ▽ˉ）✌";
    var t26 = t + "♪♫¸（￣□￣）✌";
    var myObj = {"title":[ t01,t02,t03,t04,t05,t06,t07,t08,t09,t10,t11,t12,t13,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23,t24,t25,t26 ]}
    var x = myObj.title.length;
    var i = 0 ;
    function tit(){document.getElementsByTagName("title")[0].innerText = myObj.title[i];i++;if( i == x ){ i = 0 ;}setTimeout(function (){tit()}, 1000);}
    tit()
});
</script>
</html>
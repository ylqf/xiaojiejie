<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<title>MP4播放地址</title>
<link rel="stylesheet" href="./layui.css">
<div style="text-align: center;font-size: 18px;">
<br><br><br>
<form class="layui-form layui-form-pane" method="post" action="">
<div  class="main">
  <div class="layui-form-item" style="padding-left: 10%;">
  	<span>视频数据添加</span><br><br><br>
    <label class="layui-form-label" style="width: 20%;">MP4播放地址</label>
    <div class="layui-input-block">
      <input type="text" name="mp4" required  lay-verify="url" placeholder="请键入MP4播放地址" autocomplete="off" class="layui-input" style="width: 70%">
    </div><br>
    <div class="layui-input-block" style="padding-right: 10%;">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置数据</button>
    </div>
   </div>
</div>
</form>  
</div>
<br><br>
<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header ( "Content-Type: text/html;charset=utf-8" );

$mp4=$_POST["mp4"];
$filename='mp4.json';
if ($mp4!="") {
$json_string = file_get_contents($filename);
$datas = json_decode($json_string, true);
//查询条目数
$Count = count($datas['url']);
$arr = array();
for ($i=0; $i < $Count; $i++) { 
  $url = $datas['url'][$i];
  $arr['url'][$i] = $url;
}
  $arr['url'][$i] = $mp4;
  $json = json_encode($arr);
}

file_put_contents('mp4.json', $json);

?>
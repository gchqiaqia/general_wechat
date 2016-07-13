<?php
define ( 'RELATIVITY_PATH', '../../' );
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once './include/db_table.class.php';
$openId = "";
if (! empty ( $_GET ['openId'] )) {
	$openId = $_GET ['openId'];
}
$sceneId = "";
if (! empty ( $_GET ['sceneId'] )) {
	$sceneId = $_GET ['sceneId'];
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" href="css/weui.min.css" />
<script src="js/common.fun.js" type="text/javascript"></script>
<meta charset="utf-8">
<title>注册</title>
<style type="text/css">
form div {
	overflow: hidden;
	width: 100%;
	line-height: 0px;
}

img {
	width: 100%;
}

* {
	margin: 0px;
	padding: 0px;
}

.input {
	text-align: center;
	padding-bottom: 15px;
}

.input input {
	color: white;
	font-size: 20px;
	text-align: center;
	padding: 5px;
	border: 0px solid #DDDDDD;
	background-color: #F7C377;
	width: 60%;
	border-radius: 0px;
}

.input input::-webkit-input-placeholder {
	color: #FAD9A7;
}

.input input:-moz-placeholder {
	color: #FAD9A7;
}

.input input::-moz-placeholder {
	color: #FAD9A7;
}

.input input:-ms-input-placeholder {
	color: #FAD9A7;
}

.input button {
	color: white;
	font-size: 20px;
	text-align: center;
	padding: 10px;
	border: 0px solid #DDDDDD;
	background-color: #E48019;
	width: 62%;
	border-radius: 5px;
}
</style>
</head>
<body>
<form action="registerSuccess.php" method="get" id="form1"><input
	type="hidden" name="sceneId" id="sceneId"
	value="<?php
	echo $sceneId;
	?>" /> <input type="hidden" name="openId"
	value="<?php
	echo $openId;
	?>" /> <input type="hidden" name="flag"
	value="register" /> <input type="hidden" name="Vcl_Item_1"
	id="Vcl_Item_1" value="" /> <input type="hidden" name="Vcl_Item_2"
	id="Vcl_Item_2" value="" /> <input type="hidden" name="Vcl_Gift"
	id="Vcl_Gift" value="" />
<div id="page_1" style="display: block">
<div><img src="images/top.png" /></div>
<div style="margin-top: 40px;"><img src="images/setp_1_title.png" /></div>
<div class="input" style="margin-top: 40px;"><input type="text"
	placeholder="公司名称" name="Vcl_Company" id="Vcl_Company" /></div>
<div class="input"><input type="text" placeholder="职务"
	name="Vcl_DeptJob" id="Vcl_DeptJob" /></div>
<div class="input"><input type="text" placeholder="姓名" name="Vcl_Name"
	id="Vcl_Name" /></div>
<div class="input"><input type="text" placeholder="手机号" name="Vcl_Phone"
	id="Vcl_Phone" /></div>
<div class="input"><input type="text" placeholder="邮箱" name="Vcl_Email"
	id="Vcl_Email" /></div>
<div class="input" style="margin-top: 30px;">
<button type="button" onclick="next2()">下一步</button>
</div>
</div>
<div id="page_2" style="display: none">
<div><img src="images/top.png" /></div>
<div style="margin-top: 60px;"><img src="images/setp_2_title.png" /></div>
	<?php
	//北京，上海，成都判断显示场次
	if ($sceneId == 2) {
		//北京
		?>
		<div style="margin-top: 60px;"
	onclick="set_item(1,'bj','交流会（2016年6月3日 14:00-17:30）')"><img
	id="item_image_1" src="images/cc_bj_01_off.png" /></div>
<div style="margin-top: 50px;"
	onclick="set_item(2,'bj','晚宴（2016年6月3日 17:30-20:30）')"><img
	id="item_image_2" src="images/cc_bj_02_off.png" /></div>
		<?php
	}
	if ($sceneId == 3) {
		//上海
		?>
		<div style="margin-top: 60px;"
	onclick="set_item(1,'sh','交流会（2016年6月1日 14:00-17:30）')"><img
	id="item_image_1" src="images/cc_sh_01_off.png" /></div>
<div style="margin-top: 50px;"
	onclick="set_item(2,'sh','晚宴（2016年6月1日 17:30-20:30）')"><img
	id="item_image_2" src="images/cc_sh_02_off.png" /></div>
		<?php
	}
	if ($sceneId == 1 || $sceneId == 6) {
		//成都
		?>
		<div style="margin-top: 60px;"
	onclick="set_item(1,'cd','交流会（2016年5月30日 13:00-16:30）')"><img
	id="item_image_1" src="images/cc_cd_01_off.png" /></div>
<div style="margin-top: 50px;"
	onclick="set_item(2,'cd','晚宴（2016年5月30日 17:30-20:30）')"><img
	id="item_image_2" src="images/cc_cd_02_off.png" /></div>
		<?php
	}
	?>    	
    	<div class="input" style="margin-top: 60px;">
<button type="button" onclick="next3()">下一步</button>
</div>
</div>
<div id="page_3" style="display: none">
<div><img src="images/top_gift.png" /></div>
<div style="margin-top: 15px;"><img src="images/setp_3_title.png" /></div>
<div style="margin-top: 15px;">
<div style="float: left; width: 25%; position: absolute;"
	onclick="set_gift(1,'盛开的杏树')"><img id="gift_1"
	src="images/gift_mark.png" /></div>
<div
	style="float: left; margin-left: 25%; width: 25%; position: absolute;"
	onclick="set_gift(2,'夜幕下的咖啡座')"><img id="gift_2"
	src="images/gift_mark.png" /></div>
<div
	style="float: left; margin-left: 50%; width: 25%; position: absolute;"
	onclick="set_gift(3,'戴珍珠耳环的女孩')"><img id="gift_3"
	src="images/gift_mark.png" /></div>
<div
	style="float: left; margin-left: 75%; width: 25%; position: absolute;"
	onclick="set_gift(4,'犹太新娘')"><img id="gift_4"
	src="images/gift_mark.png" /></div>
<img src="images/gift_all.png" /></div>
<div class="input" style="padding-top: 30px;">
<button type="button" onclick="verify()">提 交</button>
</div>
</div>
</form>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {WeixinJSBridge.call('hideOptionMenu');});
	function verify()
    {
//    	var salenum=document.getElementById("sso").value;
		if (document.getElementById("Vcl_Gift").value=='')
		{
			dialog_show('请选择您的定制礼品');
			return;
		}
		document.getElementById("form1").submit();
	}
	function set_gift(id,text)
	{
		document.getElementById("gift_1").src='images/gift_mark.png'
		document.getElementById("gift_2").src='images/gift_mark.png'
		document.getElementById("gift_3").src='images/gift_mark.png'
		document.getElementById("gift_4").src='images/gift_mark.png'
		document.getElementById("gift_"+id).src='images/gift_select.png'
		document.getElementById("Vcl_Gift").value=text
	}
	function set_item(id,city,str)
	{
		if (document.getElementById("Vcl_Item_"+id).value=='')
		{
			//选中
			document.getElementById("Vcl_Item_"+id).value=str
			document.getElementById("item_image_"+id).src='images/cc_'+city+'_0'+id+'_on.png'//修改图片显示
		}else{
			document.getElementById("Vcl_Item_"+id).value='';
			document.getElementById("item_image_"+id).src='images/cc_'+city+'_0'+id+'_off.png'//修改图片显示
		}
	}
	function next2()
	{
		if (document.getElementById("Vcl_Company").value=='')
		{
			dialog_show("请填写公司名称")
			return;
		}
		if (document.getElementById("Vcl_DeptJob").value=='')
		{
			dialog_show('请填写职务');
			return;
		}
		if (document.getElementById("Vcl_Name").value=='')
		{
			dialog_show('请填写姓名');
			return;
		}
		if (document.getElementById("Vcl_Phone").value=='')
		{
			dialog_show('请填写手机');
			return;
		}
		if (document.getElementById("Vcl_Email").value=='')
		{
			dialog_show('请填写邮箱');
			return;
		}
		next(2);
	}
	function next3(obj)
	{
		if(document.getElementById("Vcl_Item_1").value=='' && document.getElementById("Vcl_Item_2").value=='')
		{
			dialog_show('请选择您要参加的活动场次');
			return;
		}
		next(3); 
	}
	function next(id)
	{
		document.getElementById('page_1').style.display="none"
		document.getElementById('page_2').style.display="none"
		document.getElementById('page_3').style.display="none"
		document.getElementById('page_'+id).style.display="block"
	}
	</script>
<div class="weui_dialog_alert" id="massagebox" style="display: none">
<div class="weui_mask"></div>
<div class="weui_dialog">
<div class="weui_dialog_hd"><strong class="weui_dialog_title">系统提示</strong></div>
<div class="weui_dialog_bd" id="massagebox_text"></div>
<div class="weui_dialog_ft"><a href="javascript:dialog_close();"
	class="weui_btn_dialog primary">确定</a></div>
</div>
</div>
</body>
</html>
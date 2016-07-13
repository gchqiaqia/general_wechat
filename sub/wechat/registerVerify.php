<?php
define ( 'RELATIVITY_PATH', '../../' );
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
require_once './include/db_table.class.php';
$openId = "ot7Sys4R3IkL1SfQ9G2ti15eW_a0";
if (! empty ( $_GET ['openId'] )) {
	$openId = $_GET ['openId'];

	//var_dump($openId);
}

//获取用户信息
$o_userInfo = new WX_User_Info ();
$o_userInfo->PushWhere ( array ("&&", "OpenId", "=", $openId ) );
$count = $o_userInfo->getAllCount ();
$userName = $o_userInfo->getUserName ( 0 );
$phone = $o_userInfo->getPhone ( 0 );
$email = $o_userInfo->getEmail ( 0 );
$giftId = $o_userInfo->getGiftId ( 0 );
$registerDate = $o_userInfo->getRegisterDate ( 0 );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" href="css/weui.min.css" />
<script src="js/common.fun.js" type="text/javascript"></script>
<meta charset="utf-8">
<title>验证信息</title>
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
	type="hidden" name="openId" value="<?php
	echo $openId;
	?>" /> <input
	type="hidden" name="flag" value="verify" />
<div><img src="images/top.png" /></div>
<div style="margin-top: 40px;"><img src="images/modify_title.png" /></div>
<div class="input" style="margin-top: 40px;"><input type="text"
	placeholder="公司名称" name="Vcl_Company" id="Vcl_Company"
	value="<?php
	echo ($o_userInfo->getCompany ( 0 ))?>" /></div>
<div class="input"><input type="text" placeholder="职务"
	name="Vcl_DeptJob" id="Vcl_DeptJob"
	value="<?php
	echo ($o_userInfo->getDeptJob ( 0 ))?>" /></div>
<div class="input"><input type="text" placeholder="姓名" name="Vcl_Name"
	id="Vcl_Name" value="<?php
	echo ($o_userInfo->getUserName ( 0 ))?>" /></div>
<div class="input"><input type="text" placeholder="手机号" name="Vcl_Phone"
	id="Vcl_Phone" value="<?php
	echo ($o_userInfo->getPhone ( 0 ))?>" /></div>
<div class="input"><input type="text" placeholder="邮箱" name="Vcl_Email"
	id="Vcl_Email" value="<?php
	echo ($o_userInfo->getEmail ( 0 ))?>" /></div>
<div class="input" style="margin-top: 30px;">
<button type="button" onclick="verify()">提 交</button>
</div>
</form>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {WeixinJSBridge.call('hideOptionMenu');});
	function verify()
	{
		if (document.getElementById("Vcl_Company").value=='')
		{
			dialog_show('请填写公司名称');
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
		document.getElementById("form1").submit();
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
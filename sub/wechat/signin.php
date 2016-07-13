<?php
//如果已经关注报名，那么显示修改信息
//如果没有报名，那么显示报名信息
//如果没有关注，那么说明是非法的，给出错误提示并关闭


define ( 'RELATIVITY_PATH', '../../' );
require_once './include/db_table.class.php';
include './include/userUtil.php';
include './include/accessToken.class.php';
$o_userUtil = new userUtil ();
$openId = $o_userUtil->open_id;
$sceneId = $_GET ["sceneId"];

//报名页面需要验证是否已经关注微信号，如果没有关注，需要跳转到邀请函，进行二维码扫描。
$o_token = new accessToken ();
$s_token = $o_token->access_token;
$s_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $s_token . '&openid=' . $openId . '&lang=zh_CN';
$o_util = new curlUtil ();
$s_return = $o_util->https_request ( $s_url );
$a_return = json_decode ( $s_return, true );
if ($a_return ['subscribe'] != 1) {
	//说明没有关注微信,直接关闭
	echo ("<script>
		document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {WeixinJSBridge.call('closeWindow');});
	</script>");
	exit ( 0 );
}

$o_user = new WX_User_Info ();
//通过OpenId获取用户信息
//$o_user->PushWhere(array("&&", "SceneId", "=", $sceneId));
$o_user->PushWhere ( array ("&&", "OpenId", "=", $openId ) );
$count = $o_user->getAllCount ();
$registerUrl = "signin_register.php?openId=" . $openId . "&sceneId=" . $sceneId;
$verifyUrl = "signin_confirm.php?openId=" . $openId;
if (0 == $count) {
	//如果没有找到用户信息，那么进入现场报名页面
	//echo($registerUrl);
	echo "<script>location.href='" . $registerUrl . "'</script>";
} else {
	//如果找到用户信息，那么用户信息确认页面
	echo "<script>location.href='" . $verifyUrl . "'</script>";
}
?>
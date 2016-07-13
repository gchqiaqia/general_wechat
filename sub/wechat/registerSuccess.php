<?php
/**
 * 注册成功页面
 * 保存用户注册信息、将用户分组
 * */
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../../' );
$s_homepage = 'http://1.hollandmeeting.applinzi.com/';
require_once './include/db_table.class.php';

include './include/userGroup.class.php';
date_default_timezone_set ( "Asia/Shanghai" );
$groupName = "Beijing";
$openId = "";
if (! empty ( $_GET ['openId'] )) {
	$openId = $_GET ['openId'];
}
$sceneId = "";
if (! empty ( $_GET ['sceneId'] )) {
	$sceneId = $_GET ['sceneId'];
}
$name = "";
if (! empty ( $_GET ['Vcl_Name'] )) {
	$name = $_GET ['Vcl_Name'];
}
$phone = "";
if (! empty ( $_GET ['Vcl_Phone'] )) {
	$phone = $_GET ['Vcl_Phone'];
}
$email = "";
if (! empty ( $_GET ['Vcl_Email'] )) {
	$email = $_GET ['Vcl_Email'];
}
$company = "";
if (! empty ( $_GET ['Vcl_Company'] )) {
	$company = $_GET ['Vcl_Company'];
}
$job = "";
if (! empty ( $_GET ['Vcl_DeptJob'] )) {
	$job = $_GET ['Vcl_DeptJob'];
}
$gift = "";
if (! empty ( $_GET ['Vcl_Gift'] )) {
	$giftId = $_GET ['Vcl_Gift'];
}
//获取场次
$a_item = Array ();
if (! empty ( $_GET ['Vcl_Item_1'] )) {
	array_push ( $a_item, urlencode ( $_GET ['Vcl_Item_1'] ) );
}
if (! empty ( $_GET ['Vcl_Item_2'] )) {
	array_push ( $a_item, urlencode ( $_GET ['Vcl_Item_2'] ) );
}
$s_item = json_encode ( $a_item );

$flag = "";
if (! empty ( $_GET ['flag'] )) {
	$flag = $_GET ['flag'];
}
//echo "您已经成功报名，期待您的参与！<br/>";


//将用户移动分组
//这里需要注意，微信中分组是可以重名的
//1.通过Sceneid查找活动，并获取GroupIdhao


if ("register" == $flag) {
	//增加判断是否重复提交
	$o_selectUser = new WX_User_Info ();
	$o_selectUser->PushWhere ( array ("&&", "OpenId", "=", $openId ) );
	$o_selectUser->PushWhere ( array ("&&", "SceneId", "=", $sceneId ) );
	$count = $o_selectUser->getAllCount ();
	if ($count == 0) {
		//读取活动信息
		$o_activity = new WX_Activity ();
		$o_activity->PushWhere ( array ("&&", "SceneId", "=", $sceneId ) );
		$o_activity->getAllCount ();
		//查找活动对应的GroupID
		$o_group = new WX_Group ( $o_activity->getGroupId ( 0 ) );
		$groupId = $o_group->getGroupId ();
		//echo($o_activity->getAllCount());
		//exit(0);
		//新建用户信息
		$o_usergroup = new userGroup ();
		$result = $o_usergroup->updateGroup ( $openId, $groupId );
		if ("ok" == $result ["errmsg"]) {
			//echo "移动分组成功<br/>";
		} else {
			//echo "移动分组失败<br/>";
		}
		
		//保存用户信息
		$o_newUser = new WX_User_Info ();
		$o_newUser->setUserName ( $name );
		$o_newUser->setOpenId ( $openId );
		$o_newUser->setItems ( $s_item );
		$o_newUser->setPhone ( $phone );
		$o_newUser->setEmail ( $email );
		$o_newUser->setCompany ( $company );
		$o_newUser->setGift ( $giftId );
		$o_newUser->setDeptJob ( $job );
		$o_newUser->setSceneId ( $sceneId );
		$o_newUser->setRegisterDate ( Date ( 'Y-m-d', time () ) );
		$o_newUser->setGroupId ( $groupId );
		$o_newUser->setDelFlag ( 0 );
		$o_newUser->Save ();
		
		//发送报名成功信息的消息给用户
		$o_token = new accessToken ();
		$curlUtil = new curlUtil ();
		$s_url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $o_token->access_token;
		$data = array ('touser' => $openId, // openid是发送消息的基础
'template_id' => '8tjABrG3_JD-4x_mANFRKuwSkBo9IHGNp3HAjBgnrL8', // 模板id
'url' => $s_homepage . 'sub/wechat/transfer.php', // 点击跳转地址
'topcolor' => '#FF0000', // 顶部颜色
'data' => array ('first' => array ('value' => '报名成功！
			' ), 'keyword1' => array ('value' => '荷兰旅游会议促进局微信服务号', 'color' => '#173177' ), 'keyword2' => array ('value' => '会议报名成功', 'color' => '#173177' ), 'keyword3' => array ('value' => Date ( 'Y-m-d h:m:s', time () ), 'color' => '#173177' ), 'remark' => array ('value' => '
恭喜您，提交报名信息成功，我们会尽快对您的信息进行审核，审核通过后，您会收到我们的确认信息。
感谢您的参与。

如需修改您的个人信息，请点击这里。
' ) ) )

		;
		$curlUtil->https_request ( $s_url, json_encode ( $data ) );
	} else {
		echo ("<script>window.alert('请不要重复提交报名信息！')</script>");
	}
} elseif ("verify" == $flag) {
	
	//更新用户信息
	$o_select = new WX_User_Info ();
	$o_select->PushWhere ( array ("&&", "OpenId", "=", $openId ) );
	$o_select->getAllCount ();
	$Id = $o_select->getId ( 0 );
	
	$o_update = new WX_User_Info ( $Id );
	$o_update->setUserName ( $name );
	$o_update->setPhone ( $phone );
	$o_update->setEmail ( $email );
	$o_update->setCompany ( $company );
	$o_update->setDeptJob ( $job );
	$o_update->Save ();
	//读取活动信息
	$o_activity = new WX_Activity ();
	$o_activity->PushWhere ( array ("&&", "SceneId", "=", $o_update->getSceneId () ) );
	$o_activity->getAllCount ();
	
	//发送更新报名信息的消息给用户
	$o_token = new accessToken ();
	$curlUtil = new curlUtil ();
	$s_url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $o_token->access_token;
	$data = array ('touser' => $openId, // openid是发送消息的基础
'template_id' => '8tjABrG3_JD-4x_mANFRKuwSkBo9IHGNp3HAjBgnrL8', // 模板id
'url' => $s_homepage . 'sub/wechat/transfer.php', // 点击跳转地址
'topcolor' => '#FF0000', // 顶部颜色
'data' => array ('first' => array ('value' => '操作成功！
			' ), 'keyword1' => array ('value' => '荷兰旅游会议促进局微信服务号', 'color' => '#173177' ), 'keyword2' => array ('value' => '修改个人信息成功', 'color' => '#173177' ), 'keyword3' => array ('value' => Date ( 'Y-m-d h:m:s', time () ), 'color' => '#173177' ), 'remark' => array ('value' => '
修改个人信息成功，感谢您的参与。

如需再次修改您的个人信息，请点击这里。
' ) ) );
	$curlUtil->https_request ( $s_url, json_encode ( $data ) );
}
echo ("<script>
		document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {WeixinJSBridge.call('closeWindow');});
	</script>");
?>
<?php
/**
 * 注册跳转页面
 * 判断用户是否已经注册
 * 已注册的跳转到注册确认页面
 * 未注册的跳转到注册页面
 * */
define ( 'RELATIVITY_PATH', '../../' );
require_once './include/db_table.class.php';
include './include/userGroup.class.php';
include './include/userUtil.php';
$o_userUtil = new userUtil ();
$openId = $o_userUtil->open_id;
$sceneId = $_GET ["id"];

$o_activity = new WX_Activity ( $sceneId );
$o_group = new WX_Group ( $o_activity->getGroupId () );
$groupId = $o_group->getGroupId ();

$o_usergroup = new userGroup ();
$result = $o_usergroup->updateGroup ( $openId, $groupId );

//说明没有关注微信,跳转到邀请函
if ($sceneId == '4') {
	echo "<script>location.href='http://mp.weixin.qq.com/s?__biz=MzAxNDgzMzMzNQ==&mid=403622317&idx=1&sn=79896e74c243c874d14c74a62e99d1aa#rd'</script>";

	//跳转至北京微信文章
}
if ($sceneId == '5') {
	//跳转至成都微信文章
	echo "<script>location.href='http://mp.weixin.qq.com/s?__biz=MzAxNDgzMzMzNQ==&mid=403622691&idx=1&sn=2bfa72a31021ad49ea2964f1fee7e622#rd'</script>";
}
exit ( 0 );
?>
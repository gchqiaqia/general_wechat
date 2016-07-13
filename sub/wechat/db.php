<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../../' );
require_once 'include/db_table.class.php';
include './include/userGroup.class.php';
//$o_temp=new WX_Activity();
//
//$o_temp->PushWhere ( array ('&&', 'SceneId', '=','100') );
//
////$o_temp->PushOrder ( array ('Id','A') );
//
//$n_count=$o_temp->getAllCount();
//echo $o_temp->getExpiryDate(0);


/*
for($i=0;$i<$n_count;$i++)
{
	//echo($o_temp->getId($i));
}

$o_modify=new WX_Activity(1);

$o_modify->setSceneId(101);
$o_modify->Save();

//echo($o_modify->getSceneId());



$o_delete=new WX_Activity(2);
$o_delete->Deletion();



$o_new= new WX_Activity();
$o_new->setSceneId('456');
$o_new->Save();

echo($o_new->getId());


$o_new= new WX_Activity();
$o_new->setSceneId('101');
$o_new->setSceneName('北京');
$o_new->setQrCode('qrcode20160324155707.jpg');
$o_new->setMessageType('2');
$o_new->setMessageUrl('http://www.baidu.com');
$o_new->setPicUrl('https://www.baidu.com/img/bd_logo1.png');
$o_new->setDescription('欢迎关注');
$o_new->setExpiryDate('2016-03-25');
if($o_new->Save()){
	echo "保存成功";
}else{
	echo "保存失败";
}
*/

$o_usergroup = new userGroup ();
$result = $o_usergroup->createGroup ( "Beijing" );
$groupID = $result ["group"] ["id"];
$name = $result ["group"] ["name"];
echo "groupId=" . $groupID;
echo "name=" . $name;

$o_newGroup = new WX_Group ();
$o_newGroup->setGroupId ( $groupID );
$o_newGroup->setGroupName ( $name );
if ($o_newGroup->Save ()) {
	echo "保存成功";
} else {
	echo "保存失败";
}

?>
<?php
error_reporting ( 0 );
define ( 'RELATIVITY_PATH', '../../' );
define ( 'MODULEID', 100400 );
$O_Session = '';
require_once RELATIVITY_PATH . 'sub/wechat/include/db_table.class.php';

$S_Filename = 'User List.csv';
OutputList ();
$file_name = 'all.csv';
$file_dir = RELATIVITY_PATH . '/sub/audit/output/';
$rename = rawurlencode ( $S_Filename );

if (! file_exists ( $file_dir . $file_name )) { //检查文件是否存在
	echo "对不起,您要下载的文件不存在";
	exit ();
} else {
	// 一下是php文件下载的重点
	Header ( "Content-type: application/octet-stream" );
	Header ( "Accept-Ranges: bytes" );
	Header ( "Content-Type: application/force-download" ); //强制浏览器下载
	Header ( "Content-Disposition: attachment; filename=" . $rename ); //重命名文件
	Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) ); //文件大小
	// 读取文件内容
	@readfile ( $file_dir . $file_name ); //加@不输出错误信息
}
function OutputList() {
	$scene_id = $_GET ['sceneid'];
	$fp = fopen ( 'output/all.csv', 'w' );
	//表头
	$a_item = array ();
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '公司名称' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', "职务" ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '姓名' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '手机号' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '邮箱' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '场次' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '选择礼品' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '是否审核通过' ) );
	array_push ( $a_item, iconv ( 'UTF-8', 'gbk', '签到' ) );
	fputcsv ( $fp, $a_item );
	
	$o_table = new WX_User_Info ();
	$o_table->PushWhere ( array ('&&', 'SceneId', '=', $scene_id ) );
	$o_table->getAllCount ();
	$n_count = $o_table->getAllCount ();
	for($i = 0; $i < $n_count; $i ++) {
		//构建参会场次
		$a_items = json_decode ( $o_table->getItems ( $i ) );
		$s_items = '';
		for($k = 0; $k < count ( $a_items ); $k ++) {
			$s_items .= urldecode ( $a_items [$k] ) . '；';
		}
		if ($o_table->getAuditFlag ( $i ) == 1) {
			//是否审核通过
			$s_audit = '是';
		} else {
			$s_audit = '否';
		}
		if ($o_table->getSigninFlag ( $i ) == 1) {
			//是否审核通过
			$s_signin = '是';
		} else {
			$s_signin = '否';
		}
		$a_item = array ();
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getCompany ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getDeptJob ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getUserName ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getPhone ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getEmail ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $s_items ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $o_table->getGift ( $i ) ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $s_audit ) );
		array_push ( $a_item, iconv ( 'UTF-8', 'gbk', $s_signin ) );
		fputcsv ( $fp, $a_item );
	}
	fclose ( $fp );
}
?>
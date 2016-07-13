<?php
require_once './utils/userUtil.php';
$userUtil = new userUtil ();
echo "测试成功";
echo "openID=" . $userUtil->open_id;
?>
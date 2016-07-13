<?php
define ( 'RELATIVITY_PATH', '../../' );
define ( 'MODULEID', 100404 );
$O_Session = '';
require_once RELATIVITY_PATH . 'include/it_include.inc.php';
require_once RELATIVITY_PATH . 'head.php';
$s_fun = 'AuditListCDHH';
$s_item = 'AuditFlag';
$s_page = 1;
$s_sort = 'A';
$s_key = '';
$s_sceneid = 1;
if ($_COOKIE [$s_fun . 'Item']) {
	$s_item = $_COOKIE [$s_fun . 'Item'];
	$s_page = $_COOKIE [$s_fun . 'Page'];
	$s_sort = $_COOKIE [$s_fun . 'Sort'];
	$s_key = $_COOKIE [$s_fun . 'Key'];
}
ExportMainTitle ( MODULEID, $O_Session->getUid () );
//获取子模块菜单
?>

<div class="panel panel-default sss_sub_table">
<div class="panel-heading">
<div class="caption"><?php
echo (Text::Key ( 'AuditList' ))?></div>
<div class="caption" id="status">&nbsp;&nbsp;&nbsp;&nbsp;</div>
<button id="user_add_btn" type="button" class="btn btn-primary"
	aria-hidden="true"
	style="float: right; margin-top: 0px; outline: medium none"
	onclick="window.open('output_all.php?sceneid=<?php
	echo ($s_sceneid)?>','_blank')">
<span class="glyphicon glyphicon-download-alt"></span>&nbsp;<?php
echo (Text::Key ( 'OutputAll' ))?></button>
</div>
<table class="table table-striped">
	<thead>
		<tr></tr>
	</thead>
	<tbody>
	</tbody>
</table>
</div>
<div class="sss_page"></div>
<script src="js/control.fun.js" type="text/javascript"></script>
<script>
					table_sort('<?php
					echo ($s_fun)?>','<?php
					echo ($s_item)?>','<?php
					echo ($s_sort)?>',<?php
					echo ($s_page)?>,'<?php
					echo ($s_key)?>')
					</script>

<script>
get_audit_status(<?php
echo ($s_sceneid)?>);
var table='<?php
echo ($s_fun)?>';
</script>
<?php
require_once RELATIVITY_PATH . 'foot.php';
?>
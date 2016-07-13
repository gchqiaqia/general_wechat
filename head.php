<?php 
function ExportMainTitle($id,$n_uid)
{
	//获取主模块的标题和说明文字
	$o_sub=new Base_Module(MODULEID);
	$b_showsubmenu=1;
	if ($o_sub->getParentModuleId()>0)
	{
		$o_main=new Base_Module($o_sub->getParentModuleId());
		if ($o_main->getParentModuleId()>0)
		{
			$o_main=new Base_Module($o_main->getParentModuleId());
		}
	}else{
		$b_showsubmenu=0;
		$o_main=$o_sub;
	}
	$n_module_id=$o_main->getModuleId();
	$s_title=$o_main->getName();
	$s_explain=$o_main->getExplain();
	//获取主模块图标
	$o_icon=new Base_Module_Icon($o_main->getIconId());
	$s_icon=$o_icon->getPath();	
	echo('
					<div class="sss_main_sub_top">
                        <div class="title">
                            <span class="glyphicon '.$s_icon.'"></span>&nbsp;&nbsp;'.$s_title.'</div>
                        <div class="text">
                            '.$s_explain.'
                        </div>
                    </div>');
	if ($b_showsubmenu)
	{
	    echo('          <div class="collapse navbar-collapse sss_main_sub_nav">
	                        <ul class="nav navbar-nav">
		');
		//获取子模块菜单
		$a_model=array();
		$o_userModule = new View_User_Right ();
		$o_userModule->PushWhere ( array ('&&', 'Uid', '=', $n_uid ) );
		$o_userModule->PushWhere ( array ('&&', 'ParentModuleId', '=', $n_module_id ) );
		$o_userModule->PushOrder ( array ('Module', 'A' ) );
		$n_count = $o_userModule->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			array_push($a_model, $o_userModule->getModuleId ( $i ));
			$s_on='';
			if ($o_userModule->getModuleId($i)==MODULEID)
			{
				$s_on=' class="active"';
			}
			echo('<li'.$s_on.' onclick="change_sub_nav(this);location=\''.RELATIVITY_PATH.$o_userModule->getPath($i).'\'"><a class="sss_main_sub_nav_btn">'.$o_userModule->getModuleName($i).'</a></li>');
		}
		for($k = 1; $k <= 5; $k ++) {
			eval ( '$o_userModule = new View_User_Right_Sec' . $k . ' ();' );
			$o_userModule->PushWhere ( array ('&&', 'Uid', '=', $n_uid ) );
			$o_userModule->PushWhere ( array ('&&', 'ParentModuleId', '=', $n_module_id ) );
			$o_userModule->PushOrder ( array ('Module', 'A' ) );
			$n_count = $o_userModule->getAllCount ();
			for($i = 0; $i < $n_count; $i ++) {
				if (in_array($o_userModule->getModuleId ( $i ), $a_model))
				{
					continue;
				}
				array_push($a_model, $o_userModule->getModuleId ( $i ));
				$s_on='';
				if ($o_userModule->getModuleId($i)==MODULEID)
				{
					$s_on=' class="active"';
				}
				echo('<li'.$s_on.' onclick="change_sub_nav(this);location=\''.RELATIVITY_PATH.$o_userModule->getPath($i).'\'"><a class="sss_main_sub_nav_btn">'.$o_userModule->getModuleName($i).'</a></li>');
			}
		}
		echo('
				            </ul>
	                    </div>		
		');
	}
}
$o_setup=new Base_Setup(1);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?php echo(Text::Key('SystemName'))?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="<?php echo(RELATIVITY_PATH)?>js/initialize.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" media="screen and (max-width: 767px)" href="<?php echo(RELATIVITY_PATH)?>css/mobile.css" />
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top sss_top">
	<div class="sss_logo">
		<img src="<?php echo(RELATIVITY_PATH.$o_setup->getLogo())?>" alt="" />
	</div>
	<div class="sss_title">
	    <div><span class="glyphicon glyphicon-signal"></span>&nbsp;&nbsp;<span id="title"></span></div>
	</div>
	<div class="sss_menu" onclick="show_nav()">
    	<div><span class="glyphicon glyphicon-align-justify"></span></div>
	</div>
<div class="dropdown sss_top_right_menu">
    <div aria-hidden="true" data-toggle="dropdown" style="margin-bottom:9px;" aria-haspopup="true" aria-expanded="true">
        <div id="username" class="sss_top_right_menu_username">
        </div>
        <div class="sss_top_right_menu_photo">
            <img id="small_photo" src="<?php echo(RELATIVITY_PATH)?>images/photo_default.png" alt="" />
        </div>
        <div class="sss_top_right_menu_btn">
        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></div>
    </div>
    <ul class="dropdown-menu pull-right" style="margin-right:-15px;padding:0px 0px">
        <li><a href="javascript:;" onclick="location=RootPath+'sub/control/info_index.php'" aria-hidden="true" style="outline: medium none;padding:8px 25px;font-size:12px;"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;&nbsp;<?php echo(Text::Key('UserConfig'))?></a></li>
        <li><a href="javascript:;" onclick="logout()" aria-hidden="true" style="outline: medium none;padding:8px 25px;font-size:12px;border-top: 1px solid #D9D9D9"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;<?php echo(Text::Key('Logout'))?></a></li>
    </ul>
</div>
<div class="sss_top_mail" onclick="location=RootPath+'sub/msg/index.php'" data-placement="bottom" data-toggle="tooltip" title="<?php echo(Text::Key('SystemMessage'))?>">
    <span class="glyphicon glyphicon-envelope"></span><div class="badge up" id="mail_number"></div>
</div>
</nav>
    <div style="height: 50px">
    </div>
    <div style="background-color: #303641;">
        <div class="sss_nav mCustomScrollbar light" data-mcs-theme="minimal-dark">
            <div class="sss_nav_top">
                <div class="sss_nav_top_photo" onclick="location='<?php echo(RELATIVITY_PATH)?>sub/control/photo_index.php'">
                    <img id="user_photo" src="<?php echo(RELATIVITY_PATH)?>images/photo_default.png" alt="" />
                </div>
                <div class="sss_nav_top_right">
                    <p>
                       <?php echo(Text::Key('Welcome'))?></p>
                    <p id='name' style="font-size: 18px;"></p>
                    <p>
                        <span class="label label-success" style="font-weight: normal"><?php echo(Text::Key('Online'))?></span></p>
                </div>
				<p class="sss_nav_packup" onclick="show_nav_wide()"><span class="glyphicon glyphicon-pushpin"></span></p>
            <script>get_sys_info()</script>
            </div>
            <div class="sss_nav_cut">
            </div>
            <div id=nav class="list-group sss_nav_menu">
            <div style="padding:15px;"><img id="user_photo" src="<?php echo(RELATIVITY_PATH)?>images/loading.gif" alt="" /></div>
            </div>
            <script>get_nav(<?php echo(MODULEID)?>)</script>
        </div>
        <div class="sss_main_box">
            <div class="sss_main">
                <div class="sss_main_sub">
                <div class="small_loading"><img id="user_photo" src="<?php echo(RELATIVITY_PATH)?>images/loading.gif" alt="" /></div>
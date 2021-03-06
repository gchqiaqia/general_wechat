<?php
require_once RELATIVITY_PATH . 'include/db_operate.class.php';
require_once RELATIVITY_PATH . 'include/db_connect.class.php';
/**
 * 活动表
 * SceneID是场景id，用来区别二维码的
 * */
class WX_Activity extends CRUD {
	protected $Id;
	protected $SceneId;
	protected $SceneName;
	protected $QrCode;
	protected $MessageType;
	protected $MessageUrl;
	protected $PicUrl;
	protected $Description;
	protected $ExpiryDate;
	protected $ActivityDate;
	protected $Title;
	protected $GroupId;
	protected $Address;
	
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'hm_wx_activity';
	}
	
	protected function DefineRelationMap() {
		return (array ('id' => 'Id', 'scene_id' => 'SceneId', 'scene_name' => 'SceneName', 'qr_code' => 'QrCode', 'message_type' => 'MessageType', 'message_url' => 'MessageUrl', 'pic_url' => 'PicUrl', 'description' => 'Description', 'expiry_date' => 'ExpiryDate', 'address' => 'Address', 'activity_date' => 'ActivityDate', 'group_id' => 'GroupId', 'title' => 'Title' ));
	}
}
class WX_Activity_Signin extends CRUD {
	protected $Id;
	protected $ActivityId;
	protected $SceneName;
	protected $QrCode;
	protected $MessageType;
	protected $MessageUrl;
	protected $PicUrl;
	protected $Description;
	protected $Title;
	protected $Address;
	
	protected function DefineKey() {
		return 'id';
	}
	protected function DefineTableName() {
		return 'hm_wx_activity_signin';
	}
	
	protected function DefineRelationMap() {
		return (array ('id' => 'Id', 'activity_id' => 'ActivityId', 'qr_code' => 'QrCode', 'message_type' => 'MessageType', 'message_url' => 'MessageUrl', 'pic_url' => 'PicUrl', 'description' => 'Description', 'address' => 'Address', 'title' => 'Title' ));
	}
}
/**
 * 微信用户表
 * 
 * */
class WX_User_Info extends CRUD {
	protected $Id;
	protected $UserName;
	protected $OpenId;
	protected $Phone;
	protected $Email;
	protected $RegisterMark;
	protected $CreateDate;
	protected $RegisterDate;
	protected $GroupId;
	protected $SceneId;
	protected $Gift;
	protected $DelFlag;
	protected $SigninFlag;
	protected $AuditFlag;
	protected $Address;
	protected $Company;
	protected $DeptJob;
	protected $Items;
	
	protected function DefineKey() {
		return 'id';
	}
	
	protected function DefineTableName() {
		return 'hm_wx_user_info';
	}
	
	protected function DefineRelationMap() {
		return (array ('id' => 'Id', 'user_name' => 'UserName', 'openid' => 'OpenId', 'phone' => 'Phone', 'email' => 'Email', 'register_mark' => 'RegisterMark', 'create_date' => 'Createdate', 'register_date' => 'RegisterDate', 'group_id' => 'GroupId', 'scene_id' => 'SceneId', 'gift' => 'Gift', 'del_flag' => 'DelFlag', 'address' => 'Address', 'company' => 'Company', 'items' => 'Items', 'dept_job' => 'DeptJob', 'signin_flag' => 'SigninFlag', 'audit_flag' => 'AuditFlag' ));
	}
}

/**
 * 微信AccessToken表
 * 
 * */
class WX_Syscode extends CRUD {
	protected $Id;
	protected $SysToken;
	protected $CreateDate;
	
	protected function DefineKey() {
		return 'id';
	}
	
	protected function DefineTableName() {
		return 'hm_wx_syscode';
	}
	
	protected function DefineRelationMap() {
		return (array ('id' => 'Id', 'sys_token' => 'SysToken', 'create_date' => 'CreateDate' ));
	}
}

/**
 * 微信分组表
 * 
 * */
class WX_Group extends CRUD {
	protected $Id;
	protected $GroupId;
	protected $GroupName;
	
	protected function DefineKey() {
		return 'id';
	}
	
	protected function DefineTableName() {
		return 'hm_wx_group';
	}
	
	protected function DefineRelationMap() {
		return (array ('id' => 'Id', 'group_id' => 'GroupId', 'group_name' => 'GroupName' ));
	}
}

?>
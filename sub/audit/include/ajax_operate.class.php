<?php
error_reporting ( 0 );
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'sub/wechat/include/db_table.class.php';
class Operate extends Bn_Basic {
	protected $N_PageSize = 25;
	
	public function AuditListBJ($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100401 ))
			return; //如果没有权限，不返回任何值
		$this->AuditList ( 2, 'AuditListBJ' );
	}
	public function AuditListSH($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100402 ))
			return; //如果没有权限，不返回任何值
		$this->AuditList ( 3, 'AuditListSH' );
	}
	public function AuditListCD($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100403 ))
			return; //如果没有权限，不返回任何值
		$this->AuditList ( 1, 'AuditListCD' );
	}
	public function AuditListCDHH($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100404 ))
			return; //如果没有权限，不返回任何值
		$this->AuditList ( 6, 'AuditListCDHH' );
	}
	private function AuditList($scene_id, $table_name) {
		$n_page = $this->getPost ( 'page' );
		if ($n_page <= 0)
			$n_page = 1;
		$o_user = new WX_User_Info ();
		$s_key = $this->getPost ( 'key' );
		$o_user->PushWhere ( array ('&&', 'SceneId', '=', $scene_id ) );
		$o_user->PushOrder ( array ($this->getPost ( 'item' ), $this->getPost ( 'sort' ) ) );
		$o_user->setStartLine ( ($n_page - 1) * $this->N_PageSize ); //起始记录
		$o_user->setCountLine ( $this->N_PageSize );
		$n_count = $o_user->getAllCount ();
		if (($this->N_PageSize * ($n_page - 1)) >= $n_count) {
			$n_page = ceil ( $n_count / $this->N_PageSize );
			$o_user->setStartLine ( ($n_page - 1) * $this->N_PageSize );
			$o_user->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_user->getAllCount (); //总记录数
		$n_count = $o_user->getCount ();
		$a_row = array ();
		for($i = 0; $i < $n_count; $i ++) {
			
			//数据行
			$a_button = array ();
			if ($o_user->getAuditFlag ( $i ) == 1) {
				//是否审核通过
				$s_audit = '<span class="label label-success">已通过</span>';
				$a_button = '';
			} else {
				$s_audit = '<span class="label label-danger">未审核</span>';
				array_push ( $a_button, array ('通过审核', "audit_approve(this,'" . $o_user->getId ( $i ) . "')" ) ); //删除
				array_push ( $a_button, array ('拒绝', "audit_reject(this,'" . $o_user->getId ( $i ) . "')" ) ); //删除
			}
			if ($o_user->getSigninFlag ( $i ) == 1) {
				//是否审核通过
				$s_signin = '<span class="label label-success">已签到</span>';
			} else {
				$s_signin = '<span class="label label-danger">未签到</span>';
			}
			//构建参会场次
			$a_items = json_decode ( $o_user->getItems ( $i ) );
			$s_items = '';
			for($k = 0; $k < count ( $a_items ); $k ++) {
				$s_items .= urldecode ( $a_items [$k] ) . '<br/>';
			}
			array_push ( $a_row, array (($i + 1 + $this->N_PageSize * ($n_page - 1)), $o_user->getCompany ( $i ), $o_user->getDeptJob ( $i ), $o_user->getUserName ( $i ), $o_user->getPhone ( $i ), $s_items, $o_user->getGift ( $i ), $s_audit, $s_signin, $a_button ) );
		}
		//标题行,列名，排序名称，宽度，最小宽度
		$a_title = array ();
		$a_title = $this->setTableTitle ( $a_title, Text::Key ( 'Number' ), '', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '公司名称', 'Company', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '职务', 'DeptJob', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '姓名', 'UserName', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '手机号', '', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '参会场次', '', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '选择礼品', 'Gift', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '审核', 'AuditFlag', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, '签到', 'SigninFlag', 0, 0 );
		$a_title = $this->setTableTitle ( $a_title, Text::Key ( 'Operation' ), '', 0, 65 );
		$this->SendJsonResultForTable ( $n_allcount, $table_name, 'yes', $n_page, $a_title, $a_row );
	}
	public function GetAuditStatus($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100401 ))
			return; //如果没有权限，不返回任何值
		//统计审核人数，和签到人数，取消关注人数
		$s_sceneid = $this->getPost ( 'sceneid' );
		$o_user = new WX_User_Info ();
		$o_user->PushWhere ( array ('&&', 'SceneId', '=', $s_sceneid ) );
		$o_user->PushWhere ( array ('&&', 'AuditFlag', '=', 1 ) );
		$n_audit = $o_user->getAllCount ();
		$o_user = new WX_User_Info ();
		$o_user->PushWhere ( array ('&&', 'SceneId', '=', $s_sceneid ) );
		$o_user->PushWhere ( array ('&&', 'SigninFlag', '=', 1 ) );
		$n_signin = $o_user->getAllCount ();
		$o_user = new WX_User_Info ();
		$o_user->PushWhere ( array ('&&', 'SceneId', '=', $s_sceneid ) );
		$o_user->PushWhere ( array ('&&', 'DelFlag', '=', 1 ) );
		$n_del = $o_user->getAllCount ();
		$a_result = array ('status' => '已批准：' . $n_audit . '人&nbsp&nbsp&nbsp&nbsp已签到：' . $n_signin . '人' );
		echo (json_encode ( $a_result ));
	}
	public function AuditApprove($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100400 ))
			return; //如果没有权限，不返回任何值
		$o_user = new WX_User_Info ( $this->getPost ( 'id' ) );
		$o_user->setAuditFlag ( 1 );
		$o_user->Save ();
		$openId = $o_user->getOpenId ();
		//构建参会场次
		$a_items = json_decode ( $o_user->getItems () );
		$s_items = '';
		for($k = 0; $k < count ( $a_items ); $k ++) {
			$s_items .= urldecode ( $a_items [$k] ) . '
';
		}
		//读取活动信息
		$o_activity = new WX_Activity ();
		$o_activity->PushWhere ( array ("&&", "SceneId", "=", $o_user->getSceneId () ) );
		$o_activity->getAllCount ();
		
		$s_homepage = 'http://1.hollandmeeting.applinzi.com/';
		
		//		//给用户发送消息
		require_once RELATIVITY_PATH . 'sub/wechat/include/accessToken.class.php';
		$o_token = new accessToken ();
		$curlUtil = new curlUtil ();
		$s_url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $o_token->access_token;
		$data = array ('touser' => $openId, // openid是发送消息的基础
'template_id' => '8tjABrG3_JD-4x_mANFRKuwSkBo9IHGNp3HAjBgnrL8', // 模板id
'url' => $s_homepage . 'sub/wechat/transfer.php', // 点击跳转地址
'topcolor' => '#FF0000', // 顶部颜色
'data' => array ('first' => array ('value' => '审核成功！
			' ), 'keyword1' => array ('value' => '荷兰旅游会议促进局微信服务号', 'color' => '#173177' ), 'keyword2' => array ('value' => '会议报名审核成功', 'color' => '#173177' ), 'keyword3' => array ('value' => Date ( 'Y-m-d h:m:s', time () ), 'color' => '#173177' ), 'remark' => array ('value' => '
您好，您的参会申请已经被确认，请您准时参会。
				    
时间：
' . $s_items . '
地点：' . $o_activity->getAddress ( 0 ) . '

如需修改个人信息，请点击这里。' ) ) );
		$curlUtil->https_request ( $s_url, json_encode ( $data ) );
		
		$a_result = array ();
		echo (json_encode ( $a_result ));
	}
	public function AuditReject($n_uid) {
		if (! ($n_uid > 0)) {
			$this->setReturn ( 'parent.goto_login()' );
		}
		$o_user = new Single_User ( $n_uid );
		if (! $o_user->ValidModule ( 100400 ))
			return; //如果没有权限，不返回任何值
		$o_user = new WX_User_Info ( $this->getPost ( 'id' ) );
		$openid = $o_user->getOpenId ();
		$o_user->Deletion ();
		//将用户放入大众组
		$to_groupid = 0;
		require_once RELATIVITY_PATH . 'sub/wechat/include/accessToken.class.php';
		$token = new accessToken ();
		$curlUtil = new curlUtil ();
		$data = '{"openid":"' . $openid . '",
        		  "to_groupid":' . $to_groupid . '}';
		$url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=" . $token->access_token;
		$res = $curlUtil->https_request ( $url, $data );
		$a_result = array ();
		echo (json_encode ( $a_result ));
	}
}

?>
<?php
class Text
{
  static public function Key($key)
   {
		$a_text=array(
			'LoginTitle'=>'系统登陆',
			'Login'=>'登&nbsp;录',
			'UserName'=>'用户名',
			'Password'=>'密码',
			'ConfirmPassword'=>'确认密码',
			'LoginButton'=>'登&nbsp;陆',
			'LoadingText'=>'读取中',
			'Welcome'=>'欢迎',
			'Online'=>'在线',
			'UserConfig'=>'我的设置',
			'Logout'=>'退&nbsp;&nbsp;出',
			'NotFoundUserName'=>'对不起，您输入的用户名不存在，请确认用户名后再次尝试登陆。',
			'PasswordOverLimit' => '密码错误次数超限，请过1分钟后再尝试登录 ！',
			'UserBlock' => '对不起，您的账户已被停用，请与管理员联系！',
			'PasswordError' => '对不起，您的密码输入错误，请重新输入！',
			'UserListTitle' => '用户列表',
			'AddButton' => '添加',
			'AddUserAlt' => '添加一个新用户',
			'AddDeptAlt' => '添加一个新部门',
			'AddRoleAlt' => '添加一个新角色',
			'Delete' => '删除',
			'Review' => '查看',
			'RestPassword' => '重置密码',
			'Disable' => '停用',
			'Enable' => '启用',
			'Status-Disable' => '已停用',
			'Status-Enable' => '正常',
			'Modify' => '修改',
			'PrimaryRole' => '主角色',
			'AssistantRole' => '副角色',
			'Number' => '序号',
			'Name' => '姓名',
			'Department' => '部门',
			'Role' => '角色',
			'Status' => '状态',
			'Operation' => '操作',
			'DeptList' => '部门列表',
			'RoleList' => '角色列表',
			'DeptName' => '部门名称',
			'Address' => '地址',
			'Phone' => '电话',
			'Fax' => '传真',
			'GoTop' => '返回顶部',
			'UserAddTitle' => '添加新用户',
			'UserModifyTitle' => '修改用户信息',
			'DeptAddTitle' => '添加新部门',
			'DeptModifyTitle' => '修改部门信息',
			'SystemConfigTitle' => '修改系统配置信息',
			'UserInfo' => '用户信息',
			'UserNameAlt' => '大于6位的数字或字母',
			'PasswordAlt' => '设置大于6位的密码',
			'ConfirmPasswordAlt' => '再次确认密码',
			'SystemName' => '系统名称',
			'HomeUrl' => '网站地址',
			'Footer' => '页脚信息',
			'NameAlt' => '昵称或用户真实姓名',
			'Submit' => '提交',
			'Cancel' => '取消',
			'Back' => '返回',
			'Sex' => '性别',
			'Birthday' => '生日',
			'Email' => '邮箱',
			'Photo' => '头像',
			'UploadNewPhoto' => '上传新头像',
			'UploadPhotoSize' => '请上传小于1M的照片，最佳尺寸：高 64px 宽 64px',
			'UserNameRepeat' => '对不起，您输入的“用户名”已被使用，请更换！！',
			'UserAddSuccess' => '恭喜您，添加用户成功！',
			'UserResetpasswordTitle' => '重置用户密码',
			'ResetPassword' => '重置密码',
			'ResetPasswordSuccess' => '恭喜您，重置密码成功！',
			'ResetPasswordError' => '对不起，当前密码错误，请确认后重新输入！',
			'RoleName' => '角色名称',
			'RoleExplain' => '角色描述',
			'NewFolder' => '新建文件夹',
			'Upload' => '上传文件',
			'Icon' => '图标',
			'List' => '列表',
			'Up' => '返回上一级',
			'Refresh' => '刷新',
			'Root' => '根目录',
			'SelectFiles' => '选择文件',
			'Clear' => '清空',
			'ClearAllRecord' => '清空所有记录',
			'Start' => '开始',
			'OperationSuccess' => '操作成功！',
			'OperationError01' => '操作失败，路径错误！',
			'Loading' => '读取中...',
			'CreateFolderError' => '操作失败，文件夹重名或存在非法字符！',
			'Open' => '打开',
			'Download' => '下载',
			'Copy' => '复制',
			'Share' => '分享',
			'Cut' => '剪切',
			'Paste' => '粘贴',
			'Rename' => '重命名',
			'RoleModifyTitle' => '修改角色权限',
			'RoleAddTitle' => '添加新角色',
			'RoleNameAlt' => '角色名称',
			'RoleRight' => '角色权限',
			'RoleAddSuccess' => '恭喜您，角色添加成功！',
			'RoleDelError' => '对不起，有用户在使用这个角色！<br/>请先移除用户角色，再进行删除操作。',
			'DeptAddSuccess' => '恭喜您，部门添加成功！',
			'DeptAddError' => '对不起，部门名称有重复，请更换 ！',
			'DeptDelError' => '对不起，部门内还有用户！，请先将用户移出该部门 ！！',
			'Zip' => 'zip压缩',
			'Unzip' => '解压缩',
			'ZipError' => '压缩失败！',
			'DiskSpace' => '网盘空间',
			'DiskSpaceFull' => '空间不足',
			'Property' => '属性',
			'FreeSpace' => '剩余空间',
			'TotalSpace' => '总空间',
			'FileNum' => '文件总数',
			'FileType' => '文件',
			'FolderType' => '文件夹',
			'NetdiskModify' => '修改用户网盘容量',
			'NetdiskModify' => '修改容量',
			'NetdiskModify' => '清空文件',
			'UserInfoTitle' => '修改个人信息',
			'UserPasswordTitle' => '修改登陆密码',
			'UserPhotoTitle' => '修改个人头像',
			'PhotoUploadError' => '对不起，图片文件类型错误！请选择 JPG PNG 类型的文件 ！',
			'PhotoUploadError02' => '对不起，上传图片大小不能超过1MB ！',
			'PhotoUploadMessage' => '请选择要上传的图片文件！',
			'PhotoUploadSuccess' => '恭喜您，修改头像成功！',
			'Man' => '男',
			'Woman' => '女',
			'Save' => '保存',
			'SaveSuccess' => '恭喜您，信息保存成功！',
			'OldPassword' => '当前密码',
			'OldPasswordAlt' => '请输入当前的登陆密码',
			'Sysmsg_001' => '您的网盘容量已经被管理员修改为 ',
			'Sysmsg_002' => '点击查看',
			'Sysmsg_003' => '修改登录密码',
			'Sysmsg_004' => '您的登录密码已经被管理员重置为： ',
			'Sysmsg_005' => '为确保安全，请尽快修改该密码。',
			'SystemMessage' => '系统提示',
			'SystemMessageExplain' => '需要您关注的系统内消息提示',
			'SystemMessageList' => '历史记录',
			'CurrentLogo' => '当前 Logo',
			'ModifyLogo' => '上传新 Logo',
			'LogoSizeExplain' => '请上传小于1M的图片，最佳尺寸：高 50px 宽 250px',
			'Version' => '系统版本',
			'LastUpdateTime' => '上次升级时间',
			'UserSearch' => '搜索用户名或姓名',
			'AuditList' => '人员列表',
			'OutputAll' => '全部导出',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！',
			'temp' => '对不起，您的密码输入错误，请重新输入！'
		);
		return $a_text[$key];
   }
}
?>
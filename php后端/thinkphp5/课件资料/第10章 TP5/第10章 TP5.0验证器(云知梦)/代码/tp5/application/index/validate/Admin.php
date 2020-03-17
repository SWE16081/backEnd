<?php 
// 声明命名空间
namespace app\index\validate;

use think\Validate;
// 声明验证器

class Admin extends Validate{
	// 验证器规则

	protected $rule=[
		"username"=>"require|length:6,12",
		"password"=>"require|confirm:repassword"

	];

	// 验证器提示信息
	protected $message=[

		"username.require"=>'用户名不存在',
		"username.length"=>'用户名长度不满足',
		"password.require"=>'密码不存在',
		"password.confirm"=>'两次密码不一致',

	];



}






 ?>
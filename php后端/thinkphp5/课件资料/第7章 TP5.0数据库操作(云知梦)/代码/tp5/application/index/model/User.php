<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    // 使用数组配置链接数据库

/*    protected $connection=[

    	// 数据库类型
    	'type'            => 'mysql',
    	// 服务器地址
    	'hostname'        => '127.0.0.1',
    	// 数据库名
    	'database'        => 'yzmedu',
    	// 用户名
    	'username'        => 'root',
    	// 密码
    	'password'        => '123456789',
    	// 端口
    	'hostport'        => '3306',

    ];*/

    protected $connection="mysql://root:123456789@127.0.0.1:3306/yzmedu#utf8";
}

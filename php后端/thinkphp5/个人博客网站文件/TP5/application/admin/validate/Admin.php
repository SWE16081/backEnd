<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    //验证规则
        protected $rule=[
            'username'  => 'require|max:25|unique:admin',
            'password' => 'require|max:33'
        ];

     //错误提示
        protected $message=[
            'username.require'=>'管理员名称必须填写',
            'username.unique'=>'管理员名称不能重复',
            'username.max'=>'管理员名称长度不得超过25位',
            'password.require'=>'管理员密码必须填写',
        ];

        //验证场景
         protected $scene =[
           'add'=>['username'=>'require|max:25|unique:admin','password'],
             'edit'=>['username'=>'require|max:25|unique:admin'],

         ];
}

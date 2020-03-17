<?php
namespace app\admin\validate;
use think\Validate;

class Tags extends Validate
{
    //验证规则
        protected $rule=[
            'tagname'  => 'require|max:18',
        ];

     //错误提示
        protected $message=[
            'tagname.require'=>'标签名称必须填写',
            'tagname.max'=>'标签名称长度不得超过25位'
        ];

        //验证场景
         protected $scene =[
           'add'=>['tagname'],
             'edit'=>['tagname'],

         ];
}

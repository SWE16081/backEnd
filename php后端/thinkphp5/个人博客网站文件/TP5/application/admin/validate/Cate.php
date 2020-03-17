<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    //验证规则
        protected $rule=[
            'catename'  => 'require|max:10|unique:cate',
        ];

     //错误提示
        protected $message=[
            'catename.require'=>'栏目名称必须填写',
            'catename.max'=>'栏目名称长度不得超过10位',
            'catename.unique'=>'栏目名称不能重复',
        ];

        //验证场景
         protected $scene =[
           'add'=>['catename'],
             'edit'=>['catename'],
         ];
}

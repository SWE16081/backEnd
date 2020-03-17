<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    //验证规则
        protected $rule=[
            'title'  => 'require|min:4|max:20',
            'author'  => 'require|max:25',
            'cateid'  => 'require',
        ];

     //错误提示
        protected $message=[
            'title.require'=>'文章标题必须填写',
            'title.max'=>'文章标题不得超过20位',
            'title.min'=>'文章标题不得少于4位',
            'author.require'=>'文章作者必须填写',
            'author.max'=>'文章作者不得超过25位',
            'cateid.require'=>'所属栏目必须选择',
            ];



        //验证场景
         protected $scene =[
           'add'=>['title','author','cateid'],
             'edit'=>['title','author','cateid'],

         ];
}

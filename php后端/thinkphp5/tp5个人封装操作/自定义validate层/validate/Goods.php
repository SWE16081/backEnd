<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 13:39
 */

namespace app\shop\validate;


use think\Validate;

class Goods extends BaseValidate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'email' =>  'email',
    ];

}
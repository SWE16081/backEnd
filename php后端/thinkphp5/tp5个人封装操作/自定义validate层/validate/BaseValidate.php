<?php

/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 11:14
 */
namespace app\shop\validate;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
   public function myCheck($data){
       $result=$this->check($data);
       if(!$result){
           return msg(400,'',$this->getError());
       }else{
           return msg(200,'','验证规则正确');
       }
   }
}
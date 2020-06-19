<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 13:54
 */

namespace app\shop\controller;


use think\Controller;
use think\Loader;

class Test extends Controller
{
  public function index(){
      $key = config('jwt');
      return json(msg(200,$key,''));
      $data = [
          'name'=>'thinkphp',
          'email'=>'thinkphpqq.com'
      ];

      $validate = Loader::validate('Goods');
      $validate = new \app\shop\validate\Goods();
      $result=$validate->myCheck($data);
      if($result['code']==400){
          return json(msg(400,'',$result['msg']));
       }
      }
}
<?php
namespace app\api\model;
use think\DB;
use think\Model;
class Admin extends Model
{

        function loginCheck($data)//登陆验证
        {
            $user=db('admin')->where('username',$data['username'])->find();
            if($user)//账号正确
            {
               if($user['password']==md5($data['password']))//密码正确
               {
                   return 1;
               }
               return 2;
            }
            return 2;
        }
        //注册验证
    function  register($data){
            $user=db('admin')->where('username',$data['username'])->find();

            if($user)//数据库中已有该用户名
            {
                return 1;
            }else{
                return 2;
            }
    }


}

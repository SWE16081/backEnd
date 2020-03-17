<?php
namespace app\admin\controller;
use think\Controller;//引入空间类元素//引用类库

use app\admin\model\Admin as LoginModel;
class Login extends Controller
{
   public function login()
   {
       if(request()->isPost())//提交数据
       {
           $admin=new LoginModel();
           $data=input('post.');//post提交的所有数据
           if($admin->login($data)==3)
           {
               $this->success("账户密码正确,正在为你跳转",'index/index');
           }
           else if($admin->login($data)==4)
           {
               $this->error("验证码错误");
           }
           else{
               $this->error("账户或密码错误");
           }

       }
        return  $this->fetch('login');//加载模板
    }


}

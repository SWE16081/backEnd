<?php
namespace app\admin\controller;
use think\Controller;//引入空间类元素//引用类库

use app\admin\model\Admin as AdminModel;
class Base extends Controller
{
    //初始化方法，执行任何方法前都要先执行它
    public function _initialize()
    {
        //判断是否为管理员
        if(!session('username'))
        {
            $this->error('请先登录','login/login');
        }

    }
}

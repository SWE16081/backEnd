<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\Admin as AdminModel;
class User extends Controller
{
    public function index()
    {
        $adminmodel=new AdminModel();
//        dump($adminmodel->selAdmin(1) );die;
        $res=$adminmodel->selAdmin(1);
        return $res;
    }
}

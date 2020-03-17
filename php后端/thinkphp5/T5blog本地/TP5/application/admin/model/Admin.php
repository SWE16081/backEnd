<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Admin extends Model
{
        //用模型处理数据
        public function login($data)
        {
            // 验证码检测
            $captcha = new \think\captcha\Captcha();
            if (!$captcha->check($data['code'])) {
                return 4;
            }
            $user=DB::name('admin')->where('username','=',$data['username'])->find();
            if($user)
            {
                //将账户密码存入session
                session('username',$user['username']);
                session('id',$user['id']);
                if($user['password']==md5($data['password']))
                {
                    return 3;//信息正确
                }else{
                    return 2;//密码错误
                }
            }else{
                return 1;//用户不存在
            }
        }
}

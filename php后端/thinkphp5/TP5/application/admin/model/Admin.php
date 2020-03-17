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
        //插入数据
        public function insert($data)
        {
            if(db('admin')->insert($data))
            {
                return 1;
            }
            else
                return 0;
        }
        //删除数据
    public function del($data)
    {
        if(db('admin')->where('id',$data)->delete())
        {
            return 1;
        }
        else
            return 0;
    }
    //更新数据
    public function upd($data)
    {
        //            $save=db('admin')->update($data);//$save未更新数据条数
        if(db('admin')->update($data)!==false)
        {
            return 1;
        }
        else
            return 0;
    }
}

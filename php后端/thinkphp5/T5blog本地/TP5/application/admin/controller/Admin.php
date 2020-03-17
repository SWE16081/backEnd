<?php
namespace app\admin\controller;
//use think\Controller;//引入空间类元素//引用类库
use app\admin\controller\Base;
use app\admin\model\Admin as AdminModel;
class Admin extends Base
{

    public function lst()
    {
        //分页输出列表，每页显示三条数据
        $list=AdminModel::paginate(3);//分页同时取得数据库数据
        $this->assign('list',$list);//$list数组被分配到模板中,第一个参数为名称，第二个参数为值
           return  $this->fetch();//加载模板
    }

    public function add()
    {
        if(request()->isPost()){//判断是否添加数据
            //接收数据
            $data=[
                'username'=>input("username"),
                'password'=>input("password"),
            ];
            //验证
            $validate=\think\loader::validate('Admin');
            if(!$validate->scene('add')->check($data))//添加验证的应用场景sence('add')
            {
                   $this->error($validate->getError());
                   die;//关闭程序
            }
            $data['password']=md5(input("password"));
            if(db('admin')->insert($data))//Db::name('admin')->insert($data)向数据表添加数据
            {
                     return $this->success("添加管理员成功","lst");
            }
            else
            {
                return $this->error("添加管理员失败");
            }
            return;
        }
        return  $this->fetch();
    }

    //删除管理员
    public function del()
    {
        $id= input('id');
        if($id!=1)//不是初始化管理员
        {
            if(db('admin')->where('id',$id)->delete())
            $this->success("删除管理员成功",'lst');
            else{
                $this->error("删除管理员失败");
            }
        }
        else
        {
            $this->error("初始化管理员不能删除");
        }
    }

    //修改管理员
    public function edit()
    {
        $id=input('id');
        $admins=db('admin')->where('id',$id)->find();
        if(request()->isPost())//修改信息提交
        {
            //以数组形式保存传过来的数据
            $data=[
                'id'=>input('id'),
                'username'=>input('username'),
            ];
            if(input('password')!="")
            {
                $data['password']=md5(input('password'));
                }
            else{
                $data['password']=$admins['password'];
                }

            //验证
            $validate=\think\loader::validate('Admin');
            if(!$validate->scene('edit')->check($data))//添加验证的应用场景sence('add')
            {
                $this->error($validate->getError());
                die;//关闭程序
            }
            $save=db('admin')->update($data);//$save未更新数据条数
            if($save!==false)//修改数据成功
            {
                $this->success("修改管理员信息成功",'lst');
            }
            else
            {
                $this->error("修改管理员信息失败");
            }

            return ;//跳出程序
        }
        $this->assign('admins',$admins);//把要修改的数据分配到添加模板中
        return  $this->fetch();//加载模板
    }

    //退出登录
    public function logout()
    {
        // 清除session（当前作用域）
        session(null);
        $this->success("退出成功","login/login");
    }

}

<?php
namespace app\admin\controller;
//use think\Controller;//引入空间类元素//引用类库
use app\admin\controller\Base;
use app\admin\model\Cate as CateModel;
class Cate extends Base
{
    public function lst()
    {
        //分页输出列表，每页显示三条数据
        $list=CateModel::paginate(3);//分页同时取得数据库数据
        $this->assign('list',$list);//$list数组被分配到模板中,第一个参数为名称，第二个参数为值
           return  $this->fetch();//加载模板
    }

    public function add()
    {
        if(request()->isPost()){//判断是否添加数据
            //接收数据
            $data=[
                'catename'=>input("catename"),
            ];
            //验证
            $validate=\think\loader::validate('Cate');
            if(!$validate->scene('add')->check($data))//添加验证的应用场景sence('add')
            {
                   $this->error($validate->getError());
                   die;//关闭程序
            }
            if(db('cate')->insert($data))//Db::name('admin')->insert($data)向数据表添加数据 返回插入数据成功的条数
            {
                     return $this->success("添加栏目成功","lst");
            }
            else
            {
                return $this->error("添加栏目失败");
            }
            return;
        }
        return  $this->fetch();
    }

    //删除管理员
    public function del()
    {
        $id= input('cateid');
        if(db('cate')->where('cateid',$id)->delete())
        $this->success("删除栏目成功",'lst');
        else{
            $this->error("删除栏目失败");
        }

    }

    //修改管理员
    public function edit()
    {
        $id=input('cateid');
        $cates=db('cate')->where('cateid',$id)->find();
        if(request()->isPost())//修改信息提交
        {
            //以数组形式保存传过来的数据
            $data=[
                'cateid'=>input('cateid'),
                'catename'=>input('catename'),
            ];
            //验证
            $validate=\think\loader::validate('Cate');
            if(!$validate->scene('edit')->check($data))//添加验证的应用场景sence('edit')
            {
                $this->error($validate->getError());
                die;//关闭程序
            }
            $save=db('cate')->update($data);//修改了几条数据
            if($save!==false)//
            {
                $this->success("修改栏目信息成功",'lst');
            }
            else
            {
                $this->error("修改栏目信息失败");
            }

            return ;//跳出程序
        }
        $this->assign('cates',$cates);//把要修改的数据分配到添加模板中
        return  $this->fetch();//加载模板
    }


}

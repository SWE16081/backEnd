<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // 查询user表的数据

        $data=Db::query("select * from user");

        // 给页面分配数据

        $this->assign("data",$data);

        // 加载页面

        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    // 增加页面
    public function create()
    {
        //


        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */

    // 处理增加数据
    public function save(Request $request)
    {
        // 接收数据

        $data=input("post.");


        // 执行数据库插入

        $code=Db::execute("insert into user value(null,:name,:pass,:age)",$data);

        // 判断是否成功

        if ($code) {
            // 跳转

            $this->success("添加成功",'/user');
        }else{
            $this->error("添加失败");
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        // 从数据库中查询被修改的数据

        $data=Db::query("select * from user where id = ?",[$id]);

        // 分配数据

        $this->assign("data",$data[0]);

        // 加载页面

        return view();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        // 接收数据

        $data=Request::instance()->except('_method');


        // 执行数据库更新操作

        $code=Db::execute("update user set name=:name ,pass=:pass ,age=:age where id= :id",$data);

        // 判断是否成功

        if ($code) {
            $this->success("数据更新成功",'/user');            
        }else{
            $this->error("数据更新失败");
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        // 执行删除的sql语句

        $code=Db::execute("delete from user where id= $id");

        // 判断删除成功

        if ($code) {
            # code...

            $this->success("删除成功");
        }else{
            $this->error("删除失败");

        }

    }
    // ajax 删除数据

    public function ajax_del(){
        // 接收用户想要删除的ID

        $id=input("post.id/d");

        // 执行删除操作

        $code=Db::execute("delete from user where id =$id");

        // 判断是否删除成功

        if ($code) {
            # code...
            $data=[
                'statu'=>200,
                "info"=>'删除成功'
            ];
        }else{
            $data=[
                'statu'=>400,
                "info"=>'删除失败'
            ];
        }

        return $data;
    }
}

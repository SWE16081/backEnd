<?php
namespace app\admin\controller;
//use think\Controller;//引入空间类元素//引用类库
use app\admin\controller\Base;
use app\admin\model\Article as ArticleModel;
class Article extends Base
{
    public function lst()
    {
        //分页输出列表，每页显示三条数据
//        $list=ArticleModel::paginate(3);//分页同时取得数据库数据
        //链接查询
//        $list=db('article')->alias('a')->join('cate c','c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')
//            ->paginate(3);
        //一对多关联
        $list=ArticleModel::paginate(3);
        $this->assign('list',$list);//$list数组被分配到模板中,第一个参数为名称，第二个参数为值
           return  $this->fetch();//加载模板
    }

    public function add()
    {
        if(request()->isPost()){//判断是否添加数据
//            dump($_POST);
//            die;
            //接收数据
            $data=[
                'title'=>input("title"),
                'author'=>input("author"),
                'keywords'=>str_replace('，',',',input('keywords')),
                'desc'=>input("desc"),
                'cateid'=>input("cateid"),
                'content'=>input("content"),
                'time'=>time(),
            ];
            if(input("state")=='true')
                $data['state']=1;
            else
                $data['state']=0;

            //判断是否有上传条件
            if($_FILES['pic']['tmp_name'])//$_FILES['file']['tmp_name']上传临时文件的绝对路径,上传临时文件的生存周期与处理上传的php程序相同（即程序结束，临时文件消失）
            {
//                dump($_FILES['pic']['tmp_name']);die;
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('pic');//名称为上传的图片名--input name
                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                    $data['pic']='/uploads/'.$info->getSaveName();

                }

            }

            //验证
            $validate=\think\loader::validate('Article');
            if(!$validate->scene('add')->check($data))//添加验证的应用场景sence('add')
            {
                   $this->error($validate->getError());
                   die;//关闭程序
            }
            if(db('article')->insert($data))//Db::name('admin')->insert($data)向数据表添加数据
            {
                     return $this->success("添加文章成功","lst");
            }
            else
            {
                return $this->error("添加文章失败");
            }
            return;
        }
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);//分配栏目表数据
        return  $this->fetch();
    }

    //删除管理员
    public function del()
    {
        $id= input('id');
            if(db('article')->where('id',$id)->delete())
            $this->success("删除文章成功",'lst');
            else{
                $this->error("删除文章失败");
            }
    }

    //修改管理员
    public function edit()
    {
        $id=input('id');
        $article=db('article')->where('id',$id)->find();
        if(request()->isPost())//修改信息提交
        {
            //以数组形式保存传过来的数据
            $data=[
                'id'=>input('id'),
                'title'=>input("title"),
                'author'=>input("author"),
                'keywords'=>str_replace('，',',',input('keywords')),
                'desc'=>input("desc"),
                'cateid'=>input("cateid"),
                'content'=>input("content"),
                'time'=>time(),
            ];
            if(input("state")=='true')
                $data['state']=1;
            else
                $data['state']=0;

            //判断是否有上传条件
            if($_FILES['pic']['tmp_name'])
            {
                //删除原缩略图
//                @unlink(__IMG__.$article['pic']);
                // 获取表单上传文件 例如上传了001.jpg
                $file = request()->file('pic');//名称为上传的图片名--input name
                // 移动到框架应用根目录/public/uploads/ 目录下
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                    $data['pic']='/uploads/'.$info->getSaveName();
                }
            }

            //验证
            $validate=\think\loader::validate('Article');
            if(!$validate->scene('edit')->check($data))//添加验证的应用场景sence('add')
            {
                $this->error($validate->getError());
                die;//关闭程序
            }

            if(db('article')->update($data))//修改数据成功
            {
                $this->success("修改文章成功",'lst');
            }
            else
            {
                $this->error("修改文章失败");
            }

            return ;//跳出程序
        }
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);//分配栏目表数据
        $this->assign('article',$article);//把要修改的数据分配到添加模板中
        return  $this->fetch();//加载模板
    }


}

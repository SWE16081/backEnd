<?php
namespace app\api\controller;
use think\Controller;
use app\api\model\Admin as AdminModel;
class index extends Controller
{
    public function index()
    {

      //  判断是否有上传条件
//        if($_FILES[['pic']]['tmp_name'])
//        {
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('pic');//名称为上传的图片名--input name
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic']='/uploads/'.$info->getSaveName();
                return json(['result'=>'true']);
            }
            return json(['result' => 'false']);
//        }
//        return json(['result' => 'false']);

    }
}

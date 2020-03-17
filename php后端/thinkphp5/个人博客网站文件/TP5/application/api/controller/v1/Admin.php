<?php
namespace app\api\controller\v1;
use think\Controller;
use app\api\model\Admin as AdminModel;
class Admin extends Controller
{
    public function index()//登陆验证接口
    {
        //服务器后台设置解决跨域问题
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
//        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

//        $res=['result'=>'true'];
//        return json($res);
//        return '{"result":"true"}';
//        header('Access-Control-Allow-Origin:*');//允许所有来源访问
        if(request()->isPost()) {
            $data = input('post.');//获取提交的用户所有信息

            //验证
            $adminmodel = new AdminModel();

            if ($adminmodel->loginCheck($data) == 1) {
//                $res = ['result' => 'true'];
                return json($res = ['result' => 'true']);
//                return '{"result":"true"}';

            }
                 else {
                return json(['result' => 'false']);
//                return json($data);
            }
        }
            else{
//            $res2=['error'=>'没有提交数据'];
           return json(['error'=>'没有提交数据']);
       }

    }
    public function register(){
        if(request()->isPost()){
            $data=input('post.');
            $adminmodel=new AdminModel();
            if($adminmodel->register($data)==2){
                return json(['result'=>'true']);
            }
            else{
                return json(['result'=>'false']);
            }
        }
        else{
            $res2=['error'=>'没有提交数据'];
            return json($res2);
        }
    }
}

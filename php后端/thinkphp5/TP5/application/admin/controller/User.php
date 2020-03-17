<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User as UserModel;
class User extends Controller
{
//    // 创建用户数据页面
//    public function user()
//    {
//        return $this->fetch();
//    }
//    // 创建用户数据页面
//    public function create()
//    {
//        return $this->fetch('user');
//    }

// 创建用户数据页面
    public function create()
    {
        return view('user');
    }

    // 创建用户数据页面
    public function user()
    {
        return view();
    }
// 新增用户数据
    public function add()
    {
        $user = new UserModel;
        if ($user->allowField(true)->save(input('post.'))) {
            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }
    // 新增用户数据
//    public function add()
//    {
//        $user           = new UserModel;
//        $user->nickname = '流年';
//        $user->email    = 'thinkphp@qq.com';
//        $user->birthday = strtotime('1977-03-05');
//        dump($user->save());die;
//        if ($user->save()) {
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
//                if ($user->save()) {
//            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
//        } else {
//            return $user->getError();
//        }
//    }

    // 新增用户数据
    public function add2()
    {
        $user['nickname'] = '看云';
        $user['email']    = 'kancloud@qq.com';
        $user['birthday'] = strtotime('2015-04-02');
        $result = UserModel::create($user);
//        dump($result);die;
        if ($result = UserModel::create($user)) {
            return '用户[ ' . $result->nickname . ':' . $result->id . ' ]新增成功';
        } else {
            return '新增出错';
        }
    }
    // model的助手函数新增用户数据
    public function add3()
    {
        // 使用model助手函数实例化User模型
        $user = model('User');
// 模型对象赋值
        $user->data([
            'nickname'  =>  'SWE',
            'email' =>  'thinkphp@qq.com'
        ]);
        if ($user->save()) {
            return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
        } else {
            return $user->getError();
        }
    }

    // 批量新增用户数据
    public function addList()
    {
        $user = new UserModel;
        $list = [
            ['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1988-01-15')],
            ['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
        ];
        dump($user->saveAll($list));die;
        if ($user->saveAll($list)) {
            return '用户批量新增成功';
        } else {
            return $user->getError();
        }
    }

    // 读取用户数据
//    public function read($id='1')
//    {
//        $user = UserModel::get($id);
//        echo $user->nickname . '<br/>';
//        echo $user->email . '<br/>';
//        echo date('Y/m/d', $user->birthday) . '<br/>';
//    }

    public function read($id='1')
    {
        $user = UserModel::get($id);
//        return view('read',['user'=>$user]);//第二个参数相当于  $this->assign('user',$user);
//        dump(['user'=>$user]);die;
        $this->assign('user',$user);
        return $this->fetch('read');
    }
    public function read2()
    {
        $list = UserModel::all();
        return view('read',['list'=>$list]);
    }
    // 根据email读取用户数据
//    public function read2()
//    {
//        $user = UserModel::getByEmail('thinkphp@qq.com');
//        echo $user->nickname . '<br/>';
//        echo $user->email . '<br/>';
//        echo date('Y/m/d', $user->birthday) . '<br/>';
//    }
    // 获取用户数据列表
    public function index()
    {
        $list = UserModel::all();
        foreach ($list as $user) {
            echo $user->nickname . '<br/>';
            echo $user->email . '<br/>';
            echo date('Y/m/d', $user->birthday) . '<br/>';
            echo '----------------------------------<br/>';
        }
    }

    // 更新用户数据
    public function update($id="1")
    {
        $user           = UserModel::get($id);
        $user->nickname = 'BB';
        $user->email    = 'liu21st@gmail.com';
        $user->save();
        return '更新用户成功';
    }
}
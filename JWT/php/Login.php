<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 17:15
 */

namespace app\shop\controller;


use Firebase\JWT\JWT;
use think\Controller;
use think\Request;
use think\Session;

class Login extends BaseController
{


    public function login(){
        $data=input('post.');
        $result=true;//判断登录
        //使用redis 拦截第二次非法login操作

        if($result){//生成token
            //生成token
            $this->accessToken=$this->getLoginToken($data['userid']);
            $this->refreshToken=$this->getLoginRefreshToken($data['userid']);
        }
        $res=[
           'access_token'=>$this->accessToken,
            'refresh_token'=>$this->refreshToken
        ];

        return json(msg(200,$res,''));
    }
    public function test(){
        if($this->flage===false){
            return json(msg(400,'',$this->msg));
        }
        $res=[
            'access_token'=>$this->accessToken
        ];
//        return $res;
        /**
         * 其他操作
         */
        return json(msg(200,$res,''));
    }


}
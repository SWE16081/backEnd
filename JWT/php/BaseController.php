<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/6/18
 * Time: 17:50
 */

namespace app\shop\controller;


use Firebase\JWT\JWT;
use think\Controller;
use think\exception\HttpResponseException;
use think\Request;
use think\Response;
use think\Session;

class BaseController extends Controller
{
    protected $accessToken;
    protected $refreshToken;
    protected $flage,$msg;
    public function _initialize()
    {
        $url = Request::instance()->url();
        if ($url != "/shop/Login/login") {//验证token接口
            $refresh_token = Request::instance()->header('refreshToken');
            $access_token = Request::instance()->header('accessToken');
            $refresh_res = $this->checkJwtToken($refresh_token);
            //验证refresh_token合法性
            if($refresh_res['code']==400){
                $this->flage=false;
                $this->msg=$refresh_res['msg'];
            }else{
                //刷新access_token
                $this->accessToken=$this->refreshToken($access_token);
            }
        }
    }
    //登录生成accessToken
    public  function getLoginToken($userid)
    {
        $key = config('jwt.key');
        $jwtData = [
            'lat' => config('jwt.lat'),
            'nbf' => config('jwt.nbf'),
            'exp' => config('jwt.exp'),
            'uid' => $userid,//可以加入自己想要获得的用户信息参数
        ];
        $jwtToken = JWT::encode($jwtData, $key);
        return $jwtToken;
    }
    //登录生成refreshToken
    public function getLoginRefreshToken($userid){
        $key = config('jwt.key');
        $jwtData = [
            'lat' => config('jwt.lat'),
            'nbf' => config('jwt.nbf'),
            'exp' => config('jwt.ref_exp'),
            'uid'=>$userid
        ];
        $jwtToken = JWT::encode($jwtData, $key);
        return $jwtToken;
    }
    //刷新accessToken
    public function refreshToken($token){
        $key  = config('jwt.key');
        //jwt解码
        $info = (array)JWT::decode($token, $key,['HS256']);//返回数据类型为object
        $jwtData = [
            'lat' => config('jwt.lat'),
            'nbf' => config('jwt.nbf'),
            'exp' => config('jwt.exp'),
            'uid'=>$info['uid']
        ];
        $jwtToken = JWT::encode($jwtData, $key);
        return $jwtToken;
    }
    //验证Token
    public  function checkJwtToken($token)
    {
        $key  = config('jwt.key');
        //jwt解码  返回数据类型为object
        $info = (array)JWT::decode($token, $key,['HS256']);
        //根据$info判断token 的过期时间  然后再判断是否存在我们自己设置的uid
//        $info['exp']//过期时间
        if($info['exp']<time()){
            return msg(400,$info,'token已过期');
        }
        if(!array_key_exists('uid',$info)){
            return msg(400,$info,'token自定义字段不存在');
        }
            return msg(200,$info,'jwt验证成功');

    }
}
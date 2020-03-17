<?php 
namespace app\index\controller;

use think\Controller;
use think\Image;

class Yzm extends Controller{

	// index方法

	public function index(){

		return $this->fetch();
	}

	// 验证码处理方法

	public function check(){

		$code=input('post.code');

		// 判断验证码是否正确

		if (captcha_check($code)) {
			# code...
			echo "okokok";
		}else{
			echo "error";
		}
	}

	// 图片处理

	public function img(){
		// 读取图片
		$images=Image::open("./img/c.jpg");

		// 获取图片基本信息

		// dump($images->width());
		// dump($images->height());
		// dump($images->type());
		// dump($images->size());
		// dump($images->mime());

		// 图片裁剪

		// 裁剪默认从顶点开始裁剪
			// $images->crop(300,300)->save("./img/cai.jpg");
		// 设置裁剪位置
			// $images->crop(300,300,100,100)->save('./img/cai1.jpg');

		// 图片缩放
			// 默认等比例变化
			// $images->thumb(300,300,2)->save('./img/th.jpg');

			// //常量，标识缩略图等比例缩放类型
			// const?THUMB_SCALING???=?1;?
			// //常量，标识缩略图缩放后填充类型
			// const?THUMB_FILLED????=?2;?
			// //常量，标识缩略图居中裁剪类型
			// const?THUMB_CENTER????=?3;?
			// //常量，标识缩略图左上角裁剪类型
			// const?THUMB_NORTHWEST?=?4;
			// //常量，标识缩略图右下角裁剪类型
			// const?THUMB_SOUTHEAST?=?5;?
			// //常量，标识缩略图固定尺寸缩放类型
			// const?THUMB_FIXED?????=?6;?

		// 图片翻转

			// $images->flip()->save("./img/fan.jpg");

		// 图片旋转
			// $images->rotate(180)->save("./img/xuan.jpg");

		// 图片水印
			// $images->water("./img/logo.png",5,50)->save("./img/water.jpg");

		// 文字水印

			$images->text('123',"msyh.ttf",20,"#ff0000")->save('./img/text.jpg');

	}
}

 ?>
<?php 
// 声明命名空间
namespace app\index\model;

// 导入系统的数据模型

use think\Model;

// 配合软删除

use traits\model\SoftDelete;

// 声明user模型

class User extends Model{

	use SoftDelete;

	// 设置删除的时间戳

	protected $deleteTime="delete_times";


	// 设置自动写入时间戳

	protected $autoWriteTimestamp=true;

	// 设置时间戳字段

	protected $createTime='create_times';
	protected $updateTime=false;
	// 设置自动完成
		// 无论更新操作和添加操作都会执行

		// protected $auto=['time','user_status'];
		/*protected $auto=[];

		protected $insert=['create_time'];
		protected $update=['update_time'];*/

	// 书写自动完成

	protected function setTimeAttr(){
		return time();
	}

	protected function setUserStatusAttr(){
		return 1;
	}
	
	protected function setCreateTimeAttr(){
		return time();
	}

	protected function setUpdateTimeAttr(){
		return time();
	}


	// sex 的获取器

	// public function getSexAttr($val){
	// 	switch ($val) {
	// 		case '0':
	// 			# code...

	// 			return "未知";
	// 			break;
			
	// 		case "1":

	// 			return "男";

	// 			break;

	// 		case "2":

	// 			return "女";

	// 			break;
	// 		default:
	// 			# code...
	// 			break;
	// 	}
	// }

	// // 用户状态字段获取器

	// public function getUserStatusAttr($val){

	// 	$stats=[0=>"黑名单",1=>"正常"];

	// 	return $stats[$val];

	// }

	// // 用户密码的修改器

	// public function setPassAttr($val){

	// 	return md5($val);
	// }

	// 修改器

	public function setNameAttr($val){

		return strtoupper($val);
	}

	public function setPassAttr($val){
		return md5($val);
	}
}





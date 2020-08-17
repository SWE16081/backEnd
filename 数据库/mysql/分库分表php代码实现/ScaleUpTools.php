<?php
/**
 * Created by PhpStorm.
 * User: SWESWE
 * Date: 2020/8/12
 * Time: 20:33
 */

namespace App\tools;



use Illuminate\Support\Facades\DB;

trait ScaleUpTools
{
    //计算分表的名称
    function countTable($data){
        $table=sprintf('%u',abs(crc32(md5($data))))%32;
//        $table=crc32($data['venueId'])%32;
        return $table;
    }
    function  createTable($table,$data){
        $number=$this->countTable($data);
        $sql="
CREATE TABLE IF NOT EXISTS`{$table}{$number}`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '操作记录表',
  `userName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人名称',
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作动作',
  `actionType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作类型',
  `add_time` datetime(0) NOT NULL COMMENT '添加时间',
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ip地址',
  `result` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '1成功 2失败',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作说明',
  `venueId` int(0) NULL DEFAULT NULL COMMENT '场馆Id',
  `userPhone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人手机号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;";
        $res=DB::statement("{$sql}");
        return $res;
    }
    function  createTable2($table,$data){
        $number=$this->countTable($data);
        $sql="
CREATE TABLE IF NOT EXISTS`{$table}{$number}`  (
    `id` bigint(0) NOT NULL AUTO_INCREMENT COMMENT '云验证请求记录表',
  `param` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '请求参数',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '请求url',
  `venueKey` int(0) NULL DEFAULT NULL COMMENT '场馆Key',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;";
        $res=DB::statement("{$sql}");
        return $res;
    }
    function insertTable($table,$data){
        $res=DB::table("{$table}")->insert($data);
        return $res;
    }
    function selTable($table,$where=[], $orderBy="id",$sort="asc",$field=array('*')){
       $res=DB::table("{$table}")->where($where)->orderBy($orderBy,$sort)->get($field);
       return $res;
   }

    /**
     * 计算分库在哈希环上的位置
     * 分4个库 每个库8个表
     * @author xichao<952002423@qq.com>
     */
   function countDatabase($data){
       $table=sprintf('%u',abs(crc32(md5($data))))%32;
       if($table>=0&&$table<8){
           $database=1;
       }else if($table>=8&&$table<16){
           $database=2;
       }
       else if($table>=16&&$table<32){
           $database=3;
       }
       else if($table>=32&&$table<64){
           $database=4;
       }
       $res=[
         'table'=>$table,
         'database'=>$database,
       ];
       return json_encode($res);
   }

    /**
     * 数据库创建检测
     * @author xichao<952002423@qq.com>
     */
    function databaseCheck($datebase,$databaseNum,$table,$tableNum){
        $sql="select * 
from information_schema.SCHEMATA 
where SCHEMA_NAME = '{$datebase}{$databaseNum}'";
        $res=DB::statement("{$sql}");
        if(count($res)==0){
            $sql2="CREATE DATABASE {$datebase}{$databaseNum}";
            $res=DB::statement("{$sql}");
        }
        $sql3="
CREATE TABLE IF NOT EXISTS`{$table}{$tableNum}`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '操作记录表',
  `userName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作人名称',
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作动作',
  `actionType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作类型',
  `add_time` datetime(0) NOT NULL COMMENT '添加时间',
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ip地址',
  `result` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '1成功 2失败',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作说明',
  `venueId` int(0) NULL DEFAULT NULL COMMENT '场馆Id',
  `userPhone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作人手机号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;";
        $res=DB::statement("{$sql}");
        return $res;

    }
//DB::connection('read')->select(...);
}
<?php

    function arr_unique($arr2d)//参数为二维数组
    {
        foreach($arr2d as $k=>$value)
        {
            $value=join(',',$value);//把一维数组$value用，相隔开组成字符串赋给$value
            $temp[]=$value;
        }
//        if($temp)
//        {
            $temp=array_unique($temp);//array_unique()只适用于一维数组
            foreach($temp as $k=>$value) {
                $temp[$k]=explode(',',$value);
            }
            return $temp;
//        }


    }
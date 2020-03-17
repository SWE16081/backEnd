<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"G:\phpStudy\PHPTutorial\WWW\TP5\public/../application/admin\view\user\read.html";i:1535697554;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
用户ID：<?php echo $user['id']; ?><br/>
昵称：<?php echo $user['nickname']; ?><br/>
邮箱：<?php echo $user['email']; ?><br/>
生日：<?php echo $user['birthday']; ?><br/>
-------------------------------------<br/>
<?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"G:\phpStudy\PHPTutorial\WWW\TP5\public/../application/admin\view\user\user.html";i:1535701945;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>创建用户</title>
    <style>
    </style>
</head>
<body>
<h2>创建用户</h2>
<FORM method="post" class="form" action="<?php echo url('admin/user/add'); ?>">
    昵 称：<INPUT type="text" class="text" name="nickname"><br/>
    邮 箱：<INPUT type="text" class="text" name="email"><br/>
    生 日：<INPUT type="text" class="text" name="birthday"><br/>
    <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
    <INPUT type="submit" class="btn" value=" 提交 ">
</FORM>
</body>
</html>
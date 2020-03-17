<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"G:\phpStudy\PHPTutorial\WWW\TP5\public/../application/admin\view\article\edit.html";i:1538100460;s:70:"G:\phpStudy\PHPTutorial\WWW\TP5\application\admin\view\common\top.html";i:1535440660;s:71:"G:\phpStudy\PHPTutorial\WWW\TP5\application\admin\view\common\left.html";i:1535853575;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">


    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="http://127.0.0.1/TP5/public/static/admin/style/bootstrap.css" rel="stylesheet">
    <link href="http://127.0.0.1/TP5/public/static/admin/style/font-awesome.css" rel="stylesheet">
    <link href="http://127.0.0.1/TP5/public/static/admin/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="http://127.0.0.1/TP5/public/static/admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="http://127.0.0.1/TP5/public/static/admin/style/demo.css" rel="stylesheet">
    <link href="http://127.0.0.1/TP5/public/static/admin/style/typicons.css" rel="stylesheet">
    <link href="http://127.0.0.1/TP5/public/static/admin/style/animate.css" rel="stylesheet">

    <script type="text/javascript" src="http://127.0.0.1/TP5/public/static/admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/TP5/public/static/admin/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/TP5/public/static/admin/ueditor/lang/zh-cn/zh-cn.js"></script>


</head>
<body>
	<!-- 头部 -->
    <!-- 头部 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                        <img src="http://127.0.0.1/TP5/public/static/admin/images/logo.png" alt="">
                    </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="http://127.0.0.1/TP5/public/static/admin/images/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Request::instance()->session('username'); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a>David Stevenson</a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/logout'); ?>">
                                        退出登录
                                    </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/edit',array('id'=>\think\Request::instance()->session('id'))); ?>">
                                        修改密码
                                    </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                        <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                        <!-- Settings -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>

<!-- /头部 -->
	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input class="searchinput" type="text">
        <i class="searchicon fa fa-search"></i>
        <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <!--Dashboard-->
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">管理员</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>

                    <a href="<?php echo url('admin/lst'); ?>">
                                    <span class="menu-text">
                                        管理列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">栏目管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('cate/lst'); ?>">
                                    <span class="menu-text">
                                        栏目列表  </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file-text"></i>
                <span class="menu-text">文档</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('article/lst'); ?>">
                                    <span class="menu-text">
                                        文章列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">友情链接</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('links/lst'); ?>">
                                    <span class="menu-text">
                                        链接列表  </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">系统</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('tags/lst'); ?>">
                                    <span class="menu-text">
                                       Tages标签管理                                 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>



    </ul>
    <!-- /Sidebar Menu -->
</div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                                        <li>
                        <a href="#">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo url('article/lst'); ?>">文章管理</a>
                    </li>
                                        <li class="active">修改文章</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">修改文章</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                        <!--增加一个隐藏域告诉系统修改的是哪一个主键的信息  隐藏域指数据表的一个主键-->
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label no-padding-right">文章标题</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="title" placeholder="" name="title"  type="text" value="<?php echo $article['title']; ?>">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="author" class="col-sm-2 control-label no-padding-right">文章作者</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="author" placeholder="" name="author" type="text" value="<?php echo $article['author']; ?>">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-sm-2 control-label no-padding-right">文章关键字</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="keywords" placeholder="" name="keywords" type="text" value="<?php echo $article['keywords']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="col-sm-2 control-label no-padding-right">文章描述</label>
                            <div class="col-sm-6">
                                <textarea  id="desc" name="desc"class="form-control" value=""><?php echo $article['desc']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pic" class="col-sm-2 control-label no-padding-right">文章图片</label>
                            <div class="col-sm-6">
                                <input type="file" id="pic" name="pic" style="display:inline;" value="<?php echo $article['pic']; ?>">
                                <?php if($article['pic'] != ''): ?>
                                <img src="http://127.0.0.1/TP5/public/static<?php echo $article['pic']; ?>" height="50" width="40">
                                <?php else: ?>
                                暂无缩略图
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cateid" class="col-sm-2 control-label no-padding-right">所属栏目</label>
                            <div class="col-sm-6">
                                <select name="cateid" id="cateid">
                                    <option value="">请选择栏目</option>
                                    <?php if(is_array($cateres) || $cateres instanceof \think\Collection || $cateres instanceof \think\Paginator): $i = 0; $__LIST__ = $cateres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option   <?php if($vo['cateid'] == $article['cateid']): ?>selected="selected"<?php endif; ?> value="<?php echo $vo['cateid']; ?>" ><?php echo $vo['catename']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="state" class="col-sm-2 control-label no-padding-right">是否推荐</label>
                            <div class="col-sm-6">
                                <label>
                                    <input class="checkbox-slider colored-darkorange" id="state" name="state" value="true" <?php if($article['state'] == 1): ?>checked="checked"<?php endif; ?> type="checkbox"><!--checked="checked"默认开启-->
                                    <span class="text"></span>
                                </label>
                            </div>
                        </div>

                        <!--引入百度编辑器-->
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label no-padding-right">文章内容</label>
                            <div class="col-sm-6">
                                <textarea  id="content" name="content" value=""><?php echo $article['content']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">保存信息</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->
    <script src="http://127.0.0.1/TP5/public/static/admin/style/jquery_002.js"></script>
    <script src="http://127.0.0.1/TP5/public/static/admin/style/bootstrap.js"></script>
    <script src="http://127.0.0.1/TP5/public/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="http://127.0.0.1/TP5/public/static/admin/style/beyond.js"></script>

    <script type="text/javascript" >
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关实例
        UE.getEditor('content',{initialFrameWidth:1000,initialFrameHeight:400,});
    </script>

</body></html>
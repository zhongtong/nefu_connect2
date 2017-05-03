<!doctype html>
<html lang="en">
<head>
    <base href="<?php echo site_url();?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/fonts/favicon.ico" type="assets/img/x-icon" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>东林匿名信息平台nefu_connect</title>
</head>
<body>
<div id="index">
    <header class="login-header">
        修改个人资料
    </header>
        <form class="reg" style="display: block;margin: 50px auto;height: 100px;" action="welcome/upload_portrait" method="post" enctype="multipart/form-data">
            <div><input type="file" name="up_portrait" style=""></div>
            <button type="submit" class="btn btn-primary" style="text-align: center;margin-top: 8px;">修改头像</button>
        </form>
    <?php foreach ($list as $real){?>
    <form class="reg" method="post" action="welcome/update_realname" style="display:block;margin:0 auto;">
    <div class="form-group">
            <label for="realname">真实姓名</label>
            <div class="alert alert-warning realname-alert" role="alert"></div>
            <input name="realname" class="form-control" id="realname" value="<?php echo $real->realname;?>">
        </div>
        <button type="submit" class="btn btn-primary" id="regSubmit">修改姓名</button>
    </form>
    <?php }?>
    <!--底部导航栏开始-->
    <footer class="footer">
        <div class="footer-left">
            <a href="welcome/index"><img src="assets/fonts/page-1.ico" alt=""></a>
        </div>
        <div class="footer-right">
            <a href="welcome/user"><img src="assets/fonts/person-1.ico" alt=""></a>
        </div>
    </footer>
    <!--底部导航栏结束-->
</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
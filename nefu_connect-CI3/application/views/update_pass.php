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
        修改密码
    </header>

        <form class="reg" method="post" action="welcome/new_pass" style="display:block;margin:50px auto;">
            <div class="form-group">
                <label for="pass">当前密码</label>
                <div class="alert alert-warning pass-alert" role="alert"></div>
                <input name="password" type="password" class="form-control" id="pass">
            </div>
            <div class="form-group">
                <label for="repass">新密码</label>
                <div class="alert alert-warning repass-alert" role="alert"></div>
                <input name="new_password" type="password" class="form-control" id="repass">
            </div>
            <button type="submit" class="btn btn-primary" id="regSubmit">修改密码</button>
        </form>
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
<script src="assets/js/update.js"></script>
</body>
</html>
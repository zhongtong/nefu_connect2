<!DOCTYPE html>
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
    <title>campusInfo</title>
</head>
<body>
    <div id="index">
        <header class="login-header">
            请登录或注册
        </header>
        <div class="login-content">
            <p>
                <button type="button" class="btn btn-primary btn-block btn-login">登陆</button>
                <button type="button" class="btn btn-default btn-block btn-reg">注册</button>
            </p>
            <form class="login login-select" method="post" action="welcome/do_login">
                <div class="form-group">
                    <label for="exampleInputEmail1">账号</label>
                    <input name="name" class="form-control" id="exampleInputEmail1" placeholder="账号">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
                </div>
                <button type="submit" class="btn btn-default" id="loginSubmit">登陆</button>
            </form>
            <form class="reg" method="post" action="welcome/reg">
                <span>
                    <img src="assets/img/default.jpg">
                </span>
                <div class="form-group">
                    <label for="exampleInputEmail2">账号</label>
                    <input name="name" class="form-control" id="name" placeholder="账号">
                </div>
                <div class="form-group">
                    <label for="exampleInputrePassword1">密码</label>
                    <input name="password" type="password" class="form-control" id="pass" placeholder="设置密码">
                </div>
                <div class="form-group">
                    <label for="exampleInputrePassword2">重复密码</label><span class="danger">密码不一致</span>
                    <input type="password" class="form-control" id="repass" placeholder="重复密码">
                </div>
                <button type="submit" class="btn btn-default" id="regSubmit">注册</button>
            </form>
        </div>
        <footer class="footer">
            <div class="footer-left">
                <a href="welcome/index"><img src="assets/fonts/page-1.ico" alt=""></a>
            </div>
            <div class="footer-right">
                <a href="javascript:;"><img src="assets/fonts/person-1.ico" alt=""></a>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>
</html>
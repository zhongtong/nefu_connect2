<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo site_url();?>">
    <meta charset="UTF-8">
    <title>东林匿名信息平台nefu_connect</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/fonts/favicon.ico" type="assets/img/x-icon" />
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div id="index">
    <header class="user-header">
        <a href="welcome/exit_login"><span class="user-more glyphicon glyphicon-option-horizontal"></span></a>
        <button type="button" class="user-more glyphicon glyphicon-option-horizontal" data-toggle="modal" data-target=".bs-example-modal-sm"></button>
        <div class="user-photo">
            <?php foreach ($real_name_portrait as $realname){?>
            <img src="<?php echo $realname->portrait;?>" alt="username">
            <div><?php echo $realname->realname;?></div>
            <?php }?>
        </div>
        <div class="user-info">
            <div class="user-info-left">
                <a href="welcome/your_msg"><span>帖子</span></a>
                <a href="welcome/your_msg">
                    <span class="number">
                        <?php foreach ($msg_counts as $msg_count){?><?php echo $msg_count->num;?><?php }?>
                    </span>
                </a>
            </div>
            <div class="user-info-right">
                <a href="welcome/your_love"><span>喜欢</span></a>
                <a href="welcome/your_love">
                    <span class="number">
                        <?php foreach ($com_counts as $com_count){?><?php echo $com_count->num;?><?php }?>
                    </span>
                </a>
            </div>
        </div>
    </header>
    <div class="user-content">
        <div class="user-content-title">
            nefu_connect服务
        </div>
        <div class="user-content-item">
            <ul>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-music"></p><br/>
                        <span>音乐</span>
                    </div>
                 </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-glass"></p><br/>
                        <span>吃喝玩乐</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-pencil"></p><br/>
                        <span>学习</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-search"></p><br/>
                        <span>搜索</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-time"></p><br/>
                        <span>闹钟</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-headphones"></p><br/>
                        <span>听歌</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-book"></p><br/>
                        <span>书籍</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-left">
            <a href="welcome/index"><img src="assets/fonts/page-1.ico" alt=""></a>
        </div>
        <div class="footer-right">
            <img src="assets/fonts/person-2.ico" alt="">
        </div>
    </footer>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <a href="welcome/update_info"><button type="button" id="amend_name" class="btn btn-default btn-lg btn-block">修改个人资料</button></a>
            </div>
            <div class="modal-content">
                <a href="welcome/update_pass"><button type="button" id="amend_pass" class="btn btn-default btn-lg btn-block">修改密码</button></a>
            </div>
            <div class="modal-content">
                <a href="welcome/exit_login"><button type="button" id="exit_login" class="btn btn-default btn-lg btn-block">退出登录</button></a>
            </div>
        </div>
    </div>

</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
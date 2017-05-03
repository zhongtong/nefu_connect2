$(function(){
    var flag=false;
    $("#pass").on("blur",function(){
        var str=$(this).val();
        if(str==""){
            $('.pass-alert').html("当前密码不能为空").css({display: 'block'});
            flag=false;
        }else{
            $.get("welcome/check_update_pass",{
                'str':str
            },function(data){
                if(data=='success'){
                    $('.pass-alert').css({display: 'none'});
                    flag=true;
                }else if(data=='fail'){
                    $('.pass-alert').html("当前密码错误").css({display: 'block'});
                    flag=false;
                }
            });
        }

    });
    $("#regSubmit").on('click',function(){
        $("#pass").trigger('blur');
        return flag;
    });
});

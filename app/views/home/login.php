<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>One </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->          
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES --> 
    <link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script>
        var msg = {
            'base_url':"<?php echo base_url();?>"
        };
    </script>
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->   
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/plugins/respond.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/excanvas.min.js"></script> 
    <![endif]-->
    <script src="<?php echo base_url();?>assets/scripts/common.js" type="text/javascript"></script>
    <!-- END JAVASCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">

	<!-- header -->
	<div id='header' class='container'>
        <div class='row'>
    		<div class="col-md-4 m-t-10">
              	<a href="<?php echo base_url()?>">
              		<img src="<?php echo base_url()?>assets/img/logo.png">
              	</a>
            </div>
        </div>
	</div>
	<!-- header end -->
    <div class='container' id='contain'>
        <div class='row'>
            <div class='col-md-7' id='loginLeft' style="height:450px;">
                <img src='<?php echo base_url()?>assets/img/home/loginLeft.png'>
            </div>
            <div class='col-md-5' id='loginArea' style="height:450px;">
                <form action="<?=base_url()?>login/verify" method="post" onsubmit='return false' role="form" id='lms-form'>
                    <div class="form-group">
                        <label for="username"><strong>邮箱/用户名/手机</strong></label>
                        <input type="username" class="form-control" id="username" name="username" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>密码</strong></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>
                    <div style='display:none'>
                      <div style="color:#ff0000;font-size:12px;" id='error_message' ></div>
                    </div>
                    <button type="submit" class="btn btn-block btn-danger" onclick="login_submit()" id='login_form_submit_btn'>登 录</button>
                </form>
                <div class='partnerTitle'><strong>使用合作网站账号登录170ES：</strong></div>
                <div class='partner'>
                    <a href='<?php echo base_url()?>login/byqq'><span><strong>QQ</strong></span></a>
                    <span>|</span><span>
                    <a href='<?php echo base_url()?>login/byweixin'><strong>微信</strong></span></a>
                </div>
                <div class='register text-center'>
                    <a href="<?php echo base_url();?>register"><span><strong>免费注册</strong></span></a>
                    <span>|</span>
                    <a><span><strong>忘记密码</strong></span></a>
                </div>
            </div>
        </div>
    </div>
    <div id='footer' class='text-center'>
        <div id='about'>
            <a><span>关于我们</span></a>
            <a><span>|</span></a>
            <a><span>联系我们</span></a>
            <a><span>|</span></a>
            <a><span>人才招聘</span></a>
            <a><span>|</span></a>
            <a><span>商家入驻</span></a>
            <a><span>|</span></a>
            <a><span>广告服务</span></a>
            <a><span>|</span></a>
            <a><span>手机易购</span></a>
            <a><span>|</span></a>
            <a><span>友情链接</span></a>
            <a><span>|</span></a>
            <a><span>销售联盟</span></a>
            <a><span>|</span></a>
            <a><span>易购社区</span></a>
        </div>
        <div>网络文化经营许可证京文[2011]0168-061号 Copyright © 2004-2014  易购170ES.com 版权所有</div>
    </div>
        <!-- END COPYRIGHT -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->   
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <script src="assets/plugins/excanvas.min.js"></script> 
    <![endif]-->   
    <script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <script>
    $(function(){
        $('#username').focus();
    })
    var base_url = "<?php echo base_url();?>";
    var login_msg = {
        'username_required':"请输入帐户",
        'pwd_required':"请输入密码"
    };
    function login_submit()
    {
        var msg = '';
        if($('input[name=username]').val()=='')
        {
            msg += "<p>"+login_msg.username_required+"</p>";
        }
        if($('input[name=password]').val()=='')
        {
            msg += "<p>"+login_msg.pwd_required+"</p>";
        }
        if(msg != '')
        {
            $('#error_message').html(msg).show();
            $('#error_message').parent().show();
            return false;
        }

        $('#lms-form').ajaxForm({
            dataType:'json',
            success:function(json){
                if(json.code != '1000')
                {
                    $('#login_form_submit_btn').removeClass('disabled');              
                }
                if(json.code == '1011'){
                    $('#error_message').html(json.message).show();
                    $('#error_message').parent().show();
                }else if(json.code != '1000'){
                    $('#error_message').html(json.message).show();
                    $('#error_message').parent().show();
                    $('input[name=password]').val('');
                    $("label[for='password']").show();
                    $('input[name=password]').focus();
                    //刷新验证码
                    $('#login_captcha').attr({src:base_url+'login/get_captcha?t='+Math.random()});
                    $('input[name=validate_key]').val('');
                    $("label[for='validate_key']").show();
                }else{
                    window.location.href = json.url;
                }
            },
            beforeSubmit:function(){
                $('#login_form_submit_btn').addClass('disabled');
                $('#error_message').html('');
                $('#error_message').parent().hide();
            },
            error:function(XMLHttpRequest, textStatus, errorThrown)
            {
                
            }
        });
        $('#lms-form').submit();
    }
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
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
    <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME STYLES --> 
    <link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/css/home.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
<body class="clearfix">
    <!-- begin top -->
    <div id='top'>
    <div  class='container'> 
        <div class='row'>
        <div class="col-md-4 m-t-3">收藏壹心易购</div>
        <div class="text-right col-md-8 m-t-8">           
            <?php if($this->auth->user_id()):?>
            <span>欢迎您 <a href="<?php echo base_url().'users/index/'.$this->auth->user_id();?>"><?php echo $this->auth->username();?></a></span>
            <span><a href="<?php echo base_url().'orders'?>">我的订单</a></span>
            <?endif;?>
            <span>
                <?php if(!$this->auth->user_id()):?>
                <a href="<?php echo base_url()?>/login">登录</a> | <a href="<?php echo base_url()?>register">注册</a>
                <?else:?>
                    <a href="<?php echo base_url()?>login/out"> 退出</a>
                <?endif;?>
            </span>
            </div>
        </div>
   </div>
</div>
<!-- end top -->
<!-- header -->
<div id='' class='container m-t-20'>
    <div class='row'>
        <div class="col-md-4 m-t-10 m-b-10">
            <a href="#">
              <img src="<?php echo base_url()?>assets/img/logo.png">
            </a>
        </div>
    </div>
</div> 

<div class="clearfix"></div>
    <!-- header end -->

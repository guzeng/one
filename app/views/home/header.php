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
<body class="">
    <!-- begin top -->
    <div id='top'>
        <div class='container text-right'>
            <div class='row'>
            <?php if($this->auth->user_id()):?>
            <span>欢迎您 <a href="<?php echo base_url().'users/index/'.$this->auth->user_id();?>"><?php echo $this->auth->username();?></a></span>
            <span><a href="<?php echo base_url().'order/'.$this->auth->user_id();?>">我的订单</a></span>
            <?endif;?>
            <span><a href="<?php echo base_url()?>/login">登录</a> | <a href="<?php echo base_url()?>register">注册</a></span>
            </div>
        </div>
    </div>
    <!-- end top -->
    <!-- header -->
    <div id='header' class='container'>
        <div class='row'>
            <div class="col-md-4 m-t-10">
                <a href="#">
                    <img src="<?php echo base_url()?>assets/img/logo.png">
                </a>
            </div>
            <div class="col-md-8 col-xs-12">
                <form role="form" class="navbar-form navbar-right" id='search-form'>
                    <div class='form-group m-r-15'>
                        <div class="input-group">
                            <input type="text" class="form-control" id='search' placeholder="搜索商品">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-cart" type="submit"><i class="fa icon-cart"></i>购物车</button>

                </form>
            </div>
        </div>
    </div>
    <!-- header end -->
    <!-- navbar -->
    <div class='container navbar' id='navbar'>
        <div class='row'>
            <div class='col-lg-2 col-md-3 col-sm-3 col-xs-12' id='categorys' >
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class='navbar-brand'>全部商品分类</a>
            </div>
            <div class='col-md-9 col-sm-9 col-xs-12 navbar-collapse collapse' >
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">首页</a></li>					
                    <li><a href="<?php echo base_url()?>category">分类</a></li>
                    <li><a href="/index.php/item">产品详情</a></li>
                    <li><a href="/index.php/order">我的订单</a></li>
                    <li><a href="#about">食品</a></li>
                    <li><a href="#contact">日用</a></li>
                    <li><a href="#contact">服装</a></li>
                    <li><a href="#contact">促销</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- navbar end -->
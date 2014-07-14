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
    <link href="<?php echo base_url();?>assets/css/home.css" rel="stylesheet" type="text/css"/>
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
			<span>欢迎您 ZEN</span>
			<span>我的订单</span>
			<span>登录 | 注册</span>
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
    	            <button class="btn btn-lg btn-cart" type="submit">购物车</button>
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
                    <li class="active"><a href="#">首页</a></li>
                    <li><a href="#about">食品</a></li>
                    <li><a href="#contact">日用</a></li>
                    <li><a href="#contact">服装</a></li>
                    <li><a href="#contact">促销</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- navbar end -->
    <!-- categorys  -->
    <div class='container'>
        <div class='row'>
            <div id='category' class='col-lg-2 col-md-3 col-no-padding' >
                <div class='item'>
                    <a>家用电器</a>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>家居</a></span>、
                    <span><a>家具</a></span>、
                    <span><a>家装</a></span>、
                    <span><a>厨具</a></span>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>服饰内衣</a></span>、
                    <span><a>珠宝首饰</a></span>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <a>个护化妆</a>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <a>汽车用品</a>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>鞋靴</a></span>、
                    <span><a>箱包</a></span>、
                    <span><a>钟表</a></span>、
                    <span><a>奢侈品</a></span>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>运动户外母婴</a></span>、
                    <span><a>玩具乐器</a></span>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>食品饮料</a></span>、
                    <span><a>酒类</a></span>、
                    <span><a>生鲜</a></span>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <a>营养保健</a>
                    <span class="more">></span>
                </div>
                <div class='item'>
                    <span><a>彩票</a></span>、
                    <span><a>旅行</a></span>、
                    <span><a>充值</a></span>、
                    <span><a>票务</a></span>
                    <span class="more">></span>
                </div>
            </div>
            <div class='col-lg-7 col-p-10'>
                asdfadsf
            </div>
            <div class='col-lg-3 col-no-padding m-t-10'>
                <div id='userinfo'>
                    adsf
                </div>
            </div>
        </div>
    </div>
    <!-- categorys end -->
</body>
<!-- END BODY -->
</html>
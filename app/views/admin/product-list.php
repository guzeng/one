<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="One" name="description">
        <meta content="zeng.gu" name="author">
        <link href="<?php echo base_url()?>images/favicon.ico" rel="shortcut icon">
        <title>One</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url()?>css/base.css">
        <!--[if lt IE 9]>
          <script src="<?php echo base_url()?>js/respond.min.js"></script>
        <![endif]-->
    </head>
<body>
    <div role="navigation" class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Project name</a>
            </div>
            <div class="collapse navbar-collapse" style='height:1px;'>
                <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="<?php echo base_url()?>admin/products">商品</a></li>
                <li><a href="#contact"></a></li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </div>
    <div class='fill'></div>
    <div id='list_view'>
        <?$list = $this->product->all(10);?>
        <div class='container'>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>编码</th>
                        <th>名称</th>
                        <th>价格</th>
                    </tr>
                </thead>
                <tbody>
                    <?if(!empty($list)):?>
                    <?foreach($list as $key => $item):?>
                    <tr>
                        <td><?php echo $item->code?></td>
                        <td><?php echo $item->name?></td>
                        <td><?php echo $item->price?></td>
                    </tr>
                    <?endforeach;?>
                    <?endif;?>
                </tbody>
            </table>
        </div>
        <div class='container'><?php echo $this->product->pages();?></div>
    </div>
<script src="<?php echo base_url()?>js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url()?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/common.js"></script>
</body>
</html>
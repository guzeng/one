<?$RTR =& load_class('Router', 'core');?>
<?
$controller_name=$RTR->fetch_class();
$method_name=$RTR->fetch_method();
?>
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->        
            <ul class="page-sidebar-menu">
                <li>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler hidden-phone"></div>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <li class="start <?if($controller_name=='index'):?>active<?endif;?> ">
                    <a href="<?php echo base_url()?>admin/index">
                    <i class="fa fa-home"></i> 
                    <span class="title">首页</span>
                    <span class="selected"></span>
                    </a>
                </li>
                <li class="<?if(in_array($controller_name, array('products','product_cate'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">商品</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('products','product_cate'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='products'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/products" >
                            所有商品
                            </a>
                        </li>
                        <li class="<?if($controller_name=='product_cate'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/product_cate" >
                            商品分类
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
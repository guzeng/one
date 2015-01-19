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
                <li class="<?if(in_array($controller_name, array('products','product_cate','product_types','product_brands','product_comments'))):?>open active<?endif;?>">
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
                        <li class="<?if($controller_name=='product_types'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/product_types" >
                            商品类型
                            </a>
                        </li>
                        <li class="<?if($controller_name=='product_brands'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/product_brands" >
                            商品品牌
                            </a>
                        </li>
                        <li class="<?if($controller_name=='product_comments'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/product_comments" >
                            用户评论
                            </a>
                        </li>
                        <li class="<?if($controller_name=='products' && $method_name=='recycle'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/products/recycle" >
                            回收站
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('orders'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">订单</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('orders'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='orders' && $method_name=='index'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/orders" >
                            所有订单
                            </a>
                        </li>
                        <?php $CI = &get_instance(); $CI->load->model('order');?>
                        <?php $order_status = $CI->order->status();?>
                        <?if(!empty($order_status)):?>
                        <?php foreach ($order_status as $key => $value):?> 
                        <li class="<?if($controller_name=='orderss' ):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/orders/other/<?php echo $key;?>" >
                            <?php echo $value;?>
                            </a>
                        </li>
                        <?php endforeach;?>
                        <?endif;?>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('storages'))):?>open active<?endif;?>">
                    <a href="<?php echo base_url()?>admin/storages">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">分仓管理</span>
                    </a>
                </li>
                <li class="<?if(in_array($controller_name, array('users'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">会员管理</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('users'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='users'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/users" >
                            所有会员
                            </a>
                        </li>
                        <li class="<?if($controller_name=='user_comment'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/user_comments" >
                            会员评论
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('coupons'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">优惠券管理</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('coupons/lists'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='coupons'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/coupons" >
                            所有优惠券
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('settings','joins','links'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">系统管理</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('settings'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='settings'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/settings" >
                            系统设置
                            </a>
                        </li>
                         <li class="<?if($controller_name=='provider'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/providers" >
                            供货商
                            </a>
                        </li>
                        <li class="<?if($controller_name=='ship_type'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/ship_type" >
                            配送方式
                            </a>
                        </li>
                        <li class="<?if($controller_name=='pay_type'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/pay_type" >
                            支付方式
                            </a>
                        </li>
                        <li class="<?if($controller_name=='joins'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/joins" >
                            加盟ES
                            </a>
                        </li>
                        <li class="<?if($controller_name=='links'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/links" >
                            友情链接
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('ads'))):?>open active<?endif;?>">
                    <a href="<?php echo base_url()?>admin/ads">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">广告设置</span>
                    </a>
                </li>
                <li class="<?if(in_array($controller_name, array('news','news_cate','questionnaires'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">文章管理</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('news'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($controller_name=='news' && $method_name=='index'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/news" >
                            所有文章
                            </a>
                        </li>
                        <li class="<?if($controller_name=='news_cate' && $method_name=='index'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/news_cate" >
                            文章分类
                            </a>
                        </li>
                        <li class="<?if(in_array($controller_name, array('questionnaires'))):?>open active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/questionnaires">
                            <span class="title">在线问卷</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?if(in_array($controller_name, array('statistic'))):?>open active<?endif;?>">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">统计管理</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu" <?if(in_array($controller_name, array('statistic'))):?>style='display:block;'<?endif;?>>
                        <li class="<?if($method_name=='visit'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/statistic/visit" >
                            访问统计
                            </a>
                        </li>
                        <li class="<?if($method_name=='product'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/statistic/product" >
                            商品统计
                            </a>
                        </li>
                        <li class="<?if($method_name=='order'):?>active<?endif;?>">
                            <a href="<?php echo base_url()?>admin/statistic/order" >
                            订单统计
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
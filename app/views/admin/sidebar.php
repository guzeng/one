
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->        
            <ul class="page-sidebar-menu">
                <li>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler hidden-phone"></div>
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <li class="start active ">
                    <a href="<?php echo base_url()?>admin/index">
                    <i class="fa fa-home"></i> 
                    <span class="title">首页</span>
                    <span class="selected"></span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;">
                    <i class="fa fa-cogs"></i> 
                    <span class="title">商品</span>
                    <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li >
                            <a href="<?php echo base_url()?>admin/products" >
                            所有商品
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url()?>admin/product_category" >
                            商品分类
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
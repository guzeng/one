<?$this->load->view('admin/header');?> 
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						首页
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue p-20">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $product_count;?>
							</div>
							<div class="desc">                           
								商品
							</div>
						</div>         
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green p-20">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $order_count?></div>
							<div class="desc">订单</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple p-20">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $member_count?></div>
							<div class="desc">会员</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow p-20">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number"><?php echo $news_count?></div>
							<div class="desc">文章</div>
						</div>     
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix"></div>

			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet solid bordered light-grey">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-bar-chart-o"></i>最近15天订单</div>
							
						</div>
						<div class="portlet-body">
							<div id="orders_statistics_loading">
								<img src="<?php echo base_url();?>assets/img/loading.gif" alt="loading"/>
							</div>
							<div id="orders_statistics_content" class="display-none">
								<div id="orders_statistics" class="chart"></div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
<script type="text/javascript">
		var orders = [];
		var x_date = [];
		var date = [];
		var avi_time = [];
		var i = 1;
		<?if(!empty($days)):?>
		<?php $i=1;?>
		<?foreach($days as $key => $value):?>
            orders.push([<?php echo $i;?>,parseInt("<?php echo $value['order']?>")]);
            avi_time.push([<?php echo $i;?>,parseInt("<?php echo $value['order']?>")]);
            date.push([<?php echo $i;?>,"<?php echo date('d/m/Y',strtotime($key))?>"]);

            <?if($i==1):?>
            	x_date.push([<?php echo $i;?>,"<?php echo date('d/m/Y',strtotime($key))?>"]);
            <?elseif(($i+1)%2==0):?>
            	x_date.push([<?php echo $i;?>,"<?php echo date('d/m',strtotime($key))?>"]);
            <?else:?>
            	x_date.push([<?php echo $i;?>,""]);
            <?endif;?>
            <?php $i++;?>
        <?endforeach;?>
        <?endif;?>
</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/scripts/index.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
       Index.initCharts(); // init index page's custom scripts
    });
</script>
<?$this->load->view('admin/footer');?>
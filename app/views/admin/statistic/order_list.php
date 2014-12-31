<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				订单统计
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url()?>">首页</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">统计管理</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li><a href="#">订单统计</a></li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->

	<!-- BEGIN PAGE CONTENT-->
	<div class='row m-b-20'>
		<div class="col-md-12">
		<?foreach($count as $key => $item):?>
			<div class='pull-left m-r-20'>
				<a href="<?php echo base_url().'admin/orders/other/'.$item["status"]?>">
					<?php echo $key.'('.$item['count'].')';?>
				</a>
			</div>
		<?endforeach;?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="pie_chart_9" class="chart"></div>
		</div>
	</div>

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.crosshair.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<script>
		jQuery(document).ready(function() {
			var data = [];
			var i = 0;
			<?foreach($count as $key => $item):?>
				data[i]= {
					label: "<?php echo $key?>",
					data: parseInt(<?php echo $item['count']?>)*100/parseInt(<?php echo $total?>)
				};
				++i;
			<?endforeach;?>
            $.plot($("#pie_chart_9"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            tilt: 0.6,
                            label: {
                                show: true,
                                radius: 1,
                                formatter: function (label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {
                                    opacity: 0.8
                                }
                            },
                            combine: {
                                color: '#999',
                                threshold: 0
                            }
                        }
                    },
                    legend: {
                        show: false
                    }
                });
		});
	</script>
<?$this->load->view('admin/footer');?>
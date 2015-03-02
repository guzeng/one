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
				<div class="col-md-6 col-sm-12">
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

				<div class="col-md-6 col-sm-12">
					<div class="portlet solid bordered light-grey">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-globe"></i>订单情况</div>
							
						</div>
						<div class="portlet-body">
							<div id="order_pie_chart" class="chart"></div>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-reorder"></i>最近15天浏览数</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div id="chart_15days_browser_history_legendPlaceholder"></div>
							<div id="chart_15days_browser_history" class="chart"></div>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-reorder"></i>最近15天购买数</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div id="chart_15days_buy_history_legendPlaceholder"></div>
							<div id="chart_15days_buy_history" class="chart"></div>
						</div>
					</div>
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

<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.stack.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.crosshair.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/scripts/index.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
       Index.initCharts(); // init index page's custom scripts

		var data = [];
		var i = 0;
		<?foreach($order_pie_count as $key => $item):?>
			data[i]= {
				label: "<?php echo $key?>",
				data: parseInt(<?php echo $item['count']?>)*100/parseInt(<?php echo $order_pie_total?>)
			};
			++i;
		<?endforeach;?>
        $.plot($("#order_pie_chart"), data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    tilt: 1,
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
        //最近15天浏览记录
        var data1 = [];
        var i = 1;
        <?php foreach($browser as $key => $value):?>
        data1.push([i,<?php echo $value?>]);
        i++;
        <?php endforeach;?>
        var options = {
            series:{
                bars:{show: true}
            },
            bars:{
                  barWidth:0.8
            },            
            grid:{
                backgroundColor: { colors: ["#fafafa", "#35aa47"] }
            }
        };
        $.plot($("#chart_15days_browser_history"), [data1], options);
        //最近15天浏览记录
        /*
        var data1 = GenerateSeries(0);
        function GenerateSeries(added){
            var data = [];
            var start = 100 + added;
            var end = 200 + added;
     
            for(i=1;i<=20;i++){        
                var d = Math.floor(Math.random() * (end - start + 1) + start);        
                data.push([i, d]);
                start++;
                end++;
            }
     
            return data;
        }
        */
        var data1 = [];
        var i = 1;
        <?php foreach($buy as $key => $value):?>
        data1.push([i,<?php echo $value?>]);
        i++;
        <?php endforeach;?>
        var options = {
                series:{
                    bars:{show: true}
                },
                bars:{
                      barWidth:0.8
                },            
                grid:{
                    backgroundColor: { colors: ["#fafafa", "#35aa47"] }
                }
        };
        $.plot($("#chart_15days_buy_history"), [data1], options);
    });
</script>
<?$this->load->view('admin/footer');?>
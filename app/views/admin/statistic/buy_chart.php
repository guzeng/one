<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						购买统计
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">统计管理</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>购买统计</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue" id='list-box'>
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-list"></i>购买统计</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<form action="<?php echo base_url()?>admin/statistic/buy_chart" class="form-horizontal form-bordered" method='get'>
								<div class="form-group">
									<label class="control-label col-md-3">日期选择</label>
									<div class="col-md-4">
										<div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control" name="from" value="<?php echo isset($from)?$from:''?>">
											<span class="input-group-addon"> - </span>
											<input type="text" class="form-control" name="to" value="<?php echo isset($to)?$to:''?>">
										</div>
									</div>
									<div class='col-md-4'>
										<button class='btn blue' type='submit'>确定</button>
									</div>
								</div>
								</form>
							</div>
							<div id="chart_2" class="chart"></div>

						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.pie.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.crosshair.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script >
		jQuery(document).ready(function() {
			chart2();
			if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                autoclose: true
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
		});

        //Interactive Chart

        function chart2() {
            var visitors = [];
            var i=0;
            <?php foreach($browser as $key => $value):?>
            visitors.push([i,<?php echo $value?>]);
            i++;
            <?php endforeach;?>
            var plot = $.plot($("#chart_2"), [{
                        data: visitors
                    }
                ], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: true,
                            fillColor: {
                                colors: [{
                                        opacity: 0.05
                                    }, {
                                        opacity: 0.01
                                    }
                                ]
                            }
                        },
                        points: {
                            show: true
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#eee",
                        borderWidth: 0
                    },
                    colors: ["#d12610", "#37b7f3", "#52e136"],
                    xaxis: {
                        ticks: 20,
                        tickDecimals: 0
                    },
                    yaxis: {
                        ticks: 11,
                        tickDecimals: 0
                    }
                });


            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 15,
                        border: '1px solid #333',
                        padding: '4px',
                        color: '#fff',
                        'border-radius': '3px',
                        'background-color': '#333',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#chart_2").bind("plothover", function (event, pos, item) {
                $("#x").text(pos.x.toFixed(2));
                $("#y").text(pos.y.toFixed(2));

                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);

                        showTooltip(item.pageX, item.pageY, y);
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        }
	</script>    
<?$this->load->view('admin/footer');?>
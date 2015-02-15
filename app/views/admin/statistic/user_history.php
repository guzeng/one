<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						用户浏览统计
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
						<li>用户浏览统计</li>
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
							<div class="caption"><i class="fa fa-list"></i>用户浏览统计</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<table class="table table-striped table-bordered table-hover" id="user_history_list">
								<thead>
									<tr>
										<th width='20%'>用户名</th>
										<th width='10%'>总浏览量</th>
										<th width='*'>最常浏览的商品</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->total?></td>
                                		<td><?php echo $item->product_name?></td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script >
		jQuery(document).ready(function() {
		   initTable('user_history_list');
		});
		function delete_callback()
		{
			reload_list('list-box','user_history_list','admin/statistic/user_history');
		}
	</script>    
<?$this->load->view('admin/footer');?>
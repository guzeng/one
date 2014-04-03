<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<?$this->load->view('admin/sidebar');?>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?$this->load->view('admin/theme');?>
			<!-- END BEGIN STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						所有商品
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<button id="sample_editable_1_new" class="btn green">
								<i class="fa fa-plus"></i> 新增商品 
							</button>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">所有商品</a></li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-list"></i>所有商品</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default" href="#" data-toggle="dropdown">
									显示字段
									<i class="fa fa-angle-down"></i>
									</a>
									<div id="sample_2_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked data-column="0">编码</label>
										<label><input type="checkbox" checked data-column="1">名称</label>
										<label><input type="checkbox" checked data-column="2">价格</label>
										<label><input type="checkbox" checked data-column="3">优惠价</label>
									</div>
								</div>
							</div>
							<div class="tools">
								<a class="reload m-r-5" href="javascript:void();" onclick="Product.reload()"></a>
							</div> &nbsp; 
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<?$list = $this->product->all();?>
							<table class="table table-striped table-bordered table-hover" id="product_list">
								<thead>
									<tr>
										<th>编码</th>
										<th>名称</th>
										<th>价格</th>
										<th class="hidden-xs">优惠价</th>
										<th class="hidden-xs"></th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr>
                                		<td><?php echo $item->code?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->price?></td>
                                		<td><?php echo $item->best_price?></td>
										<td></td>
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
			<!-- END PAGE CONTENT-->
			<div class="clearfix"></div>
		</div>
	</div>
<?$this->load->view('admin/script');?>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url();?>assets/scripts/product.js"></script>    
	<script>
		jQuery(document).ready(function() {
		   Product.init();
		});

	</script>
<?$this->load->view('admin/footer');?>
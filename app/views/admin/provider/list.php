<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						供货商
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">系统管理</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>供货商</li>
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
							<div class="caption"><i class="fa fa-list"></i>供货商</div>
							<div class="actions">
								<div class="btn-group">
									<a href='<?php echo base_url();?>admin/providers/edit' class="btn blue m-r-5">
											<i class="fa fa-plus"></i> 新增供货商
									</a>
									<a class='btn blue' href="javascript:void(0);" onclick="reload_list('list-box','provider_list','admin/providers/lists')"><i class='fa fa-refresh'></i></a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<?php echo $list;?>
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
		   initTable('provider_list');
		});
		function delete_callback()
		{
			reload_list('list-box','provider_list','admin/providers/lists');
		}
	</script>    
<?$this->load->view('admin/footer');?>
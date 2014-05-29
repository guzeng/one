<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						所有会员
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">所有会员</a></li>
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
							<div class="caption"><i class="fa fa-list"></i>所有会员</div>
							<div class="actions">
								<div class="btn-group">
									<a href='<?php echo base_url();?>admin/users/edit' class="btn blue m-r-5">
											<i class="fa fa-plus"></i> 新增会员
									</a>
									<a class='btn blue' href="javascript:void(0);" onclick="reload_list('list-box','user_list','admin/users/lists')"><i class='fa fa-refresh'></i></a>
									<a class="btn blue" href="#" data-toggle="dropdown">
									显示/隐藏
									<i class="fa fa-angle-down"></i>
									</a>
									<div id="user_list_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked data-column="0">会员名</label>
										<label><input type="checkbox" checked data-column="1">姓名</label>
										<label><input type="checkbox" checked data-column="2">邮箱</label>
										<label><input type="checkbox" checked data-column="3">等级</label>
										<label><input type="checkbox" checked data-column="4">积分</label>
									</div>
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
	<script>
		jQuery(document).ready(function() {
		   initTable('user_list');
		});
	</script>
<?$this->load->view('admin/footer');?>
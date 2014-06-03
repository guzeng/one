<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						加盟ES
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">系统管理</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							加盟ES
						</li>
						<li class='btn-group'>
							<button class="btn btn-link" type="button" onclick='goback()'>
								<i class="fa fa-reply"></i><span>返回</span>
							</button>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12" id="">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-reorder"></i>加盟信息</div>
							<div class="tools">
								<a class="collapse" href="javascript:;"></a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form role="form" class="form-horizontal">
								<div class="form-body">
									<h3 class='form-section'>基本信息</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">类型:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $this->join->type($row->type)?></p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">公司名称:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $row->company?></p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">姓名:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $row->name?></p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">电话:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $row->phone?></p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->        
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">邮箱:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo $row->email?></p>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">提交时间:</label>
												<div class="col-md-9">
													<p class="form-control-static"><?php echo date('Y-m-d H:i:s',$row->create_time)?></p>
												</div>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->                
									<h3 class="form-section">简介</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="form-control-static"><?php echo $row->note;?></div>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM-->  
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" id="">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-reorder"></i>备注</div>
							<div class="tools">
								<a class="collapse" href="javascript:;"></a>
							</div>
						</div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form role="form" class="form-horizontal" id='join_edit' action="<?php echo base_url();?>admin/joins/update">
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<textarea name='remark' class='form-control' row='3'><?php echo $row->remark;?></textarea>
										</div>
									</div>
								</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn btn-lg green" type="button" onclick="do_submit('join_edit')"><i class="fa fa-pencil"></i> 保存</button> &nbsp;
												<button class="btn btn-lg btn-default" onclick='goback()' type="button">取消</button>                              
											</div>
										</div>
									</div>
								</div>
								<input type='hidden' name='id' value="<?php echo $row->id;?>" >
							</form>
							<!-- END FORM-->  
						</div>
					</div>
				</div>
			</div>


	<!-- END PAGE LEVEL PLUGINS -->
<?$this->load->view('admin/footer');?>
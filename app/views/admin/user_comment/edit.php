<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						回复留言
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/users">会员管理</a>
							<?if(isset($row)):?>
							<i class="fa fa-angle-right"></i>
							<?endif;?>
						</li>
						<?if(isset($row)):?>
						<li>
							回复留言
						</li>
						<?endif;?>
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
						<div class="portlet-body ">
							<!-- BEGIN FORM-->
							<form action="<?php echo base_url()?>admin/user_comments/reversion/<?php echo isset($row)?$row->id:''?>" class="horizontal-form" id='user-comment-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>留言内容</label>
												<textarea rows="4" id="content" name='content' class="form-control" maxLength='100' readonly><?php echo isset($row)?$row->content:''?></textarea>
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<!--/span-->
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 回复内容</label>
												<textarea rows="4" id="reversion" name='reversion' class="form-control"placeholder=""><?php echo isset($row)?$row->reversion:''?></textarea>
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="do_submit('user-comment-edit')" class="btn green"><i class="fa fa-save"></i> 保存</button>
									<button type="button" class="btn default" onclick="javascript:history.go(-1);">取消</button>
								</div>
								<input type='hidden' id='id' name='id' value="<?php echo isset($row)?$row->id:''?>">
							</form>
							<!-- END FORM--> 
						</div>
					</div>
				</div>
			</div>


	<!-- END PAGE LEVEL PLUGINS -->
<?$this->load->view('admin/footer');?>
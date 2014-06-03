<?$this->load->view('admin/header');?>
<!-- BEGIN PAGE LEVEL STYLES --> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
var editor;
$(function(){
	jQuery(document).ready(function() { 

	});
});	

function questionnaireSumbit(){
	do_submit('questionnaire-add');
}
</script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>调查问卷
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>admin/questionnaires">所有调查问卷</a>
							<?if(isset($row)):?>
							<i class="fa fa-angle-right"></i>
							<?endif;?>
						</li>
						<?if(isset($row)):?>
						<li>
							<?php echo $row->title;?>
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
							<form action="<?php echo base_url()?>admin/questionnaires/create" class="horizontal-form" id='questionnaire-add'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>标题</label>
												<input type="text" id="title" name='title' class="form-control" maxLength='50' placeholder="50字符以内" value="">
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">开头语</label>
												<textarea style="height:150px;" class="form-control" cols="100" rows="4" name="intro"></textarea>
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">结束语</label>
												<textarea style="height:100px;" class="form-control" cols="100" rows="4" name="conclusion"></textarea>
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="questionnaireSumbit()" class="btn green"><i class="fa fa-save"></i> 下一步</button>
									<button type="button" class="btn default" onclick="javascript:history.go(-1);">取消</button>
								</div>
							</form>
							<!-- END FORM--> 
						</div>
					</div>
				</div>
			</div>


	<!-- END PAGE LEVEL PLUGINS -->
<?$this->load->view('admin/footer');?>
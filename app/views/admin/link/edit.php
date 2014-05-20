<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>友情链接
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="index.html">系统管理</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">友情链接</a>
							<?if(isset($row)):?>
								<i class="fa fa-angle-right"></i>
							<?endif;?>
						</li>
						<?if(isset($row)):?>
						<li>
							<?php echo $row->name;?>
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
							<form action="<?php echo base_url()?>admin/links/update" class="horizontal-form" id='link-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 名称</label>
												<input type="text" id="title" name='title' class="form-control" maxLength='50' placeholder="50字符以内" value="<?php echo isset($row)?$row->title:''?>">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 地址</label>
												<input type="text" id="url" name='url' class="form-control" maxLength='200' placeholder="50字符以内" value="<?php echo isset($row)?$row->url:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 图片</label>
									            <div class='relative'>
									                <div class="fileupload-buttonbar">
									                    <div class="">
									                        <!-- The fileinput-button span is used to style the file input field as button -->
									                        <span class="btn blue fileinput-button">
									                            <i class="fa fa-plus"></i>
									                            <span>上传图片</span>
									                            <input id="img_upload" type="file" name="img_upload" multiple="false">
									                        </span>
									                    </div>
									                </div>
									            </div>
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="do_submit('link-edit')" class="btn green"><i class="fa fa-save"></i> 保存</button>
									<button type="button" class="btn btn-default" onclick="javascript:history.go(-1);">取消</button>
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
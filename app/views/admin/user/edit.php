<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>会员
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">所有会员</a>
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
							<form action="<?php echo base_url()?>admin/users/update" class="horizontal-form" id='user-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>会员名</label>
												<input type="text" id="username" name='username' class="form-control" maxLength='20' placeholder="" value="<?php echo isset($row)?$row->username:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 邮箱地址</label>
												<input type="text" id="email" name='email' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->email:''?>">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 密码</label>
												<input type="password" id="password" name='password' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->password:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 确认密码</label>
												<input type="password" id="password_re" name='password_re' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->password:''?>">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 积分</label>
												<input type="text" id="score" name='score' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->score:'0'?>">
												<span class="help-block" for="score"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 等级</label>
												<input type="text" id="grade" name='grade' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->grade:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> 推荐人</label>
												<input type="text" id="reference" name='reference' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->reference:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> 姓名</label>
												<input type="text" id="name" name='name' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->name:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> 手机号码</label>
												<input type="text" id="phone" name='phone' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->phone:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> 固定电话</label>
												<input type="text" id="telephone" name='telephone' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->telephone:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> 邮编</label>
												<input type="text" id="post_code" name='post_code' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->post_code:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> QQ</label>
												<input type="text" id="qq" name='qq' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->qq:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"> 地区</label>
												<input type="text" id="area" name='area' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->area:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"> 详细地址</label>
												<input type="text" id="address" name='address' class="form-control" maxLength='50' placeholder="" value="<?php echo isset($row)?$row->address:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="do_submit('user-edit')" class="btn green"><i class="fa fa-save"></i> 保存</button>
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
<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						系统设置
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="javascript:void(0)">系统管理</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>admin/settings">系统设置</a>
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
			<form role="form" class="form-horizontal" id='setting-form' method='post' action="<?php echo base_url()?>admin/settings/update">		
				<div class="row">
					<div class="col-md-12" id="">
						<div class="portlet box blue ">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-reorder"></i> 邮件发送配置
									</div>
									<div class="tools">
										<a class="collapse" href=""></a>
									</div>
								</div>
								<div class="portlet-body form">
										<div class="form-body">
	    									<div class="form-group">
			    								<label class="col-md-3 control-label">SMTP服务器地址 :</label>
			    								<div class="col-md-7">
			    									<input type="text" id="smtp_server" name="smtp_server" value="<?php echo isset($smtp_server) ? $smtp_server : '';?>" class="form-control" maxlength="100">
			                                        <span class="help-block" for='smtp_server'></span>
			    									<span class='tip'>如：smtp.domain.com</span>
			    								</div>
			    							</div>
			    				           	<div class="form-group">
			    								<label class="col-md-3 control-label">SMTP服务器端口 :</label>
			    								<div class="col-md-7">
			    									<input type="text" id="smtp_port" name="smtp_port" value="<?php echo  isset($smtp_port) ? $smtp_port : '';?>" class="form-control" maxlength="100">
			                                        <span class="help-block" for='smtp_port'></span>
			    								</div>
			    							</div>
			    				           	<div class="form-group">
			    								<label class="col-md-3 control-label">用户名 :</label>
			    								<div class="col-md-7">
			    									<input type="text" id="smtp_user" name="smtp_user" value="<?php echo  isset($smtp_user) ? $smtp_user : '';?>" class="form-control" maxlength='50' autocomplete="off" >
			                                        <span class="help-block" for='smtp_user'></span>
			    								</div>
			    							</div>
			    				           	<div class="form-group">
			    								<label class="col-md-3 control-label">密码 :</label>
			    								<div class="col-md-7">
			    									<input type="password" id="smtp_pwd" name="smtp_pwd" value="<?php echo  isset($smtp_pwd) ? $smtp_pwd : '';?>" class="form-control" maxlength='50'>
			                                        <span class="help-block" for='smtp_pwd'></span>
			    								</div>
			    							</div>
			    				           	<div class="form-group">
			    								<label class="col-md-3 control-label">发信地址 :</label>
			    								<div class="col-md-7">
			    									<input type="email" id="smtp_email" name="smtp_email" value="<?php echo  isset($smtp_email) ? $smtp_email : '';?>" class="form-control" maxlength="100">
			    									<span class='tip'>所有email都将显示为从此地址发出，如：summer0808@domain.com</span>
			                                        <span class="help-block" for='smtp_email'></span>
			    								</div>
			    							</div>
										</div>
								</div>
						</div>
					</div>
	    			<div class="col-md-12">
	    				<!-- BEGIN SAMPLE FORM PORTLET-->   
	    				<div class="portlet box blue ">
	    					<div class="portlet-title">
	    						<div class="caption">
	    							<i class="fa fa-list"></i>联系我们
	    						</div>
	    						<div class="tools">
	    							<a href="" class="collapse"></a>
	    						</div>
	    					</div>
	    					<div class="portlet-body form">
	    						<div class="form-body">
	    							<div class="form-group">
	    								<label class="col-md-3 control-label">联系人 :</label>
	    								<div class="col-md-7">
	    									<input type="text" id="contact_man" name="contact_man" value="<?php echo isset($contact_man) ? $contact_man : '';?>" class="form-control" maxlength="100">
	                                        <span class="help-block" for='contact_man'></span>
	    								</div>
	    							</div>
	    							<div class="form-group">
	    								<label class="col-md-3 control-label">联系电话 :</label>
	    								<div class="col-md-7">
	    									<input type="text" id="contact_phone" name="contact_phone" value="<?php echo  isset($contact_phone) ? $contact_phone : '';?>" class="form-control" maxlength="100">
	                                        <span class="help-block" for='contact_phone'></span>
	    								</div>
	    							</div>
	    							<div class="form-group">
	    								<label class="col-md-3 control-label">电子邮件 :</label>
	    								<div class="col-md-7">
	    									<input type="email" id="contact_email" name="contact_email" value="<?php echo  isset($contact_email) ? $contact_email : '';?>" class="form-control" maxlength="100">
	                                        <span class="help-block" for='contact_email'></span>
	    								</div>
	    							</div>
	    						</div>
	    					</div>
	    				</div><!-- END SAMPLE FORM PORTLET-->
	    			</div><!-- end col -->
	    			<div class="col-md-12">
	    				<!-- BEGIN SAMPLE FORM PORTLET-->   
	    				<div class="portlet box blue ">
	    					<div class="portlet-title">
	    						<div class="caption">
	    							<i class="fa fa-list"></i>安全设置
	    						</div>
	    						<div class="tools">
	    							<a href="" class="collapse"></a>
	    						</div>
	    					</div>
	    					<div class="portlet-body form">
	    						<div class="form-body">
	    							<div class="form-group">
	    								<label class="col-md-3 control-label">验证码 : </label>
	    								<div class="col-md-7">
	    									<div class="radio-list">
	    										<?if(isset($captcha) && $captcha == 1):?>
	    											<label class="radio-inline">
														<input type="radio" name="key" id="captcha" value="1" checked="checked" style="">
														打开
	    											</label>
	    											<label class="radio-inline">
														<input type="radio" name="key" id="captcha" value="0" style="">
														关闭
	    											</label>
	    										<?else:?>
	    											<label class="radio-inline">
														<input type="radio" name="key" id="captcha" value="1" style="">
														打开
	    											</label>
	    											<label class="radio-inline">
														<input type="radio" name="key" id="captcha" value="0" checked="checked" style="">
														关闭
	    											</label>
	    										<?endif;?>
	    									</div>
	    								</div>
	    							</div>
	    						</div>
	    					</div>
	    				</div><!-- END SAMPLE FORM PORTLET-->
	    			</div><!-- end col -->
					<div class="col-md-12">
						<div class="form-actions fluid">
							<div class="col-md-offset-3 col-md-9">
								<button class="btn btn-lg green" type="button" onclick="do_submit('setting-form')">保存</button> &nbsp;
								<button class="btn btn-lg btn-default" type="button">取消</button>                              
							</div>
						</div>
					</div>

				</div>
			</form>


	<!-- END PAGE LEVEL PLUGINS -->
<?$this->load->view('admin/footer');?>
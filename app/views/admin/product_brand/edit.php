<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>商品品牌
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							商品品牌
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
							<form action="<?php echo base_url()?>admin/product_brands/update" class="horizontal-form" id='product-brand-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">名称</label>
												<input type="text" id="name" name='name' class="form-control" maxLength='50' placeholder="50字符以内" value="<?php echo isset($row)?$row->name:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">备注</label>
												<textarea id="info" name='info' class="form-control" maxLength='100' placeholder="100字符以内"><?php echo isset($row)?$row->info:''?></textarea>
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
								</div>
								<div class="form-actions text-center">
									<button type="button" onclick="do_submit('product-brand-edit')" class="btn green"><i class="fa fa-save"></i> 保存</button>
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
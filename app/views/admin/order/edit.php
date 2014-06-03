<?$this->load->view('admin/header');?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>商品
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">所有商品</a>
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
							<form action="<?php echo base_url()?>admin/products/update" class="horizontal-form" id='product-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">编码</label>
												<input type="text" id="pcode" name='pcode' class="form-control" maxLength='20' placeholder="20字符以内" value="<?php echo isset($row)?$row->code:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span> 名称</label>
												<input type="text" id="name" name='name' class="form-control" maxLength='50' placeholder="50字符以内" value="<?php echo isset($row)?$row->name:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">价格</label>
												<input type="text" id="price" name='price' class="form-control" maxLength='8' placeholder="最多2位小数" value="<?php echo isset($row)?$row->price:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">优惠价</label>
												<input type="text" id="best_price" name='best_price' class="form-control" maxLength='8' placeholder="最多2位小数" value="<?php echo isset($row)?$row->best_price:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">分类</label>
												<select  class="form-control" id='cate_id' name='cate_id'>
													<option value="0">请选择</option>
													<?if(!empty($cates)):?>
													<?foreach($cates as $key => $value):?>
													<option value="<?php echo $value->id;?>" <?if(isset($row)&&$row->cate_id==$value->id):?>selected='selected'<?endif;?>><?php echo $value->name;?></option>
													<?endforeach;?>
													<?endif;?>
												</select>
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">类型</label>
												<select  class="form-control" id='type_id' name='type_id'>
													<option value="0">请选择</option>
													<?if(!empty($types)):?>
													<?foreach($types as $key => $value):?>
													<option value="<?php echo $value->id;?>" <?if(isset($row)&&$row->type_id==$value->id):?>selected='selected'<?endif;?>><?php echo $value->name;?></option>
													<?endforeach;?>
													<?endif;?>
												</select>
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
									</div>
									<!--/row-->        
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">库存</label>
												<input type="text" id="amount" name='amount' maxLength='8' class="form-control" placeholder="请输入整数" value="<?php echo isset($row)?$row->amount:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<!--/span-->
										<!--/span-->
									</div>
									<!--/row--> 
								</div>
								<div class="form-actions right">
									<button type="button" onclick="do_submit('product-edit')" class="btn green"><i class="fa fa-save"></i> 保存</button>
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
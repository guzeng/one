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
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list"></i>商品信息</div>
                </div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="<?php echo base_url()?>admin/products/update" class="horizontal-form" id='product-edit'>
						<div class="form-body">
							<h4 class="form-section">基本信息</h4>
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
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">品牌</label>
										<select  class="form-control" id='brand_id' name='brand_id'>
											<option value="0">请选择</option>
											<?if(!empty($brands)):?>
											<?foreach($brands as $key => $value):?>
											<option value="<?php echo $value->id;?>" <?if(isset($row)&&$row->brand_id==$value->id):?>selected='selected'<?endif;?>><?php echo $value->name;?></option>
											<?endforeach;?>
											<?endif;?>
										</select>
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">计量单位</label>
										<input type="text" id="unit" name='unit' class="form-control" maxLength='30' placeholder="最多30字符" value="<?php echo isset($row)?$row->unit:''?>">
										<span class="help-block"></span>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">单位重量</label>
										<input type="text" id="weight" name='weight' class="form-control" maxLength='8' placeholder="最多2位小数" value="<?php echo isset($row)?$row->weight:''?>">
										<span class="help-block"></span>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">最低购买量</label>
										<input type="text" id="min_num" name='min_num' class="form-control" maxLength='11' placeholder="请输入整数" value="<?php echo isset($row)?$row->min_num:''?>">
										<span class="help-block"></span>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">积分</label>
										<input type="text" id="score" name='score' class="form-control" maxLength='11' placeholder="请输入整数" value="<?php echo isset($row)?$row->score:''?>">
										<span class="help-block"></span>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">简介</label>
										<textarea id="info" name='info' class="form-control"><?php echo isset($row)?$row->info:''?></textarea>
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							<!--/row--> 
							
							<h4 class='form-section'>商品图片</h4>
							<div class='row'>
								<div class='col-md-12'>		     
                                    <?if(isset($row)&&$row->id>0):?>
                                        <img src="<?php echo $this->product->pic($row->id,'small')?>" id='pro_setting_pic' style='max-width:120px;height:68px;margin-bottom:10px;'> 
                                    <?endif;?>
                                    <div id="review_pic" class='m-b-10'></div>
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                    <div class="row fileupload-buttonbar" id='upload_file_con'>
                                        <div class="col-md-3">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn blue fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>上传图片</span>
                                            <input id="pic_edit_upload" type="file" name="files" multiple="false">
                                            </span>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div class="progress progress-striped active hide" id="upload-loading">
                                        <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>
                                    <span class='help-block'>请上传小于1M的PNG、JPG、GIF图片</span>
								</div>
							</div>       

							<h4 class="form-section">商品状态</h4>       
							<div class="row">
								<div class="col-md-12">
									<div class="checkbox-list">
										<label class="checkbox-inline">
											<input type="checkbox" style='margin-left:0px;margin-right:5px;' value="1" id="status" name='status' <?php echo isset($row)&&$row->status==1?"checked='checked'":''?>> 发布
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" value="1" name='recommend' id="recommend" <?php echo isset($row)&&$row->recommend==1?"checked='checked'":''?>> 推荐
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" value="1" name='specials' id="specials" <?php echo isset($row)&&$row->specials==1?"checked='checked'":''?>> 特价
										</label>  
										<label class="checkbox-inline">
											<input type="checkbox" value="1" name='hot' id="hot" <?php echo isset($row)&&$row->hot==1?"checked='checked'":''?>> 热卖
										</label>  
										<label class="checkbox-inline">
											<input type="checkbox" value="1" name='allow_comment' id="allow_comment" <?php echo isset($row)&&$row->allow_comment==1?"checked='checked'":''?>> 允许评论
										</label>  
									</div>
								</div>
							</div>
							<!--/row-->

						</div>
						<div class="form-actions text-center">
							<button type="button" onclick="do_submit('product-edit')" class="btn btn-lg green"><i class="fa fa-save"></i> 保存</button> &nbsp; 
							<button type="button" class="btn btn-lg btn-default" onclick="javascript:history.go(-1);">取消</button>
						</div>
						<input type='hidden' id='id' name='id' value="<?php echo isset($row)?$row->id:''?>">
                        <input type='hidden' id='pro_pic_path' name='pro_pic_path' value=''>
					</form>
					<!-- END FORM--> 
				</div>
			</div>
		</div>
	</div>

	<link href="<?php echo base_url()?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
	<!-- The File Upload processing plugin -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
	<!-- The File Upload user interface plugin -->
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
	<!-- The main application script -->
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js" type="text/javascript"></script>
	<![endif]-->
	<!-- BEGIN:File Upload Plugin JS files-->
	<script id="template-upload" type="text/x-tmpl">
	    {% for (var i=0, file; file=o.files[i]; i++) { %}
	        <tr class="template-upload fade">
	            <td>
	                <span class="preview"></span>
	            </td>
	            <td>
	                <p class="name">{%=file.name%}</p>
	                {% if (file.error) { %}
	                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
	                {% } %}
	            </td>
	            <td>
	                <p class="size">{%=o.formatFileSize(file.size)%}</p>
	                {% if (!o.files.error) { %}
	                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
	                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
	                    </div>
	                {% } %}
	            </td>
	            <td>
	                {% if (!o.files.error && !i && !o.options.autoUpload) { %}
	                    <button class="btn blue start">
	                        <i class="fa fa-upload"></i>
	                        <span>Start</span>
	                    </button>
	                {% } %}
	                {% if (!i) { %}
	                    <button class="btn red cancel">
	                        <i class="fa fa-ban"></i>
	                        <span>Cancel</span>
	                    </button>
	                {% } %}
	            </td>
	        </tr>
	    {% } %}
	</script>
	<!-- The template to display files available for download -->
	<script id="template-download" type="text/x-tmpl">
	    {% for (var i=0, file; file=o.files[i]; i++) { %}
	        <tr class="template-download fade">
	            <td>
	                <span class="preview">
	                    {% if (file.thumbnailUrl) { %}
	                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
	                    {% } %}
	                </span>
	            </td>
	            <td>
	                <p class="name">
	                    {% if (file.url) { %}
	                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
	                    {% } else { %}
	                        <span>{%=file.name%}</span>
	                    {% } %}
	                </p>
	                {% if (file.error) { %}
	                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
	                {% } %}
	            </td>
	            <td>
	                <span class="size">{%=o.formatFileSize(file.size)%}</span>
	            </td>
	            <td>
	                {% if (file.deleteUrl) { %}
	                    <button class="btn red delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	                        <i class="fa fa-trash-o"></i>
	                        <span>Delete</span>
	                    </button>
	                {% } else { %}
	                    <button class="btn yellow cancel">
	                        <i class="fa fa-ban"></i>
	                        <span>Cancel</span>
	                    </button>
	                {% } %}
	            </td>
	        </tr>
	    {% } %}
	</script>
	<!-- END PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url();?>assets/scripts/admin/product.js" type="text/javascript"></script>
<?$this->load->view('admin/footer');?>
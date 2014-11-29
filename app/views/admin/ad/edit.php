<?$this->load->view('admin/header');?>
<link href="<?php echo base_url()?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js"></script>
<script type="text/javascript">
 $(function(){
 	 //时间
	$('#start_time,#end_time').datepicker({
		autoclose: true,
	    format: 'yyyy-mm-dd',
	    language: 'zh-CN'
	});
 })
</script>
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>广告
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							系统管理
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/ads">广告</a>
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
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-list"></i>
                                <?php echo isset($row)&&$row->id>0?'编辑':'新增'?>广告</div>
                        </div>
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="<?php echo base_url()?>admin/ads/update" class="form-horizontal" id='ad-edit'>
								<div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><span class='req'>*</span> 名称</label>
                                        <div class="col-md-7">
                                            <input type="text" id="title" name="title" class="form-control" maxlength="50" placeholder="50字符以内" value="<?php echo isset($row)?$row->title:''?>">
                                            <span class="help-block" for='url'></span>
                                        </div>
                                    </div>
									<div class="form-group">
										<label class="control-label col-md-3"><span class='req'>*</span> 链接地址</label>
										<div class="col-md-7">
		                                    <input type="text" id="url" name="url" class="form-control" maxlength="200" placeholder="200字符以内,注意以http://开头" value="<?php echo isset($row)?$row->url:''?>">
		                                    <span class="help-block" for='url'></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"><span class='req'>*</span> 显示位置</label>
										<div class="col-md-7"> 
		                                    <select id="position_id" name="position_id" class="form-control">
		                                    	<option <?php echo isset($row) && $row->position_id == 1 ? 'selected' : '';?> value="1">首页滚动图</option>
		                                    	<option <?php echo isset($row) && $row->position_id == 2 ? 'selected' : '';?> value="2">首页1F区域</option>
		                                    	<option <?php echo isset($row) && $row->position_id == 3 ? 'selected' : '';?> value="3">首页2F区域</option>
		                                    	<option <?php echo isset($row) && $row->position_id == 4 ? 'selected' : '';?> value="4">首页3F区域</option>
		                                    </select>
		                                    <span class="help-block" for='url'></span>
										</div>
									</div>
		                            <div class="form-group m-b-0">
		                                <label class="col-md-3 control-label">广告图片</label>
		                                <div class="col-md-9">
                                            <?if(isset($row)&&$row->id>0):?>
                                                <img src="<?php echo $this->ad->pic($row->id)?>" id='link_setting_pic' style='max-width:120px;height:68px;margin-bottom:10px;'> 
                                            <?endif;?>
		                                    <div id="review_pic" class='m-b-10'></div>
		                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		                                    <div class="row fileupload-buttonbar" id='upload_file_con'>
		                                        <div class="col-md-3">
		                                            <!-- The fileinput-button span is used to style the file input field as button -->
		                                            <span class="btn blue fileinput-button">
		                                            <i class="fa fa-plus"></i>
		                                            <span>上传图片</span>
		                                            <input id="skin_edit_upload" type="file" name="files" multiple="false">
		                                            </span>
		                                        </div>
		                                    </div>
		                                    <div class='clearfix'></div>
		                                    <div class="progress progress-striped active hide" id="upload-loading">
		                                        <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
		                                            <span class="sr-only"></span>
		                                        </div>
		                                    </div>
		                                    <p class='help-block'></p>
		                                </div>
		                            </div>
		                            <div class="form-group">
										<label class="control-label col-md-3"> 开始时间</label>
										<div class="col-md-7">
		                                    <input type="text" id="start_time" name="start_time" class="form-control" maxlength="50" placeholder="不填写则为无限期" readonly value="<?php echo isset($row)?($row->start_time?date('Y-m-d',$row->start_time):'没有限期'):'';?>">
		                                    <span class="help-block" for='start_time'></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> 结束时间</label>
										<div class="col-md-7">
		                                    <input type="text" id="end_time" name="end_time" class="form-control" maxlength="50" placeholder="不填写则为无限期" readonly value="<?php echo isset($row)?($row->end_time?date('Y-m-d',$row->end_time):'没有限期'):'';?>">
		                                    <span class="help-block" for='end_time'></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> 联系人</label>
										<div class="col-md-7">
		                                    <input type="text" id="link_man" name="link_man" class="form-control" maxlength="50" placeholder="" value="<?php echo isset($row)?$row->link_man:''?>">
		                                    <span class="help-block" for='link_man'></span>
										</div>
									</div>
		                            <div class="form-group">
										<label class="control-label col-md-3"> 联系人邮箱</label>
										<div class="col-md-7">
		                                    <input type="text" id="link_email" name="link_email" class="form-control" maxlength="50" placeholder="" value="<?php echo isset($row)?$row->link_email:''?>">
		                                    <span class="help-block" for='link_email'></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> 联系人手机号码</label>
										<div class="col-md-7">
		                                    <input type="text" id="link_phone" name="link_phone" class="form-control" maxlength="50" placeholder="" value="<?php echo isset($row)?$row->link_phone:''?>">
		                                    <span class="help-block" for='link_phone'></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3"> 发布</label>
										<div class="col-md-7 checkbox-list">
											<label class="checkbox-inline">
												<input style="margin-left:0px;margin-top:0px;" type="checkbox" value="1" id="enabled" name='enabled' <?php echo (isset($row)&&$row->enabled==1) || !isset($row)?"checked='checked'":''?>>
											</label>
		                                    <span class="help-block" for='enabled'></span>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button type="button" onclick="do_submit('ad-edit')" class="btn green btn-lg"><i class="fa fa-save"></i> 保存</button> &nbsp;
										<button type="button" class="btn btn-default btn-lg" onclick="javascript:history.go(-1);">取消</button>
									</div>
								</div>
								<input type='hidden' id='id' name='id' value="<?php echo isset($row)?$row->id:''?>">
                                <input type='hidden' id='link_pic_path' name='link_pic_path' value=''>
							</form>
							<!-- END FORM--> 
						</div>
					</div>
				</div>
			</div>

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
<script src="<?php echo base_url();?>assets/scripts/admin/link.js" type="text/javascript"></script>
<?$this->load->view('admin/footer');?>
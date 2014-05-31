<?$this->load->view('admin/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/kindeditor-4.1.7/themes/default/default.css" />

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/kindeditor-4.1.7/kindeditor-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/kindeditor-4.1.7/lang/zh_CN.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
var editor;
$(function(){
	//日期控件
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    //文本编辑控件
    KindEditor.ready(function(K) {
        editor = K.create('textarea[id="content2"]', {
            resizeType : 1,
            width:'100%',
            height:700,
            allowPreviewEmoticons : false,
            allowImageUpload : true,
            // uploadJson : base_url+'uploadHandler',
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link','unlink','|','fullscreen','about']
        });
    });
    //状态事件
    $("#status").change(function(){
    	if($("#status").val() == 0 || $("#status").val() == 1)
    	{
    		$("#div_show_time").hide();
    		$("#show_time").val('');
    	}
    	
    	if($("#status").val() == 2)
    		$("#div_show_time").show();

    })
});	

function newsSumbit(){
	$('#content').text(editor.html());
	do_submit('news-edit');
}
</script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>文章
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>admin/news">所有文章</a>
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
							<form action="<?php echo base_url()?>admin/news/update" class="horizontal-form" id='news-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>标题</label>
												<input type="text" id="title" name='title' class="form-control" maxLength='50' placeholder="50字符以内" value="<?php echo isset($row)?$row->title:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">类别</label>
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
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>状态</label>
												<select id="status" name='status' class="form-control">
													<option value="2" <?if((isset($row)&& $row->status==2) || !isset($row)):?>selected='selected'<?endif;?>>自动发布</option>
													<option value="0" <?if(isset($row)&& $row->status==0):?>selected='selected'<?endif;?>>关闭</option>
													<option value="1" <?if(isset($row)&& $row->status==1):?>selected='selected'<?endif;?>>立刻发布</option>
												</select>
											</div>
										</div>
										<div id="div_show_time" class="col-md-6 <?if(isset($row)&& ($row->status==0 || $row->status==1)):?>hide<?endif;?>">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>发布时间</label>
												<input type="text" id="show_time" name='show_time' size="16" readonly class="form-control date-picker" value="<?php echo isset($row)?date('Y-m-d',$row->show_time):''?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>内容</label>
												<textarea id="content2" rows='10' cols='100' class='form-control'><?php echo isset($row) ? htmlspecialchars($row->content) : '';?></textarea>
												<textarea id="content" name="content" style="display:none;"></textarea>
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="newsSumbit()" class="btn green"><i class="fa fa-save"></i> 保存</button>
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
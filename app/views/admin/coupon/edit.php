<?$this->load->view('admin/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
var editor;
$(function(){
	//日期控件
    $('.date-picker').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        todayBtn: true,
        autoclose: true,
        language: 'zh-CN'
    });
});	

function couponSumbit(){
	do_submit('coupon-edit');
}
</script>
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						<?php echo isset($row)?'编辑':'添加'?>优惠券
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>admin/coupons">所有优惠券</a>
							<?if(isset($row)):?>
							<i class="fa fa-angle-right"></i>
							<?endif;?>
						</li>
						<?if(isset($row)):?>
						<li>
							<?php echo $row->code;?>
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
							<form action="<?php echo base_url()?>admin/coupons/update" class="horizontal-form" id='coupon-edit'>
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>编号</label>
												<input type="text" id="code" name='code' class="form-control" maxLength='50' placeholder="50字符以内" value="<?php echo isset($row)?$row->code:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>类别</label>
												<select  class="form-control" id='type' name='type'>
													<option <?if(isset($row)&&$row->type==1):?>selected='selected'<?endif;?> value="1">购物赠</option>
													<option <?if(isset($row)&&$row->type==2):?>selected='selected'<?endif;?> value="2">商家赠</option>
												</select>
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>面值</label>
												<input type="text" id="value" name='value' class="form-control" maxLength='10' placeholder="" value="<?php echo isset($row)?$row->value:''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>消费金额</label>
												<input type="text" id="use" name='use' maxLength="10" class="form-control" placeholder="填0则是没有限制消费金额" value="<?php echo isset($row)?$row->use:''?>">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>有效期开始时间</label>
												<input type="text" id="expirse_from" name='expirse_from' readonly class="form-control date-picker" maxLength='50' placeholder="" value="<?php echo isset($row)?date('Y-m-d h:m:s',$row->expirse_from):''?>">
												<span class="help-block"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"><span class='req'>*</span>有效期结束时间</label>
												<input type="text" id="expirse_to" name='expirse_to' maxLength="50" readonly class="form-control date-picker" value="<?php echo isset($row)?date('Y-m-d h:m:s',$row->expirse_to):''?>">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" onclick="couponSumbit()" class="btn green"><i class="fa fa-save"></i> 保存</button>
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
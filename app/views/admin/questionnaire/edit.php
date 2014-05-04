<?$this->load->view('admin/header');?>
<!-- BEGIN PAGE LEVEL STYLES --> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/admin/form-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/custom.css" />
<script type="text/javascript">
jQuery(document).ready(function() { 
    editables();
});
function editables()
{
	var questionnaire_id = "<?php echo isset($row)?$row->id:''?>";
	var url = msg.base_url+"admin/questionnaires/update";
	//global settings 
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.inputclass = 'form-control col-md-12';

	//editables element samples 
    $('.edit_field').on('shown', function(e, editable) {
    	var udpate_type =  $(this).attr('parent');
    	if(udpate_type == 'question')
    	{
    		url = msg.base_url+"admin/questionnaires/update" +
    							"/type/"+$(this).attr('qust-type') +
    							"/question_id/"+$(this).attr('data-ques-id')+
    							"/update_type/question";
    	}
    	else if(udpate_type == 'option')
    	{
    		url = msg.base_url+"admin/questionnaires/update"+
    							"/question_id/"+$(this).attr('data-ques-id')+
    							"/option_id/"+$(this).attr('data-otp-id') +
    							"/update_type/option";
    	}
    	else
    	{
    		url = msg.base_url+"admin/questionnaires/update"+
    							"/update_type/qn";
    	}
    	$('.edit_field').editable('option','url', url);
    });

    $('.edit_field').editable({
    	ajaxOptions:{type:'post',dataType:'json'},
        title: '请输入',
        emptytext:'尚未填写',
        params:function(params){
        	params.questionnaire_id = questionnaire_id;
			return params;
        },
        validate: function(value) {
            console.log(value);
		    if($.trim(value) == '') {
		    	return '请输入';
		    }
	    },
	    success: function(json, newValue) {
			if(json.code != '1000') 
			{
				if(typeof(json.error)!='undefined')
					show_error(json.error.title);
				else
					show_error(json.msg);
				return false;
			}

		}
    });

    $('.edit_field').on('hidden', function (e, reason) {
    	var udpate_type =  $(this).attr('parent');

        if (reason === 'cancel') {
        	if(udpate_type == 'question')
	    	{
	    		qn_del($(this).attr('data-pk'));
	    	}
	    	else if(udpate_type == 'option')
	    	{
	    		option_del($(this).attr('data-pk'));
	    	}
        }
    });
}

function qn_del(question_id){
	$.ajax({
        url:msg.base_url+"admin/questionnaires/delete_ques/"+question_id,
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                 $("#question_"+question_id).remove();
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
}

function option_del(option_id){
	$.ajax({
        url:msg.base_url+"admin/questionnaires/delete_option/"+option_id,
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                 $("#li_"+option_id).remove();
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
}

function add_option(question_id,type)
{
	var questionnaire_id = "<?php echo isset($row)?$row->id:''?>";
	$.ajax({
        url:msg.base_url+"admin/questionnaires/update",
        type:'post',
        dataType:'json',
        data:{update_type:'option',name:'title',value:"新选项",questionnaire_id:questionnaire_id,type:type,question_id:question_id},
        success:function(json){
            if(json.code=='1000')
            {
            	if(parseInt(type) == 1)
            		type = "checkbox";
            	else
            		type = "radio";
            	var option = "<li id='li_"+json.row.option_id+"'><input type='"+type+"' name='"+type+json.row.option_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-url='msg.url' data-pk='"+json.row.option_id+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id+"' data-name='title' class='edit_field editable editable-click' href='javascript:void(0);'> 新选项</a><br>"+
								"</label>"+
								"</li>";
                $("#ul_question_"+question_id).append(option);

                editables();
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
	
}

function add_ques(type)
{

	var value = "单选题";
	if(parseInt(type) == 1)
		value = "多选题";
	var questionnaire_id = "<?php echo isset($row)?$row->id:''?>";
	$.ajax({
        url:msg.base_url+"admin/questionnaires/update",
        type:'post',
        dataType:'json',
        data:{update_type:'question',name:'title',value:value,questionnaire_id:questionnaire_id,type:type},
        success:function(json){
            if(json.code=='1000')
            {
                var question =  "<div id='question_"+json.row.questionnaire_question_id+"' class='col-md-12'>"+
									"<div class='topic_type'>"+
                                        "<div class='topic_type_menu'>"+
                                            "<div class='setup-group'>"+
                                                "<h6>问题</h6>"+
                                            "</div>"+
                                        "</div>"+
										"<div class='topic_type_con'>"+
											"<div class='Drag_area'>"+
												"<div name='question' qust-type='"+type+"' data-ques-id='"+json.row.questionnaire_question_id+"' class='th4 T_edit q_title'>"+
												"<a data-original-title='请输入' parent='question' data-pk='"+json.row.questionnaire_question_id+"' data-type='text' data-name='title' class='edit_field editable editable-click' href='#'>"+json.row.ques_title+"</a>"+
											"</div></div>";
				if(parseInt(type) == 1 )
				{
					question = question + "<ul id='ul_question_"+json.row.questionnaire_question_id+"' class='nav margin-top-20'>"+
								"<li id='li_"+json.row.option_id[0]+"'><input type='checkbox' name='checkbox_"+json.row.questionnaire_question_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[0]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[0]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项1</a><br>"+
								"</label>"+
								"</li>"+
								"<li id='li_"+json.row.option_id[1]+"'><input type='checkbox' name='checkbox_"+json.row.questionnaire_question_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[1]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[1]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项2</a><br>"+
								"</label>"+
								"</li>"+
								"<li id='li_"+json.row.option_id[2]+"'><input type='checkbox' name='checkbox_"+json.row.questionnaire_question_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[2]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[2]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项3</a><br>"+
								"</label>"+
								"</li>"+
								"<li id='li_"+json.row.option_id[3]+"'><input type='checkbox' name='checkbox_"+json.row.questionnaire_question_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[3]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[3]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项4</a><br>"+
								"</label>"+
								"</li></ul>";
				}
				else
				{
					question = question + "<ul id='ul_question_"+json.row.questionnaire_question_id+"' class='nav margin-top-20'>"+
								"<li id='li_"+json.row.option_id[0]+"'><input type='radio' name='radio_"+json.row.questionnaire_question_id+"'>"+
								"<label class='T_edit_min' for='' name='option' id=''>"+
								"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[0]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[0]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项1</a><br>"+
								"</label>"+
								"</li>"+
								"<li id='li_"+json.row.option_id[1]+"'><input type='radio' name='radio_"+json.row.questionnaire_question_id+"'>"+
									"<label class='T_edit_min' for='' name='option' id=''>"+
										"<a style='margin-left:5px;' parent='option' data-original-title='请输入' data-pk='"+json.row.option_id[1]+"' data-type='text' data-ques-id='"+json.row.questionnaire_question_id+"' data-otp-id='"+json.row.option_id[1]+"' data-name='title' class='edit_field editable editable-click' href='#'>选项2</a><br>"+
									"</label>"+
								"</li></ul>";
				}				

				question = question + 
								"<div class='add-option margin-top-10'>"+
            						"<a class='btn green' title='添加选项' href='javascript:void(0);' onclick=\"add_option("+json.row.questionnaire_question_id+","+type+")\">添加选项<i class='fa fa-plus'></i></a>"+
            					"</div>"+
							"</div>"+
							"</div>"+
			    		"</div>";
			   $("#question-body").append(question);

			   editables();

               //滑动到新添加的dom
               App.scrollTo($('#question_'+json.row.questionnaire_question_id));
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
}

function qn_save()
{
    location.href=msg.base_url+"admin/questionnaires";
}

function cancel()
{
    location.href=msg.base_url+"admin/questionnaires";
}

function change_status()
{
	$.ajax({
        url:msg.base_url+"admin/questionnaires/change_status/<?php echo isset($row)?$row->id:''?>/1",
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                 location.href=msg.base_url+"admin/questionnaires";
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
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
							<a href="index.html">首页</a> 
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
                <div class="col-md-12">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet box yellow">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i>问卷
                            </div>
                            <div class="tools">
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                            	<div id="question-title" class="row">
                                    <div class="col-md-12">
                                        <div class="topic_type">
                                            <div class="topic_type_menu">
                                                <div class="setup-group">
                                                    <h6>标题</h6>
                                                </div>
                                            </div>
                                            <div class="topic_type_con" style="min-height:50px;">
                                                <div class="Drag_area" >
                                                    <div class="th4 T_edit q_title">
                                                        <a href="#" parent='qn' class="edit_field" data-name="title" data-type="text" data-pk="<?php echo isset($row)?$row->id:''?>" data-original-title="请输入"><?php echo isset($row)?$row->title:''?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            	</div>
                                <div id="question-intro" class="row">
                                    <div class="col-md-12">
                                        <div class="topic_type">
                                            <div class="topic_type_menu">
                                                <div class="setup-group">
                                                    <h6>开头</h6>
                                                </div>
                                            </div>
                                            <div class="topic_type_con" style="min-height:50px;">
                                                <div class="Drag_area" >
                                                    <div class="th4 T_edit q_title">
                                                        <a href="#" parent='qn' class="edit_field" data-name="intro" data-type="textarea" data-pk="<?php echo isset($row)?$row->id:''?>" data-original-title="请输入"><?php echo isset($row)?$row->intro:''?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            	<div id="question-body" class="row">
                            		<?if(isset($question) && $question):?>
                            			<?foreach ($question as $k => $q) :?>
                        			<div class="col-md-12" id="question_<?php echo $q->id?>">
                        				<div class="topic_type">
                                            <div class="topic_type_menu">
                                                <div class="setup-group">
                                                    <h6>问题</h6>
                                                </div>
                                            </div>
											<div class="topic_type_con">
												<div class="Drag_area" >
													<div class="th4 T_edit q_title" data-ques-id="<?php echo $q->id?>" qust-type="<?php echo $q->type?>" name="question">
														<a href="#" parent="question" class="edit_field" data-name="title" data-type="text" data-pk="<?php echo $q->id?>" data-original-title="请输入"><?php echo stripslashes($q->title);?></a>
													</div>
												</div>
												<?if(!empty($q->options)):?>
												<ul id="ul_question_<?php echo $q->id?>" class="nav margin-top-20">
	                                				<?foreach($q->options as $o):?>
	                            						<?if($q->type == 0):?>
	                            						<li id='li_<?php echo $o->id?>'><input type="radio" name="radio_<?php echo $q->id?>">
	                            							<label id="" name="option" for="" class="T_edit_min">
	                            								<a href="#" parent="option" class="edit_field" data-name="title" data-otp-id="<?php echo $o->id?>" data-ques-id="<?php echo $q->id?>" data-type="text" data-pk="<?php echo $o->id;?>" data-original-title="请输入"><?php echo stripslashes($o->title);?></a><br>
	                            							</label>
	                            						</li>
	                            						<?elseif($q->type == 1):?>
	                            						<li id='li_<?php echo $o->id?>'><input type="checkbox" name="checkbox_<?php echo $q->id?>" >
	                            							<label id="" name="option" for="" class="T_edit_min">
	                            								<a href="#" parent="option" class="edit_field" data-name="title" data-otp-id="<?php echo $o->id?>" data-ques-id="<?php echo $q->id?>" data-type="text" data-pk="<?php echo $o->id;?>" data-original-title="请输入"><?php echo stripslashes($o->title);?></a><br>
	                            							</label>
	                            						</li>
	                            						<?endif;?>
													<?endforeach;?>
												</ul>	
	                        					<?endif;?>
	                        					<div class='add-option margin-top-10'>
	                        						<a class="btn green" title='添加选项' href='javascript:void(0);' onclick="add_option(<?php echo $q->id?>,<?php echo $q->type?>)">添加选项<i class='fa fa-plus'></i></a>
	                        					</div>
											</div>
										</div>
                            		</div>
                            			<?endforeach;?>
                            		<?endif;?>
                            	</div>
                                <div id="question-conclusion" class="row">
                                    <div class="col-md-12">
                                        <div class="topic_type">
                                            <div class="topic_type_menu">
                                                <div class="setup-group">
                                                    <h6>结尾</h6>
                                                </div>
                                            </div>
                                            <div class="topic_type_con" style="min-height:50px;">
                                                <div class="Drag_area" >
                                                    <div class="th4 T_edit q_title">
                                                        <a href="#" parent="qn" class="edit_field" data-name="conclusion" data-type="textarea" data-pk="<?php echo isset($row)?$row->id:''?>" data-original-title="请输入"><?php echo isset($row)?$row->conclusion:''?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>

            <div class="form-actions right">
                <button type="button" onclick="qn_save()" class="btn green"><i class="fa fa-save"></i> 保存</button>
                <button type="button" onclick="change_status()" class="btn green"><i class="fa fa-retweet"></i> 发布</button>
                <button type="button" class="btn default" onclick="cancel()">取消</button>
            </div>

            <div id="question_type" style="position:fixed;top:35%;right:20px;margin-right: 10px;">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i>添加问题
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <ul class="list-group">
                                <li class="list-group-item text-center"><a style="text-decoration:none;" onclick="add_ques(0)" href="javascript:void(0)">单选题</a></li>
                                <li class="list-group-item text-center"><a style="text-decoration:none;" onclick="add_ques(1)" href="javascript:void(0)">多选题</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>
	<!-- END PAGE LEVEL PLUGINS -->
<?$this->load->view('admin/footer');?>
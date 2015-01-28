<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						所有会员
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">所有会员</a></li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->


			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue" id='list-box'>
						<div class="portlet-title">
							<div class="caption"><i class="fa fa-list"></i>所有会员</div>
							<div class="actions">
								<div class="btn-group">
									<a href='<?php echo base_url();?>admin/users/edit' class="btn blue m-r-5">
											<i class="fa fa-plus"></i> 新增会员
									</a>
									<a class='btn blue' href="javascript:void(0);" onclick="reload_list('list-box','user_list','admin/users/lists')"><i class='fa fa-refresh'></i></a>
									<a class="btn blue" href="#" data-toggle="dropdown">
									显示/隐藏
									<i class="fa fa-angle-down"></i>
									</a>
									<div id="user_list_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked data-column="0">会员名</label>
										<label><input type="checkbox" checked data-column="1">姓名</label>
										<label><input type="checkbox" checked data-column="2">邮箱</label>
										<label><input type="checkbox" checked data-column="3">等级</label>
										<label><input type="checkbox" checked data-column="4">积分</label>
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<?php echo $list;?>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {
		   initTable('user_list');
		});
		function showResetPassword(id)
		{
		    var html = "<tr id='reset_"+id+"'><td colspan='8'><form id='reset_pwd_form' method='post' action='"+msg.base_url+"admin/users/resetPassword'>"+
		        "<table width='100%'><tbody>"+
		            "<tr id='tr_new_pwd'>"+
		                "<td style='text-align:right' width='38%'>"+
		                    "<label style='margin-right:20px;margin-top:10px'>"+"新密码"+"</label>"+
		                "</td>"+
		                "<td width='30%'>"+
		                    "<input type='password' class='form-control' id='new_pwd' name='new_pwd' value='' maxlength='20'>"+
		                "</td>"+
		                "<td></td>"+
		            "</tr>"+
		            "<tr id='tr_new_pwd_confirmation'>"+
		                "<td style='text-align:right'>"+
		                    "<label style='margin-right:20px;margin-top:10px'>"+"确认密码"+"</label>"+
		                "</td>"+
		                "<td>"+
		                    "<input type='password' class='form-control' id='new_pwd_confirmation' name='new_pwd_confirmation' value='' maxlength='20'>"+
		                "</td>"+
		            "</tr>"+
		            "<tr>"+
		                "<td>"+
		                    "<label style='margin-right:10px;'></label>"+
		                "</td>"+
		                "<td>"+
		                    "<button class='btn green' type='button' onclick='resetPassword()' id='reset_edit_btn'>"+"确认"+"</button>&nbsp;"+
		                    "<button class='btn default' type='button' onclick='removeNode()'>"+"取消"+"</button>"+
		                    "<input type='hidden' id='reset_user_id' name='reset_user_id' value='"+id+"'>"+
		                "</td>"+
		            "</tr>"+
		        "</tbody></table>"+
		        "</form></td></tr>";

		    if($('#reset_'+id).length>0)
		    {
		        $('#reset_'+id).remove();
		    }
		    else
		    {
		        removeNode()
		        $('#'+id).after(html);
		    }
		    return false;
		}

		function resetPassword()
		{
		    $('#reset_pwd_form').ajaxForm({
		        dataType:'json',
		        beforeSend:function(){
		            $('#reset_edit_btn').attr('disabled',true);
		            $('.pwd_alert').remove();
		            loading();
		        },
		        success:function(json){
		            close_alert();
		            $('#reset_edit_btn').attr('disabled', false);
		            if(json.code=='1000')
		            {
		                show_success();
		                removeNode()
		            }
		            else if(json.code=='1002')
		            {
		                show_login(json);
		            }
		            else
		            {
		                if(typeof(json.error)!='undefined')
		                {
		                    $.each(json.error,function(key,item){
		                        var tips="";
		                        for(var i=0;i<item.length;i++){
		                            tips=tips+"&nbsp;"+item[i];
		                        }
		                        if($('input[name='+key+']').length>0 && tips!=''){
		                            $('#tr_'+key).after("<tr class='pwd_alert'><td></td><td><span class='req'>"+tips+"</span></td><td></td></tr>");
		                            $('input[name='+key+']').focus();
		                        }
		                    })
		                }
		                else if(typeof(json.msg)!='undefined')
		                {
		                    show_error(json.msg);
		                }
		            }
		        },
		        error:function(err){
		            $('#reset_edit_btn').attr('disabled',true);
		            show_error();
		        }
		    })
		    $('#reset_pwd_form').submit();
		}

		function removeNode()
		{
		    $('tr[id^=reset_]').remove();
		}

		function showAssignRole(id)
		{
			var role_html = "";
			$.ajax({
		        url:msg.base_url+"admin/roles/all_role",
		        data:{"id":id},
		        type:'post',
		        dataType:'json',
		        success:function(json){
		            if(json.code=='1000')
		            {
		            	if(typeof(json.list) != "undefined")
		            	{
		            		$.each(json.list,function(i,n){
		            			if(typeof(n.check) != "undefined")
		            				var role = "<input type='radio' name='role_id' checked='true' value='"+n.id+"'/>"+n.name+"&nbsp;&nbsp;&nbsp;&nbsp;";
		            			else
		            				var role = "<input type='radio' name='role_id' value='"+n.id+"'/>"+n.name+"&nbsp;&nbsp;&nbsp;&nbsp;";
		            			role_html = role_html + role;
		            		});
		            		var html = "<tr id='reset_"+id+"'><td colspan='8'><form id='assign_role_form' method='post' action='"+msg.base_url+"admin/roles/assign_role'>"+
								        "<table width='100%'><tbody>"+
								            "<tr id='tr_new_pwd'>"+
								                "<td style='text-align:right' width='38%'>"+
								                    "<label style='margin-right:20px;margin-top:10px'>"+"角色"+"</label>"+
								                "</td>"+
								                "<td width='50%'>"+
								                    role_html+
								                "</td>"+
								                "<td></td>"+
								            "</tr>"+
								            "<tr>"+
								                "<td>"+
								                    "<label style='margin-right:10px;'></label>"+
								                "</td>"+
								                "<td>"+
								                    "<button class='btn green' type='button' onclick='assign_role_submit()' id='assign_role_btn'>"+"确认"+"</button>&nbsp;"+
								                    "<button class='btn default' type='button' onclick='removeNode()'>"+"取消"+"</button>"+
								                    "<input type='hidden' id='user_id' name='user_id' value='"+id+"'>"+
								                "</td>"+
								            "</tr>"+
								        "</tbody></table>"+
								        "</form></td></tr>";
							if($('#reset_'+id).length>0)
						    {
						        $('#reset_'+id).remove();
						    }
						    else
						    {
						        removeNode()
						        $('#'+id).after(html);
						    }
						    return false;
		            	}
		            }
		            else
		            {
		                show_error(json.msg);
		            }
		        }
		    });
		}

		function assign_role_submit()
		{
			$('#assign_role_form').ajaxForm({
		        dataType:'json',
		        beforeSend:function(){
		            $('#assign_role_btn').attr('disabled',true);
		            $('.pwd_alert').remove();
		            loading();
		        },
		        success:function(json){
		            close_alert();
		            $('#assign_role_btn').attr('disabled', false);
		            if(json.code=='1000')
		            {
		                show_success();
		                removeNode()
		            }
		            else if(json.code=='1002')
		            {
		                show_login(json);
		            }
		            else
		            {
		                if(typeof(json.msg)!='undefined')
		                {
		                    show_error(json.msg);
		                }
		            }
		        },
		        error:function(err){
		            $('#assign_role_btn').attr('disabled',true);
		            show_error();
		        }
		    })
		    $('#assign_role_form').submit();
		}
	</script>
<?$this->load->view('admin/footer');?>
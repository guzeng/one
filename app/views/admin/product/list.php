<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						所有商品
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li><a href="#">所有商品</a></li>
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
							<div class="caption"><i class="fa fa-list"></i>所有商品</div>
							<div class="actions">
								<div class="btn-group">
									<a href='<?php echo base_url();?>admin/products/edit' class="btn blue m-r-5">
											<i class="fa fa-plus"></i> 新增商品
									</a>
									<a class='btn blue' href="javascript:void(0);" onclick="reload_list('list-box','product_list','admin/products/lists')"><i class='fa fa-refresh'></i></a>
									<a class="btn blue" href="#" data-toggle="dropdown">
									显示/隐藏
									<i class="fa fa-angle-down"></i>
									</a>
									<div id="product_list_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox" checked data-column="1">编码</label>
										<label><input type="checkbox" checked data-column="2">名称</label>
										<label><input type="checkbox" checked data-column="3">价格</label>
										<label><input type="checkbox" checked data-column="4">优惠价</label>
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle blue" data-toggle="dropdown">
									 批量分类
									<i class="fa fa-angle-down"></i>
									</button>
									
									<ul class="dropdown-menu pull-left" style="padding-bottom:10px">
										<li>
											<div id="cate_list_div" class="" style="width:400px;;display: block;">
												<ul class="select2-results">
													<?if(isset($category_list) && !empty($category_list)): ?>
					                                    <?foreach($category_list as $item):?>
					                                        <?if($item['hasChild']):?>
					                                        <li style="margin-top:20px;margin-left:<?=$item['deep']*30?>px">
																<input id="checkbox_<?=$item['id']?>" type="checkbox" style='margin: 5px 5px 0 0;' value="<?=$item['id']?>" id="status" name='status' > 
																<strong><?=stripslashes($item['name']) ?></strong>
															</li>
															<?else:?>
															<li style="margin-top:10px;margin-left:<?=$item['deep']*30?>px">
																<div class="checkbox-list">
																	<label class="checkbox-inline">
																		<input id="checkbox_<?=$item['id']?>" type="checkbox" style='margin: 5px 5px 0 0;' value="<?=$item['id']?>" id="status" name='status' > 
																		<span style="padding-left:20px"><?=stripslashes($item['name']) ?></span>
																	</label>
																</div>
															</li>
					                                        <?endif;?>
					                                    <?endforeach;?>
					                                <?else:?>
					                                    <li class="">
															<strong>暂无商品分类数据</strong>
														</li>
					                                <?endif?> 
					                            </ul>
					                        </div>
										</li>
									</ul>

									<button id="up_jia" type="button" class="btn blue" style="margin-left:15px;">
									 批量上架
									</button>

									<button id="down_jia" type="button" class="btn blue" style="margin-left:15px;">
									 批量下架
									</button>

									<button id="export_product" type="button" onclick="export_product()" class="btn blue" style="margin-left:15px;">
									 批量导出
									</button>
								</div>
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
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {
		   initTable('product_list');
		   jQuery('#product_list .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");

                jQuery(set).each(function () {
                    if (checked) {
                        $(this).prop("checked", true);
                    } else {
                        $(this).prop("checked", false);
                    }
                });
            });
		   //商品批量上架
		   $("#up_jia").click(function(){
		   		//选中的商品ID
				var ids = new Array();
				var status = 1;
				$('#product_list .checkboxes').each(function(){
					if($(this).attr('class') != 'group-checkable'){
						if ($(this).is(":checked")) {
                       		 ids.push($(this).val());
                    	} 
					}
				});
				if(ids.length<=0)
				{
					show_error("请选择要批量上架的商品");
					return;
				}
				$.ajax({
			        url:msg.base_url+"admin/products/bath_update_status",
			        type:'post',
			        data:{'ids':ids,'status':status},
			        dataType:'json',
			        success:function(json){
			            if(json.code=='1000')
			            {
			                show_success(json.msg);
			                $("#product_list input[type='checkbox']").prop("checked",false);
			                var sta = status == 1 ? 0 : 1;
			            	var sta_title = status == 1 ? "下架" : "上架";
			            	var sta_class = status == 1 ? "danger" : "success";

			            	for(key in ids){
			            		var html = "<a id='product_td_a_"+ids[key]+"' href='javascript:void(0)' onclick='changeStatus(this,"+ids[key]+","+sta+")' >"
			            				+"<span class='label label-"+sta_class+"'>"+sta_title+"</span></a>";
			            		var parent_obj = $("#product_td_a_"+ids[key]).parent();
			            		$("#product_td_a_"+ids[key]).remove();
			            		parent_obj.append(html);
			            	}
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
		   });
		   //商品批量下架
		   $("#down_jia").click(function(){
		   		//选中的商品ID
				var ids = new Array();
				var status = 0;
				$('#product_list .checkboxes').each(function(){
					if($(this).attr('class') != 'group-checkable'){
						if ($(this).is(":checked")) {
                       		 ids.push($(this).val());
                    	} 
					}
				});
				if(ids.length<=0)
				{
					show_error("请选择要批量下架的商品");
					return;
				}
				$.ajax({
			        url:msg.base_url+"admin/products/bath_update_status",
			        type:'post',
			        data:{'ids':ids,'status':status},
			        dataType:'json',
			        success:function(json){
			            if(json.code=='1000')
			            {
			                show_success(json.msg);
			                $("#product_list input[type='checkbox']").prop("checked",false);
			                var sta = status == 1 ? 0 : 1;
			            	var sta_title = status == 1 ? "下架" : "上架";
			            	var sta_class = status == 1 ? "danger" : "success";

			            	for(key in ids){
			            		var html = "<a id='product_td_a_"+ids[key]+"' href='javascript:void(0)' onclick='changeStatus(this,"+ids[key]+","+sta+")' >"
			            				+"<span class='label label-"+sta_class+"'>"+sta_title+"</span></a>";
			            		var parent_obj = $("#product_td_a_"+ids[key]).parent();
			            		$("#product_td_a_"+ids[key]).remove();
			            		parent_obj.append(html);
			            	}
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
		   });
		   //商品分类点击事件
		   $("#cate_list_div input[type='checkbox']").click(function(e){
				var category_id = $(this).val();	//商品分类ID
				//选中的商品ID
				var ids = new Array();
				$('#product_list .checkboxes').each(function(){
					if($(this).attr('class') != 'group-checkable'){
						if ($(this).is(":checked")) {
                       		 ids.push($(this).val());
                    	} 
					}
				});
				if(ids.length<=0)
				{
					show_error("请选择要批量分类的商品");
					$("#cate_list_div input[type='checkbox']").prop("checked",false);
					return;
				}
				if(!category_id)
				{
					return;
				}
				$.ajax({
			        url:msg.base_url+"admin/products/update_product_category/"+category_id,
			        type:'post',
			        data:{'ids':ids},
			        dataType:'json',
			        success:function(json){
			            if(json.code=='1000')
			            {
			                 show_success(json.msg);
			                 $("#product_list input[type='checkbox']").prop("checked",false);
			                 $("#cate_list_div input[type='checkbox']").prop("checked",false);
			            }
			            else if(json.code=='1002')
			            {
			                show_login();
			                $("#cate_list_div input[type='checkbox']").prop("checked",false);
			            }
			            else
			            {
			                show_error(json.msg);
			                $("#cate_list_div input[type='checkbox']").prop("checked",false);
			            }
			        }
			    });
		   });
		});
		
		function changeStatus(obj,product_id,status)
		{
			if(!product_id)
			{
				return;
			}
			$.ajax({
		        url:msg.base_url+"admin/products/change_status/"+product_id,
		        type:'post',
		        data:{'status':status},
		        dataType:'json',
		        success:function(json){
		            if(json.code=='1000')
		            {
		            	var sta = status == 1 ? 0 : 1;
		            	var sta_title = status == 1 ? "下架" : "上架";
		            	var sta_class = status == 1 ? "danger" : "success";

		            	var html = "<a id='product_td_a_"+product_id+"' href='javascript:void(0)' onclick='changeStatus(this,"+product_id+","+sta+")' >"
		            				+"<span class='label label-"+sta_class+"'>"+sta_title+"</span></a>";
		            	$(obj).parent().append(html);
		            	$(obj).remove();
		                show_success(json.msg);
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

	function export_product()
	{
		var keyword = $("#product_list_filter").find("input").val();
		if(keyword)
		{
			keyword="/"+keyword;
		}
		window.open(msg.base_url+"admin/products/export_product"+keyword);
	}
	</script>
<?$this->load->view('admin/footer');?>
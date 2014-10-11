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
	</script>
<?$this->load->view('admin/footer');?>
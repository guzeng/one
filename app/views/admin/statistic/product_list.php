<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				商品统计
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url()?>">首页</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">统计管理</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li><a href="#">商品统计</a></li>
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
							<a class='btn blue' href="javascript:void(0);" onclick="reload_list('list-box','product_list','admin/products/lists')"><i class='fa fa-refresh'></i></a>
							<a class="btn blue" href="#" data-toggle="dropdown">
							显示/隐藏
							<i class="fa fa-angle-down"></i>
							</a>
							<div id="product_list_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
								<label><input type="checkbox" checked data-column="1">图片</label>
								<label><input type="checkbox" checked data-column="2">编码</label>
								<label><input type="checkbox" checked data-column="3">名称</label>
								<label><input type="checkbox" checked data-column="4">价格/优惠价</label>
								<label><input type="checkbox" checked data-column="5">库存</label>
								<label><input type="checkbox" checked data-column="6">销量</label>
								<label><input type="checkbox" checked data-column="7">浏览量</label>
								<label><input type="checkbox" checked data-column="8">购买率</label>
								<label><input type="checkbox" checked data-column="9">特性</label>
							</div>
						</div>
					</div>
				</div>
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown">库存低于<?php echo isset($stock)?$stock:''?> <i class="fa fa-angle-down"></i></button>
							<ul class="dropdown-menu pull-right">
								<li><a href="javascript:void(0)" class='stock'>5</a></li>
								<li><a href="javascript:void(0)" class='stock'>10</a></li>
								<li><a href="javascript:void(0)" class='stock'>20</a></li>
								<li><a href="javascript:void(0)" class='stock'>50</a></li>
								<li><a href="javascript:void(0)" class='stock'>100</a></li>
							</ul>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover" id="product_list">
						<thead>
							<tr>
								<th style="width1:8px;"><input type="checkbox" class="group-checkable" data-set="#product_list .checkboxes" /></th>
								<th>图片</th>
								<th>编码</th>
								<th>名称</th>
								<th>价格/优惠价</th>
								<th>库存</th>
								<th>销量</th>
								<th>浏览量</th>
								<th>购买率</th>
								<th>特性</th>
							</tr>
						</thead>
						<tbody>
							<?if(!empty($list)):?>
							<?foreach($list as $key => $item):?>
							<tr id='<?php echo $item->id;?>'>
								<td><input type="checkbox" class="checkboxes" value="<?php echo $item->id;?>" /></td>
					    		<td><img src="<?php echo $this->product->pic($item->id,1,'thumb')?>"></td>
					    		<td><?php echo $item->code?></td>
					    		<td><?php echo $item->name?></td>
					    		<td><?php echo $item->price.'/'.$item->best_price?></td>
					    		<td><?php echo $item->amount;?></td>
					    		<td><?php echo $item->sale_num;?></td>
					    		<td><?php echo $item->view_num;?></td>
    							<td><?php echo ($item->view_num>0?round($item->sale_num*100/$item->view_num,2):'0').'%';?></td>
					    		<td>
					    			<?php if($item->recommend==1):?><div>推荐</div><?php endif;?>
					    			<?php if($item->specials==1):?><div>特卖</div><?php endif;?>
					    			<?php if($item->allow_comment==1):?><div>允许评论</div><?php endif;?> 
					    			<?php if($item->show_home==1):?><div>首页显示</div><?php endif;?>
					    			<?php if($item->handpick==1):?><div>精选商品</div><?php endif;?>
					    			<?php if($item->hot==1):?><div>热卖</div><?php endif;?>
					    		</td>
							</tr>
							<?endforeach;?>
							<?endif;?>
						</tbody>
					</table>
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
		});
		$('.stock').click(function(){
			var num = parseInt($(this).html());
			window.location.href = msg.base_url+"admin/statistic/product/stock/"+num;
		})
	</script>
<?$this->load->view('admin/footer');?>
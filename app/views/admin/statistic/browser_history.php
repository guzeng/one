<?$this->load->view('admin/header');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
	<!-- END PAGE LEVEL STYLES -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
						浏览记录
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">统计管理</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>浏览记录</li>
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
							<div class="caption"><i class="fa fa-list"></i>浏览记录</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
							</div>
							<table class="table table-striped table-bordered table-hover" id="browser_history_list">
								<thead>
									<tr>
										<th width='20%'>用户名</th>
										<th width='*'>浏览的商品</th>
										<th width='20%'>浏览时间</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->total?></td>
                                		<td><?php echo $item->product_name?></td>
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
	<script >
		jQuery(document).ready(function() {
  
		    if (!jQuery().dataTable) {
		        return;
		    }
		    // begin first table
		    nTable = $('#browser_history_list').dataTable({
		        //"sDom" : "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", //default layout without horizontal scroll(remove this setting to enable horizontal scroll for the table)
		        "aLengthMenu": [
		            [10, 25, 50, 100],
		            [10, 25, 50, 100] // change per page values here
		        ],
		        "bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": msg.base_url+"admin/statistic/browser_datalist/",
		        // set the initial value
		        "iDisplayLength": 10,
		        "sPaginationType": "bootstrap",
		        "bDestroy":true,
		        "oLanguage": msg.dataTableLang,
		        "aaSorting": [[0,'desc']], //排序功能
		        "bSortClasses":false,
		        "aoColumnDefs": [],
		        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
		            $(nRow).attr('id',aData[0]);
		        } 
		    });
		    initDataTableAction('browser_history_list',nTable);

		});
	</script>    
<?$this->load->view('admin/footer');?>
<?$this->load->view('admin/header');?>
	<!-- END PAGE LEVEL STYLES -->
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				访问统计
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
				<li><a href="#">访问统计</a></li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->

	<!-- BEGIN PAGE CONTENT-->

	<div class="row">
		<iframe id='main' src="http://tongji.baidu.com/web/8157818/overview/sole?siteId=6114520" style='width:100%;' height="300" frameborder="0" scrolling="auto"></iframe>
	</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	var mainheight = $("body").height()+30;
	console.log(mainheight);
	$("#main").height(mainheight);	
});
</script>
<?$this->load->view('admin/footer');?>
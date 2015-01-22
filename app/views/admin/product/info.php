<?$this->load->view('admin/header');?>
	<!-- BEGIN PAGE HEADER-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				商品信息
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url()?>">首页</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">所有商品</a>
					<?if(isset($row)):?>
					<i class="fa fa-angle-right"></i>
					<?endif;?>
				</li>
				<?if(isset($row)):?>
				<li>
					<?php echo $row->name;?>
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
                    <div class="caption"><i class="fa fa-list"></i>图片</div>
                    <div class="tools">
						<a class="collapse" href=""></a>
					</div>
                </div>
				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<div class='row'>
						<div class='col-md-12'>     
                            <img src="<?php echo $this->product->pic((isset($row)&&$row->id>0)?$row->id:'',1,'thumb')?>" class='product-pic-upload'>
                            <img src="<?php echo $this->product->pic((isset($row)&&$row->id>0)?$row->id:'',2,'thumb')?>" class='product-pic-upload'>
                            <img src="<?php echo $this->product->pic((isset($row)&&$row->id>0)?$row->id:'',3,'thumb')?>" class='product-pic-upload'>
                            <img src="<?php echo $this->product->pic((isset($row)&&$row->id>0)?$row->id:'',4,'thumb')?>" class='product-pic-upload'>
                            <img src="<?php echo $this->product->pic((isset($row)&&$row->id>0)?$row->id:'',5,'thumb')?>" class='product-pic-upload'> 
						</div>
					</div>
					<!-- END FORM--> 
				</div>
			</div>
		</div>
	</div>
	<!-- 参数 -->
	<div class="row">
		<div class="col-md-12" id="">
			<div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list"></i>商品参数</div>
                    <div class="tools">
						<a class="collapse" href=""></a>
					</div>
                </div>
				<div class="portlet-body">
					<!-- BEGIN FORM-->
					<div class='row'>
						<div class='col-md-3 m-b-10'>
							编码：<?php echo $row->code?>
						</div>
						<div class='col-md-3'>
							名称：<?php echo $row->name?>
						</div>
						<div class='col-md-3'>
							价格：<?php echo $row->price?>
						</div>
						<div class='col-md-3'>
							优惠价：<?php echo $row->best_price?>
						</div>
					</div>
					<div class='row m-b-10'>
						<div class='col-md-3'>
							销量：<?php echo $row->sale_num?>
						</div>
						<div class='col-md-3'>
							库存：<?php echo isset($row)?$row->amount:''?>
						</div>
						<div class='col-md-3'>
							类型：<?php echo isset($type->name)?$type->name:'';?>
						</div>
						<div class='col-md-3'>
							品牌：<?php echo isset($brand->name)?$brand->name:'';?>
						</div>
					</div>
					<div class='row m-b-10'>
						<div class='col-md-3'>
							类别：<?php echo isset($cate->name)?$cate->name:'';?> > 
							<?if(!empty($cates)):?>
							<?php foreach($cates as $key => $value):?>
							<?php echo $value->name;?>
							<?php endforeach;?>
							<?php endif;?>
						</div>
						<div class='col-md-3'>
							计量单位：<?php echo isset($row)?$row->unit:''?>
						</div>
						<div class='col-md-3'>
							单位重量：<?php echo isset($row)?$row->weight:''?>
						</div>
						<div class='col-md-3'>
							最低购买：<?php echo isset($row)?$row->min_num:''?>
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							积分：<?php echo isset($row)?$row->score:''?>
						</div>
						<div class='col-md-3'>
							状态：<?php echo isset($row)&&$row->status==1?'已发布':'未发布';?>
						</div>
						<div class='col-md-3'>
						</div>
						<div class='col-md-3'>
						</div>
					</div>
					<!-- END FORM--> 
				</div>
			</div>
		</div>
	</div> 
	<!-- 参数 end--> 
	<!-- 特性 -->
	<div class="row">
		<div class="col-md-12" id="">
			<div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list"></i>特性</div>
                    <div class="tools">
						<a class="collapse" href=""></a>
					</div>
                </div>
				<div class="portlet-body">
					<?php echo isset($row)&&$row->recommend==1?"<span class='m-r-10'>推荐</span>":''?> 
					<?php echo isset($row)&&$row->specials==1?"<span class='m-r-10'>特价</span>":''?>
					<?php echo isset($row)&&$row->hot==1?"<span class='m-r-10'>热卖</span>":''?>
					<?php echo isset($row)&&$row->allow_comment==1?"<span class='m-r-10'>允许评论</span>":''?>
					<?php echo isset($row)&&$row->show_home==1?"<span class='m-r-10'>首页展示</span>":''?>
					<?php echo isset($row)&&$row->handpick==1?"<span class='m-r-10'>每日精选</span>":''?>
				</div>
			</div>
		</div>
	</div>
	<!-- 特性 end -->
	<!-- 简介 -->
	<div class="row">
		<div class="col-md-12" id="">
			<div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list"></i>简介</div>
                    <div class="tools">
						<a class="collapse" href=""></a>
					</div>
                </div>
				<div class="portlet-body">
					<?php echo isset($row)?$row->info:''?>
				</div>
			</div>
		</div>
	</div>
	<!-- 简介 end -->
	<!-- 简介 -->
	<div class="row">
		<div class="col-md-12" id="">
			<div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list"></i>服务承诺</div>
                    <div class="tools">
						<a class="collapse" href=""></a>
					</div>
                </div>
				<div class="portlet-body">
					<?php echo isset($row)?$row->promise:''?>
				</div>
			</div>
		</div>
	</div>
	<!-- 简介 end -->
<?$this->load->view('admin/footer');?>
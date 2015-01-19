
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
			<th></th>
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
    		<td><?php echo round($item->sale_num*100/$item->view_num,2).'%';?></td>
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
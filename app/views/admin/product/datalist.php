
							<table class="table table-striped table-bordered table-hover" id="product_list">
								<thead>
									<tr>
										<th style="width1:8px;"><input type="checkbox" class="group-checkable" data-set="#product_list .checkboxes" /></th>
										<th>图片</th>
										<th>编码</th>
										<th>名称</th>
										<th>价格</th>
										<th class="hidden-xs">优惠价</th>
										<th class='hidden-xs'>特性</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
										<td><input type="checkbox" class="checkboxes" value="<?php echo $item->id;?>" /></td>
                                		<td>
                                			<a href="<?php echo base_url().'admin/products/info/'.$item->id?>">
                                				<img src="<?php echo $this->product->pic($item->id,1,'thumb')?>">
                                			</a>
                                		</td>
                                		<td><?php echo $item->code?></td>
                                		<td>
                                			<a href="<?php echo base_url().'admin/products/info/'.$item->id?>">
                                				<?php echo $item->name?>
                                			</a>
                                		</td>
                                		<td><?php echo $item->price?></td>
                                		<td class='hidden-xs'><?php echo $item->best_price?></td>
							    		<td class='hidden-xs'>
							    			<?php if($item->recommend==1):?><div>推荐</div><?php endif;?>
							    			<?php if($item->specials==1):?><div>特卖</div><?php endif;?>
							    			<?php if($item->allow_comment==1):?><div>允许评论</div><?php endif;?> 
							    			<?php if($item->show_home==1):?><div>首页显示</div><?php endif;?>
							    			<?php if($item->handpick==1):?><div>精选商品</div><?php endif;?>
							    			<?php if($item->hot==1):?><div>热卖</div><?php endif;?>
							    		</td>
										<td class='hidden-xs'>
											<a href="<?php echo base_url();?>admin/products/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/products/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
											<?php if(isset($item->status)&&$item->status == 1):?>
											<a id="product_td_a_<?php echo $item->id;?>" href="javascript:void(0)" onclick="changeStatus(this,<?php echo $item->id?>,0)">
												<span class='label label-danger'>下架</span></a>
											<?else:?>
											<a id="product_td_a_<?php echo $item->id;?>" href="javascript:void(0)" onclick="changeStatus(this,<?php echo $item->id?>,1)">
												<span class='label label-success'>上架</span></a>
											<?endif;?>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
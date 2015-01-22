
							<table class="table table-striped table-bordered table-hover" id="product_recycle_list">
								<thead>
									<tr>
										<th>编码</th>
										<th>名称</th>
										<th>价格</th>
										<th class="hidden-xs">优惠价</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->code?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->price?></td>
                                		<td><?php echo $item->best_price?></td>
										<td>
											<!-- <a href="<?php echo base_url();?>admin/products/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> -->
											<a title="还原" href="javascript:void(0)" onclick="confirm_dialog('还原商品确认','确认还原改商品吗？',Delete,'admin/recycle/reagin/'+<?php echo $item->id?>)">
												<span class='label label-success'><i class='fa fa-exchange'></i></span></a>
<!-- 											<a title="彻底删除" href="javascript:void(0)" onclick="confirm_dialog('删除确认','确认彻底删除商品吗？',Delete,'admin/recycle/delete/'+<?php //echo $item->id?>)">
												<span class='label label-success'><i class='fa fa-exchange'></i></span></a> -->
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
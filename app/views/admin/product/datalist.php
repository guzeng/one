
							<table class="table table-striped table-bordered table-hover" id="product_list">
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
											<a href="<?php echo base_url();?>admin/products/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/products/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
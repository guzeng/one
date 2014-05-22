
							<table class="table table-striped table-bordered table-hover" id="order_list">
								<thead>
									<tr>
										<th>订单号</th>
										<th>用户</th>
										<th>总价</th>
										<th>状态</th>
										<th>时间</th>
										<th>电话</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->code?></td>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->price?></td>
                                		<td><?php echo date('Y-m-d H:i:s',$item->create_time)?></td>
                                		<td><?php echo $item->phone?></td>
										<td>
											<a href="<?php echo base_url();?>admin/orders/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
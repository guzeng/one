
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
                                		<td><a href="javascript:void(0)" onclick="load_modal('admin/orders/info/<?php echo $item->id?>')">
                                			<?php echo $item->code?></a>
                                		</td>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->price?></td>
                                		<td id='<?php echo $item->id;?>_status'><?php echo $this->order->status($item->status);?></td>
                                		<td><?php echo date('Y-m-d H:i:s',$item->create_time)?></td>
                                		<td><?php echo $item->phone?></td>
										<td id='<?php echo $item->id;?>_operate'>
											<?php if($item->status==0):?>
											<a href="javascript:void(0)" onclick="_cancel('<?php echo $item->id?>')" id='<?php echo $item->id;?>_cancel'>
												<span class='label label-danger'><i class='fa fa-trash-o'></i></span>
											</a> 
											<?php endif;?>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/admin/order.js"></script>
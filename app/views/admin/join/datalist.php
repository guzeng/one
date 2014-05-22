
							<table class="table table-striped table-bordered table-hover" id="order_list">
								<thead>
									<tr>
										<th>类型</th>
										<th>供应商</th>
										<th>联系人</th>
										<th>电话</th>
										<th>Email</th>
										<th>提交时间</th>
										<th>状态</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $this->join->type($item->type)?></td>
                                		<td><?php echo $item->company?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->phone?></td>
                                		<td><?php echo $item->email?></td>
                                		<td><?php echo date('Y-m-d H:i:s',$item->create_time)?></td>
                                		<td><?php echo $this->join->status($item->status)?></td>
										<td>
											<a href="<?php echo base_url();?>admin/joins/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="<?php echo base_url();?>admin/joins/info/<?php echo $item->id?>">
												<span class='label label-info'><i class='fa fa-info'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
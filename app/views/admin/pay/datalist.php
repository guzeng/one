
							<table class="table table-striped table-bordered table-hover" id="ship_list">
								<thead>
									<tr>
										<th width='20%'>名称</th>
										<th width='*'>APIKEY</th>
										<th width='15%'>操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->apikey?></td>
										<td>
											<a href="<?php echo base_url();?>admin/pay_type/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
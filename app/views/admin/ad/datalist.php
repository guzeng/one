
							<table class="table table-striped table-bordered table-hover" id="ad_list">
								<thead>
									<tr>
										<th>标题</th>
										<th>链接地址</th>
										<th>开始时间</th>
										<th>结束时间</th>
										<th class="hidden-xs">操作</th>
										<th class='hide'></th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td class='hide'><?php echo $item->id?></td>
                                		<td><?php echo $item->title?></td>
                                		<td><?php echo $item->url?></td>
                                		<td><?php echo $item->start_time?date('Y-m-d',$item->start_time):'没有期限';?></td>
                                		<td><?php echo $item->end_time?date('Y-m-d',$item->end_time):'没有期限';?></td>
										<td class="hidden-xs">
											<a href="<?php echo base_url();?>admin/ads/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/ads/delete/<?php echo $item->id?>')">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
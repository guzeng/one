
							<table class="table table-striped table-bordered table-hover" id="comment_list">
								<thead>
									<tr>
										<th width='10%'>用户</th>
										<th width='*'>商品名称</th>
										<th width='10%'>评分</th>
										<th width='10%'>时间</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->rate?></td>
                                		<td><?php echo date('Y-m-d',$item->create_time)?></td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
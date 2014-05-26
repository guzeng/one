
							<table class="table table-striped table-bordered table-hover" id="user_comment_list">
								<thead>
									<tr>
										<th>会员名</th>
										<th>留言</th>
										<th>留言时间</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->username?></td>
                                		<td>内容：<?php echo $item->content?><?if(isset($item->reversion) && $item->reversion):?><br/>回复：<?php echo $item->reversion;?><?endif;?></td>
                                		<td><?php echo date('Y-m-d',$item->create_time)?></td>
										<td class="hidden-xs">
											<a href="<?php echo base_url();?>admin/user_comments/edit/<?php echo $item->id?>" title="回复">
												<span class='label label-warning'><i class='fa fa-bullhorn'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/user_comments/delete/'+<?php echo $item->id?>)" title="删除">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
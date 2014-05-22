
							<table class="table table-striped table-bordered table-hover" id="user_list">
								<thead>
									<tr>
										<th>会员名</th>
										<th>姓名</th>
										<th>等级</th>
										<th>积分</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->grade?></td>
                                		<td><?php echo $item->score?></td>
										<td class="hidden-xs">
											<a href="<?php echo base_url();?>admin/users/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/users/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
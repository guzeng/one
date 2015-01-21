
							<table class="table table-striped table-bordered table-hover" id="provider_list">
								<thead>
									<tr>
										<th width='*'>名称</th>
										<th width='*'>联系人</th>
										<th width='*'>联系电话</th>
										<th width='10%'>操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->name?></td>
                                		<td><?php echo $item->contact?></td>
                                		<td><?php echo $item->phone?></td>
										<td>
											<a href="<?php echo base_url();?>admin/providers/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/providers/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
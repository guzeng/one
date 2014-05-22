
							<table class="table table-striped table-bordered table-hover" id="link_list">
								<thead>
									<tr>
										<th>标题</th>
										<th>图片</th>
										<th>链接地址</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->title?></td>
                                		<td><?php echo $item->img?></td>
                                		<td><?php echo $item->url?></td>
										<td class="hidden-xs">
											<a href="<?php echo base_url();?>admin/links/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('<?php echo base_url();?>admin/links/delete/<?php echo $item->id?>')">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
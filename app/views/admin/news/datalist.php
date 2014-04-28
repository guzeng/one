
							<table class="table table-striped table-bordered table-hover" id="news_list">
								<thead>
									<tr>
										<th>标题</th>
										<th>状态</th>
										<th class="hidden-xs">创建时间</th>
										<th class="hidden-xs">发布时间</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->title?></td>
                                		<td><?php echo $item->status?></td>
                                		<td><?php echo date('Y-m-d',$item->create_time)?></td>
                                		<td><?php echo $item->show_time==0 ? date('Y-m-d',$item->create_time) : date('Y-m-d',$item->show_time)?></td>
										<td>
											<a href="<?php echo base_url();?>admin/news/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<a href="javascript:void(0)" onclick="doDelete('admin/news/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
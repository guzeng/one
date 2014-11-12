
							<table class="table table-striped table-bordered table-hover" id="news_list">
								<thead>
									<tr>
										<th>编号</th>
										<th>类别</th>
										<th>面值</th>
										<th class="hidden-xs">消费条件</th>
										<th class="hidden-xs">有效期</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><?php echo $item->code?></td>
                                		<td><?php echo $item->type == 1?'购物赠':'商家赠';?></td>
                                		<td><?php echo $item->value?></td>
                                		<td><?php echo isset($item->use) && $item->use ? "满".$item->use : "不限条件"?></td>
                                		<td class="hidden-xs"><?php echo date('Y-m-d h:m:s',$item->expirse_from)."  至  ".date('Y-m-d h:m:s',$item->expirse_to)?></td>
										<td class="hidden-xs">
											<a href="<?php echo base_url();?>admin/coupons/edit/<?php echo $item->id?>">
												<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
											<!-- <a href="javascript:void(0)" onclick="doDelete('admin/coupons/delete/'+<?php echo $item->id?>)">
												<span class='label label-danger'><i class='fa fa-times'></i></span></a> -->
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
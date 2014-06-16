
							<table class="table table-striped table-bordered table-hover dataTable" id="category_list">
								<thead>
									<tr>
										<th class='hide'></th>
										<th>名称</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
                            		

                            		<?php if(isset($tree) && !empty($tree)): ?>
	                                    <?foreach($tree as $key => $item):?>
	                                    <tr id="add_new_childNode_<?=$item['id'] ?>" name="<?=$item['id'] ?>" class="parent_<?=$item['parent_id']?>" parent='<?=$item['parent_id']?>' deep="<?=$item['deep']?>">
	                                        <td class='hide'><?php echo $item['parent_id'];?></td>
	                                        <td><div class='float-left name_condition' id='<?=$item['id'] ?>_name_condition' style="margin-left:<?=$item['deep']*50?>px">
	                                            <?if($item['hasChild']):?>
	                                            	<span class='row-details row-details-open'></span>
	                                            <?else:?>
	                                            <i class='dot'></i>&nbsp;
	                                            <?endif;?> 
	                                            <?php echo stripslashes($item['name']) ?>
	                                            </div>
	                                        </td>
	                                        <td width='10%' class='text-center'>
	                                            <a href="javascript:;" data-id="<?=$item['id'] ?>" onclick="edit_category('<?=$item['parent_id']?>','<?=$item['id'] ?>','<?php echo stripslashes($item['name']) ?>')" class="btn btn-xs yellow btn-editable" title='编辑分类'><i class="fa fa-pencil"></i></a>
	                                            <a href="javascript:;" data-id="<?=$item['id'] ?>" onclick="confirm_delete_category('<?php echo $item['id']?>')" title='<?php echo $this->lang->line('delete')?>' class="btn btn-xs red btn-removable"><i class="fa fa-times"></i></a>
	                                        </td>
	                                    </tr>
	                                    <?endforeach;?>
	                                <?else:?>
	                                    <tr id="add_new_node">
	                                        <td colspan="2"> 
	                                            尚未有任何分类，新增分类  
	                                        </td>
	                                        <td class="hide"></td>
	                                        <td class="hide"></td>
	                                    </tr>
	                                <?endif?>  
								</tbody>
							</table>

							<div id="add_new_node" name="1000" class="parent_1000" parent='1000' deep="0">
	                                <a id="createBtn" class="btn" style="padding-left: 0px;" href='javascript:void(0)' onclick="appendRootNode()">
	                                    <i class="fa fa-plus"></i>新增分类
	                                </a>
	                        </div>

							<table class="table table-striped table-bordered table-hover" id="order_list">
								<thead>
									<tr>
										<th>订单号</th>
										<th>用户</th>
										<th>总价</th>
										<th>状态</th>
										<th>时间</th>
										<th>电话</th>
										<th class="hidden-xs">操作</th>
									</tr>
								</thead>
								<tbody>
                            		<?if(!empty($list)):?>
                            		<?foreach($list as $key => $item):?>
									<tr id='<?php echo $item->id;?>'>
                                		<td><a href="javascript:void(0)" onclick="load_modal('admin/orders/info/<?php echo $item->id?>')">
                                			<?php echo $item->code?></a>
                                		</td>
                                		<td><?php echo $item->username?></td>
                                		<td><?php echo $item->price?></td>
                                		<td id='<?php echo $item->id;?>_status'><?php echo $this->order->status($item->status);?></td>
                                		<td><?php echo date('Y-m-d H:i:s',$item->create_time)?></td>
                                		<td><?php echo $item->phone?></td>
										<td id='<?php echo $item->id;?>_operate'>
											<?php if($item->status==0):?>
											<a href="javascript:void(0)" onclick="_cancel('<?php echo $item->id?>')" id='<?php echo $item->id;?>_cancel'>
												<span class='label label-danger'><i class='fa fa-trash-o'></i></span>
											</a> 
											<?php endif;?>
											<a href="javascript:void(0)" title="更改总价" onclick="show_dialog('<?php echo $item->id?>','<?php echo $item->price?>')" id='<?php echo $item->id;?>_change_price'>
												<span class='label label-warning'><i class='fa fa-edit'></i></span>
											</a>
										</td>
									</tr>
                            		<?endforeach;?>
                            		<?endif;?>
								</tbody>
							</table>
	<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/admin/order.js"></script>

	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
    <div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id='order_dialog_title'>修改订单总价</h4>
                </div>
                <div class="modal-body" id='order_dialog_body'>
                   <input type="hidden" id="order_id"/>
                   <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label"><span class='req'>*</span>总价</label>
								<input type="text" id="order_price" name='order_price' class="form-control" maxLength='100' value="">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue" id='order_confirm_btn' onclick="change_price()">确定</button>
                    <button type="button" class="btn default" data-dismiss="modal">取消</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
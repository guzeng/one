<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"><?php echo $order->code?></h4>
        </div>
        <div class="modal-body">
            <div class="panel panel-default">
                <div class="panel-heading">订单详情</div>
                <div class="panel-body">
                    <table class='table table-striped table-bordered table-hover dataTable'>
                        <tr>
                            <td class='b'>订单号</td>
                            <td><?php echo $order->code?></td>
                            <td class='b'>用户</td>
                            <td><?php echo $order->username?></td>
                        </tr>
                        <tr>
                            <td class='b'>创建时间</td>
                            <td><?php echo date('Y-m-d H:i:s',gmt_to_local($order->create_time));?></td>
                            <td class='b'>价格</td>
                            <td><?php echo $order->price?></td>
                        </tr>
                        <tr>    
                            <td class='b'>电话</td>
                            <td><?php echo $order->phone;?></td>
                            <td class='b'>状态</td>
                            <td colspan='3'><?php echo $this->order->status($order->status)?></td>
                        </tr>
                        </tr>
                            <td class='b'>地址</td>
                            <td colspan='3'><?php echo $order->address?></td>
                        <tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">付款情况</div>
                <div class="panel-body">
                    <table class='table table-striped table-bordered table-hover dataTable'>
                        <tr>
                            <td class='b'>已支付</td>
                            <td><?php echo $order->pay==1 ? '是' : '否';?></td>
                            <td class='b'>支付方式</td>
                            <td><?php echo $order->pay_type>0 ? $this->pay->payType($order->pay_type,'name') : '' ;?></td>
                        </tr>
                        <?php if($order->pay > 0):?>
                        <tr>
                            <td class='b'>付款时间</td>
                            <td><?php echo date('Y-m-d H:i:s',gmt_to_local($order->pay_time))?></td>
                            <td class='b'>支付单号</td>
                            <td>&nbsp;<?php echo $order->pay_code;?></td>
                        </tr>
                        <?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <?php if($order->status == '0'):?>
            <button class="btn btn-danger" id='del_btn' type="button" onclick="_cancel2('<?php echo $order->id;?>')" >取消订单</button>
            <?php endif;?>
            <button data-dismiss="modal" class="btn btn-default" type="button">关闭</button>
        </div>
    </div><!-- /.modal-content -->
</div>

<?$this->load->view('home/header')?>
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row p-b-50">
          <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <div class="content-page">
                    <!-- BEGIN LEFT SIDEBAR -->  
                    <div class="row">          
                        <div class="col-md-12 p-l-30 p-r-30">
                            <h2>订单支付</h2>
                            <div class='note m-t-30'>
                                <p>订单号 : <?php echo $order->code?></p>
                                <p>金额 : ￥<?php echo round($order->price,2)?></p>
                                <p>下单时间 : <?php echo date('Y-m-d H:i:s', gmt_to_local($order->create_time))?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class='row' id='mycart'>
                        <div class="col-md-12 p-l-30 p-r-30">
                        <table class="table table-advance table-hover">
                        <thead>
                            <tr>
                              <th width="46%">商品</th>
                              <th width="16%">价格</th>
                              <th width="15%">数量</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?if(!empty($detail)):?>
                            <?foreach($detail as $key => $item):?>
                            <tr>
                              <td><a href="<?php echo base_url().'item/id/'.$item->product_id?>" target='_blank'><?php echo $item->name?></a></td>
                              <td ><?php echo $item->price;?></td>
                              <td ><?php echo $item->number;?></td>
                            </tr>
                            <?endforeach;?>
                            <?endif;?>
                        </tbody>
                        </table>
                        </div>
                    </div>

                    <hr>
                    <div class="row">    
                        <div class="col-md-12 p-l-30 p-r-30">
                            <p>为了安全起见，无论您是否拥有支付宝账号都可通过点击支付宝完成支付</p>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-md-12 p-l-30 p-r-30">
                            <form action="<?php echo base_url()?>payment" method='post'>
                            <div class="form-group m-b-20">
                                <div class="col-md-12">
                                    <div class="radio-list">
                                        <label class='m-b-20'>
                                            <input type="radio" checked="" value="alipay" id="pay_type_alipay" name="pay_type"> &nbsp;
                                            <img class='' src="<?php echo base_url().'assets/img/alipay.jpg'?>" >
                                        </label>
                                        <label class='m-b-20'>
                                            <input type="radio" value="banking" id="pay_type_bank" name="pay_type"> &nbsp;
                                            <img class='' src="<?php echo base_url().'assets/img/unionpay.jpg'?>" >
                                        </label>
                                        <div id='banks' class='hide'>
                                            <div class="m-b-20">
                                                <label class="radio-inline" style='margin-left:10px;'>
                                                    <input type="radio" name="bank_name" value="ICBCB2C" checked class='bankinput'> 
                                                    <span class='bank ICBC' title='中国工商银行'></span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="ABC" class='bankinput'>
                                                    <span class='bank ABC' title='中国农业银行'></span> 
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CCB" class='bankinput'>
                                                    <span class='bank CCB' title='中国建设银行'></span>  
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="BOCB2C"  class='bankinput'>
                                                    <span class='bank BOCB2C' title='中国银行'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CMB"  class='bankinput'> 
                                                    <span class='bank CMB' title='招商银行'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="POSTGC"  class='bankinput'>
                                                    <span class='bank POSTGC' title='中国邮政储蓄银行'></span>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="COMM-DEBIT" class='bankinput'>
                                                    <span class='bank COMM-DEBIT' title='交通银行'></span> 
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="GDB"  class='bankinput'>
                                                    <span class='bank GDB' title='广发银行'></span>  
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CMBC" class='bankinput'>
                                                    <span class='bank CMBC' title='中国民生银行'></span>   
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CITIC" class='bankinput'>
                                                    <span class='bank CITIC' title='中信银行'></span>    
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SPABANK"  class='bankinput'>
                                                    <span class='bank SPABANK' title='平安银行'></span>     
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="CEB-DEBIT"  class='bankinput'>
                                                    <span class='bank CEB-DEBIT' title='中国光大银行'></span>      
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SHBANK" class='bankinput'>
                                                    <span class='bank SHBANK' title='上海银行'></span>       
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="SPDB" class='bankinput'>
                                                    <span class='bank SPDB' title='上海浦东发展银行'></span>        
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_name" value="BJBANK"  class='bankinput'>
                                                    <span class='bank BJBANK' title='北京银行'></span>         
                                                </label>
                                            </div>
                                        </div>
                                        <label>
                                            <input type="radio"  value="daofu" id="pay_type_cash" name="pay_type"> &nbsp;
                                            <img class='' src="<?php echo base_url().'assets/img/cash.jpg'?>" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- 优惠券-->
                            <div class='form-group m-b-20'>
                                <?php if(!empty($coupon)):?>
                                    <p>优惠券</p>
                                    <div class="radio-list">
                                        <?php foreach($coupon as $key => $item):?>
                                        <label class='m-b-20'>
                                            <input type="radio" checked="" value="alipay" id="pay_type_alipay" name="pay_type"> &nbsp;
                                            <?php echo $item->value;?> 
                                        </label>
                                        <?php endforeach;?>
                                    </div>
                                <?php endif;?>
                            </div>
                            <!-- coupon end -->
                            <div class="form-group">
                                <div class="col-md-12 p-20"> &nbsp; &nbsp; &nbsp;
                                    <button class='btn btn-primary' type='submit'>提交</button>
                                </div>
                            </div>
                            <input type='hidden' name='orderid' value="<?php echo $order->id?>">
                            </form>
                        </div>
                    </div>
                    <!-- END LEFT SIDEBAR -->
                </div>
            </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('input[name=pay_type]').click(function(){
        if($(this).val()=='banking'){$('#banks').show();}else{$('#banks').hide();}
    })
})
</script>

<?$this->load->view('home/footer')?>


<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <div class='container m-t-20'>
        <div class='row' id="user-safe">
            <!-- left -->
            <?$this->load->view('home/my')?>
            <!-- left end -->
            <!-- right -->
            <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
                <div id="main">
                    <div class="tab-content">
                        <!-- 消费记录 -->
                        <div id="tab_1-3" class="tab-pane active">
                            <div class="mod-main mod-comm">
                                <div class="mc">
                                    <div class="p-l-20 user-info-cont">
                                        总实际消费金额：<strong class="ftx01 num">￥<label id="lblBalance"><?php echo $total_consume_money?></label>&nbsp;&nbsp;</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="mod-main mod-comm lefta-box">
                                <ul class="nav nav-tabs">
                                    <li class=""><a href="<?=base_url().'home/users/consume'?>">近三个月记录</a></li>
                                    <li class="active"><a href="<?=base_url().'home/users/previously_consume'?>">三个月前记录</a></li>
                                </ul>

                                <div class="">
                                    <div id="three-month-ago" class="tab-pane">
                                        <?if(!empty($list)):?>
                                        <table class='table table-striped table-advance table-hover'>
										<thead>
											<tr>
												<td width='20%'>时间</td>
												<td width='20%'>涉及订单号</td>
												<td width='20%'>消费额扣减</td>
												<td width='20%'>消费额增加</td>
												<td width='20%'>备注</td>
											</tr>
										</thead>
										<tbody>
                                        <?foreach($list as $key => $value):?>
                                            <tr>
                                                <td width='20%'><?php echo date('Y-m-d H:i:s',gmt_to_local($value->create_time))?></td>
												<td width='20%'><?php echo $value->code?></td>
                                                <td width='20%'>-</td>
												<td width='20%'>￥<?php echo $value->price?></td>
                                                <td width='20%'>-</td>
											</tr>
                                        <?endforeach;?>
										</tbody>
                                        </table>
                                        <?endif;?>
										<div class="text-right">
											<!-- pagination start -->
											<?if(isset($pagination)):?>
											<div class="pagination pagination-right padding-right-20 pull-right">
											<?=isset($pagination)?$pagination:''?>
											</div>
											<?endif;?>
											<!-- pagination end -->
										</div>
                                    </div>
                                </div>
                            </div>
							<div class="mt10 m-b-10 p-l-20 clearfix">
								<div class="ftx-03 fl">提示：系统仅显示您两年之内的消费记录，更早的消费记录不再显示。</div>
							</div>
                        </div>
                        <!-- 消费记录结束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
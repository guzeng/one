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
                        <!-- 我的积分 -->
                        <div id="tab_1-3" class="tab-pane active">
                            <div class="o-mt">
                                <h2>我的积分&nbsp;&nbsp;&nbsp;<?php echo $user->money?></h2>
                            </div>
                            <form action="<?=base_url()?>home/users/score" method="post" id='score_form'>
                                <div class="mod-main mod-comm lefta-box">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#last-three-month">积分记录(近三个月记录)</a></li>
                                    </ul>
                                    <div class="btn-group">
                                        <button style="border:0px" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                                        <?if(isset($time_type_list)):?>
                                        <?php echo $time_type_list[$time_type];?>
                                        <?endif;?>
                                        <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?if(isset($time_type_list)):?>
                                                <?foreach($time_type_list as $key => $value):?>
                                                <?if($key != $time_type):?>
                                                <li><a href="<?=base_url()?>home/users/score/<?php echo $key;?>"><?php echo $value;?></a></li>
                                                <?endif;?>
                                                <?endforeach;?>
                                            <?endif;?>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <div id="last-three-month" class="tab-pane active">
                                            <?if(!empty($list)):?>
                                            <table class="table table-striped table-advance table-hover">
                                                <thead>
                                                  <tr>
                                                    <th width="15%">积分</th>
                                                    <th width="20%">变动时间</th>
                                                    <th>原因</th>
                                                    <th width="15%">订单金额</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?foreach($list as $key => $value):?>
                                                    <tr>
                                                        <th style="color:<?php echo $value->score>=0?'red':'grey';?>" width="15%"><?php echo $value->score>=0?'+':'-';?>&nbsp;<?php echo $value->score?></th>
                                                        <th width="20%"><?php echo date('Y-m-d',$value->create_time)?></th>
                                                        <th><?php echo $value->info?></th>
                                                        <th width="15%"><?php echo $value->order_money?></th>
                                                    </tr>
                                                <?endforeach;?>
                                                </tbody>
                                            </table>
                                            <?else:?>
                                            <p style="text-align:center;">暂无记录！</p>
                                            <?endif;?>
                                        </div>
                                    </div>
                                    <div class="mt10 m-t-20 m-b-10 p-l-20 clearfix">
                                        <div class="ftx-03 fl">积分获取及使用常见问题</div>
                                        <ol style="color:grey">
                                            <li>您兑换的购物券为电子券，有效期为一年，自成功兑换之日起计算。</li>
                                            <li>购物券仅限本ID使用，不能折算为现金、也不能再次兑换为积分。</li>
                                            <li>每日至多换取三张优惠券。</li>
                                        </ol>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--我的积分结束 -->
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
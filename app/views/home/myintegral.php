<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<div class='container m-t-20'>
    <div class='row' id="myintegral">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <ul class="nav nav-tabs">
                <li class="">
                    <h4>我的积分</h4>
                </li>                
            </ul>
            <div class="block">
            <div class="nav ">
                <div class="btn-group">
                    <button style="border:0px;padding:10px 15px;" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
                    <?if(isset($time_type_list)):?>
                    <?php echo $time_type_list[$time_type];?>
                    <?endif;?>
                    <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" style="font-size:12px;">
                        <?if(isset($time_type_list)):?>
                            <?foreach($time_type_list as $key => $value):?>
                            <?if($key != $time_type):?>
                            <li><a style="margin:0,10px;" href="<?=base_url()?>home/myintegral/index/time_type/<?php echo $key;?>"><?php echo $value;?></a></li>
                            <?endif;?>
                            <?endforeach;?>
                        <?endif;?>
                    </ul>
                </div>
            </div>
        </div>
        
            <div id="myTabContent" class="tab-content">
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
                            <td style="color:<?php echo $value->score>=0?'red':'grey';?>" width="15%"><?php echo $value->score>=0?'+':'-';?>&nbsp;<?php echo $value->score?></td>
                            <td width="20%"><?php echo date('Y-m-d',$value->create_time)?></td>
                            <td><?php echo $value->info?></td>
                            <td width="15%"><?php echo $value->order_money?></td>
                        </tr>
                    <?endforeach;?>
                    </tbody>
                </table>
                <?else:?>
                <p style="text-align:center;">暂无记录！</p>
                <?endif;?>

                <!-- paginition start -->
                <?if(isset($pagination)):?>
                <div class="pagination pagination-right padding-right-20 pull-right">
                <?=isset($pagination)?$pagination:''?>
                </div>
                <?endif;?>
                <!-- paginition end -->

                <div class="faq">
                    <h5>积分获取及使用常见问题</h5>
                    <p>
                        1. 您兑换的购物券为电子券，有效期为一年，自成功兑换之日起计算。<br>
                        2. 购物券仅限本ID使用，不能折算为现金、也不能再次兑换为积分。<br>
                        3. 每日至多换取三张优惠券。
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?$this->load->view('home/footer')?>
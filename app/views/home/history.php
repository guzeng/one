<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="history">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12' style="border-left:1px solid rgba(95, 171, 34, 1)">

            <?php if(isset($user_history) && !empty($user_history)):?>
            <?php foreach ($user_history as $key => $item):?>
            <div class="same_date relative" style="m-b-10">
                  <a class="round">●</a>
                <h3 class="page-title">
                    <?php echo $item[0]->show_date;?>
                    <small><?php if(!$item[0]->show_date):?><?php echo date('Y-m-d', $item[0]->create_time);?><?endif;?> 浏览了<?php echo count($item);?>个件宝贝</small>
                </h3>
                <!-- list -->
                <div class='row m-b-20 '>
                    <?php foreach ($item as $key => $value):?>
                    <div class='col-md-3 p-thumb'>
                        <div class='text-center m-b-10'>
                            <a href="<?php echo base_url().'item/id/'.$value->product_id?>" target='_blank'>
                                <img src='<?php echo $this->product->pic($value->product_id)?>' title='<?php echo $value->name;?>' class='img-responsive'></div>
                            </a>
                        <div class='price'>
                             ￥ <?php echo $value->price;?>
                            <?php if($value->specials==1):?>
                                <span class="label label-sm label-warning pull-right">特卖</span>
                            <?php endif;?>
                            <?php if($value->recommend==1):?>
                                <span class="label label-sm label-success pull-right m-r-5">推荐</span>
                            <?php endif;?>
                        </div>
                        <div class=' m-b-5'>
                            <a>已销售量<?php echo $value->sale_num;?>件</a>
                            <?php if($value->handpick==1):?>
                                <span class="label label-sm label-default pull-right">精选</span>
                            <?php endif;?>
                            <?php if($value->hot==1):?>
                                <span class="label label-sm label-info pull-right m-r-5">热卖</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php if($key>0 && $key%3==0):?>
                        </div>
                        <div class='row m-b-20'>
                    <?php endif;?>
                    <?endforeach;?>
                </div>
            </div>
            <?endforeach;?>
            <!-- like list end --> 
            <?else:?>
            暂时没有你的最近一个月的浏览信息!
            <?endif;?>
        </div>
        <!-- right end --> 
    </div>
</div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
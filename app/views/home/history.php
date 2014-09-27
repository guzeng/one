<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row'>
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <?php if(isset($user_history) && !empty($user_history)):?>
            <?php foreach ($user_history as $key => $item):?>
            <div class="same_date" style="m-b-10">
                <h3 class="page-title">
                    <?php echo $item[0]->show_date;?>
                    <small><?php echo date('Y-m-d', $item[0]->create_time);?> 浏览了<?php echo count($item);?>个件宝贝</small>
                </h3>
                <!-- list -->
                <div class='row m-b-20 '>
                    <?php foreach ($item as $key => $value):?>
                    <div class='col-md-3 p-thumb'>
                        <div class='text-center m-b-10'>
                            <img src='<?php echo base_url()?>assets/img/home/p.jpg' class='img-responsive'></div>

                        <div class='price'>
                             ￥ <?php echo $value->price;?>
                            <span class="label label-sm label-warning pull-right">限时特价</span>
                        </div>
                        <div class=' m-b-5'>
                            <a>已销售量<?php echo $value->sale_num;?>件</a>
                            <span class="label label-sm  label-default  pull-right">同类推荐</span>
                        </div>

                    </div>
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
<?$this->load->view('home/header')?>
<div class='container'>
    <div class='row'>
        <ol class="breadcrumb top-bar">
            <?if(isset($parent)):?><li><?php echo $parent->name?></li><?endif;?>
            <li class="active"><?php echo $category->name?></li>
        </ol>
    </div>
</div>
<div class='container'>
    <div class='row'>
        <!-- left -->
        <div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 col-no-padding'>
            <ul class="list-group m-b-10">
                <?if(!empty($child)):?>
                <?foreach($child as $key => $value):?>
                <li class="list-group-item">
                    <a href="<?php echo base_url()?>category/index/cate_id/<?php echo $value->id?>">
                    <?php echo $value->name?>
                    </a>
                </li>
                <?endforeach;?>
                <?endif;?>
            </ul>
            <!-- ad 1 -->
            <div class='m-b-10'>
                <img class='img-responsive' src="<?php echo base_url();?>assets/img/home/c-ad-1.jpg">
            </div>
            <!-- ad 1 end -->
            <div class='b m-b-10'>
                <div class='p-10 b-b black'>本周销售排行</div>
                <ul class="list-unstyled c-top10">
                    <?if(!empty($hot)):?>
                    <?foreach($hot as $key => $item):?>
                    <li>
                        <div class='img pull-left'>
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                                <img src="<?php echo $this->product->pic($item->id,1,'thumb');?>" class='img-responsive'>
                            </a>
                        </div>
                        <div class='name'>
                            <div class=''>
                                <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                                    <?php echo $item->name?>
                                </a>
                            </div>
                            <div class='price'>￥<?php echo sprintf('%.2f',$item->price)?></div>
                        </div>
                        <div class='clearfix'></div>
                    </li>
                    <?endforeach;?>
                    <?endif;?>
                </ul>
            </div>

            <div class='b'>
                <div class='p-10 b-b black'>看过<?php echo $category->name?>的顾客最终购买了</div>
                <ul class="list-unstyled c-top10">
                    <?if(!empty($last_buy)):?>
                    <?foreach($last_buy as $key => $item):?>
                    <li>
                        <div class='m-b-10'>
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                            <img class='img-responsive' src="<?php echo $this->product->pic($item->id,1);?>">
                            </a>
                        </div>
                        <div class='m-b-10'>
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                                <?php echo $item->name?>
                            </a>
                        </div>
                        <div class='m-b-5 price'>￥<?php echo sprintf('%.2f',$item->price)?></div>
                        <div><a class='c-9'>已有<?php echo $item->comment_num?>人评价</a></div>
                    </li>
                    <?endforeach;?>
                    <?endif;?>
                </ul>
            </div>
        </div>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <!-- 品牌 -->
            <div class='row m-l-0 b'>
                <div class='col-md-1 p-15'>
                    品牌
                </div>
                <div class='col-md-11 b-l p-15'>
                    <div class='row m-b-10'>
                        <?foreach($product_brand as $key => $item):?>
                            <?if($key > 0 && $key%4==0):?>
                                </div>
                                <div class='row m-b-10'>
                            <?endif;?>
                            <div class='col-md-3'>
                                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $item->id?>','c-plist')">
                                <?php echo $item->name?>
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
            <!-- 品牌end -->
            <!-- 价格 -->
            <div class='row m-l-0 b-l b-r b-b'>
                <div class='col-md-1 p-15'>
                    价格
                </div>
                <div class='col-md-11 b-l p-15'>
                        <span class='m-r-30'>0-30元</span>
                        <span class='m-r-30'>30-60元</span>
                        <span class='m-r-30'>60-100元</span>
                        <span class='m-r-30'>200-1000元</span>
                        <span class=''>1000元以上</span>
                </div>
            </div>
            <!-- 价格 end -->
            <!-- list -->
            <div id='c-plist'>
                <?php echo $plist;?>
            </div>
            <!-- list end -->
            <div class='row m-l-0 m-b-20'><div class='col-md-12 guess-like'>猜您喜欢</div></div>
            <!-- like list -->
            <div class='row m-b-20 '>
                <?if(!empty($like_list)):?>
                <?foreach($like_list as $key => $item):?>
                <?if($key>0 && $key%4==0):?>
                    </div><div class='row m-b-20 '>
                <?endif;?>
                <div class='col-md-3 p-thumb'>
                    <div class='text-center m-b-10'>
                        <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                            <img src='<?php echo $this->product->pic($item->id);?>' class='img-responsive'>
                        </a>
                    </div>
                    <div class='m-b-5 title'>
                        <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>" target='_blank'>
                            <?php echo $item->name?>
                        </a>
                    </div>
                    <div class='price'>￥ <?php echo sprintf('%.2f',$item->price);?></div>
                </div>
                <?endforeach;?>
                <?endif;?>
            </div>
            <!-- like list end -->
        </div>
        <!-- right end -->
    </div>
</div>


<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
    </div>
</div>
<?$this->load->view('home/footer')?>
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
            <span class='m-r-30'>
                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/0-30','c-plist')">
                0-30元
                </a>
            </span>
            <span class='m-r-30'>
                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/30-60','c-plist')">
                30-60元
                </a>
            </span>
            <span class='m-r-30'>
                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/60-100','c-plist')">
                60-100元
                </a>
            </span>
            <span class='m-r-30'>
                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/200-1000','c-plist')">
                200-1000元
                </a>
            </span>
            <span class=''>
                <a href='javascript:void(0)' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/1000-','c-plist')">
                1000元以上
                </a>
            </span>
    </div>
</div>
<!-- 价格 end -->
<!-- list -->

    <!-- order line -->
    <div class='row m-t-10 m-l-0 order-line'>
        <div class='col-md-1 p-t-6 order-line-title' >排序</div>
        <div class='col-md-5 p-t-5 p-b-5 p-l-0'>
            <a href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/<?php echo $price?>/orderby/sale/desc/<?php echo $orderby=='sale'?$desc:'desc';?>','c-plist')">
                <span class='order-item'>销量</span></a>
            
            <a href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/<?php echo $price?>/orderby/price/desc/<?php echo $orderby=='price'?$desc:'desc';?>','c-plist')">
                <span class='order-item'>价格</span></a>
            
            <a href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/<?php echo $price?>/orderby/comment/desc/<?php echo $orderby=='comment'?$desc:'desc';?>','c-plist')">
                <span class='order-item'>评论数</span></a>
            
            <a href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/price/<?php echo $price?>/orderby/time/desc/<?php echo $orderby=='time'?$desc:'desc';?>','c-plist')">
                <span class='order-item'>上架时间</span></a>

        </div>
        <div class='col-md-6 p-t-5 p-b-5 text-right'>
            <span class='order-page total'>共 <?php echo $count;?> 个商品</span>
            <span class='order-page'><span class='order-page-current'><?php echo $per_page;?></span>/<?php echo $all_page;?></span>
            <?if($all_page > 1):?>
            <span class='order-page-btn'>
                <?if($per_page>1):?>
                <button class='btn btn-default' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/page/<?php echo intval($per_page-1)?>/orderby/<?php echo $orderby?>/desc/<?php echo $desc;?>','c-plist')">上一页</button> 
                <?endif;?>
                <?if($per_page<$all_page):?>
                <button class='btn btn-default' onclick="load_page('<?php echo base_url()?>category/plist/cate_id/<?php echo $cate_id?>/brand_id/<?php echo $brand_id?>/page/<?php echo intval($per_page+1)?>/orderby/<?php echo $orderby?>/desc/<?php echo $desc;?>','c-plist')">下一页</button>
                <?endif;?>
            </span>
            <?endif;?>
        </div>
    </div>
    <!-- order line end -->
    <div class='row m-b-20 '>
        <?if(!empty($list)):?>
            <?foreach($list as $key => $item):?>
            <?if($key > 0 && $key%4==0):?>
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
                <div class=' m-b-5'><a>已有<?php echo $item->comment_num?>人评价</a></div>
                <div class=''>
                    <div class='pull-left input'>
                        <input type='text' name='cart_num' id='<?php echo $item->id?>_num' class=' form-control' value='<?php echo $item->min_num>0?$item->min_num:1;?>'>
                        <button class='btn btn-default plus' onclick="cart_count('plus',this)">+</button>
                        <button class='btn btn-default minus' onclick="cart_count('minus',this)">-</button>
                        <input type='hidden' name='min_num' value="<?php echo $item->min_num?>">
                    </div>
                    <div class='pull-left ship-btn'><button class='btn btn-default' onclick="addCart('<?php echo $item->id?>')">加入购物车</button></div>
                </div>
            </div>
            <?endforeach;?>
        <?else:?>
            <div class='col-md-12 m-t-20 p-l-20'><strong>暂无商品</strong></div>
        <?endif;?>
    </div>


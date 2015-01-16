<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/scripts/home/item.js" type="text/javascript"></script>
<div class='container'>
    <div class='row'>
        <ol class="breadcrumb top-bar">
            <li>全部结果</li>
            <li class="active">"<?php echo urldecode($keyword)?>"</li>
        </ol>
    </div>
</div>
<div class='container'>
    <div class='row'>
        <!-- left -->
        <div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 col-no-padding'>
            <div class="list-group m-b-10">
                <?php if(isset($product_cate) && !empty($product_cate)): ?>
                    <?foreach($product_cate as $key => $item):?>
                        <div class="list-group-item heading cate-parent hand" id='cate-<?php echo $item['id']?>'>
                            <i class="fa <?php echo $key>3 ? 'fa-plus' : 'fa-minus'?>"></i>
                            <a class='p-l-10' href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>search/plist/keyword/<?php echo $keyword?>/cate_id/<?php echo $item['id']?>/brand_id/<?php echo $brand_id?>','c-plist')">
                                <?php echo $item['name']?>
                            </a>
                        </div>
                        <div class="list-group-item <?php if($key>3):?>hide<?php endif;?>" id='child-cate-<?php echo $item['id']?>'>
                            <?php if(isset($item['child']) && !empty($item['child'])): ?>
                                <?foreach($item['child'] as $k => $i):?>
                                    <div class='m-b-5 p-l-20'>
                                    <a href="javascript:void(0)" onclick="load_page('<?php echo base_url()?>search/plist/keyword/<?php echo $keyword?>/cate_id/<?php echo $i['id']?>/brand_id/<?php echo $brand_id?>','c-plist')">
                                        <?php echo $i['name'];?></a>
                                    </div>
                                <?endforeach;?>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                <?endif;?>
            </div>
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

        </div>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
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
<script type="text/javascript">
$(function(){
    $('.cate-parent').click(function(){
        cate_show_hide(this);
    })
})
function cate_show_hide(obj)
{
    var id = $(obj).attr('id');
    if($('#child-'+id).css('display') == 'none')
    {
        $('#child-'+id).slideDown(function(){
            $('#'+id).find('i').removeClass('fa-plus').addClass('fa-minus'); 
        });
    }
    else
    {
        $('#child-'+id).slideUp(function(){
            $('#'+id).find('i').removeClass('fa-minus').addClass('fa-plus');
        });
    }
}
</script>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
    </div>
</div>

<?$this->load->view('home/footer')?>
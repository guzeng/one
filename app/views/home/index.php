<?$this->load->view('home/header')?>
<style type="text/css">
    .mod_cate{position:relative;z-index:600;float:left;background-color:#4593fd;}
    .mod_cate a{color:#fff}
    .mod_cate a:hover{color:#fff}
    .mod_cate_on .mod_cate_hd{border-color:#3586f2}
    .mod_cate_on .mod_cate_bd{display:block}
    .mod_cate_on .mod_cate_hd_arrow{visibility:hidden}
    .mod_subcate{position:absolute;display:none;z-index:4;left:100%;top:0px;color:#333;width:798px;height:626px;border:2px solid #4594fd;background-color:#fff;box-shadow:5px 5px 10px rgba(55,55,55,0.4);overflow:hidden}
    .mod_subcate a{color:#666}
    .mod_subcate a:hover{color:#333}
    .mod_subcate_item{position:relative;width:100%;zoom:1;overflow:hidden}
    .mod_subcate_main{float:left;width:100%;padding:0 20px;border-right:1px solid #ddd;padding-bottom:1000px;margin-bottom:-1000px}
    .mod_subcate_side{float:left;width:230px;padding-bottom:1000px;margin-bottom:-1000px}
    .mod_subcate_gg{clear:both;position:absolute;bottom:0;right:0;_right:-1px;_bottom:-1px}
    .mod_subcate_main dl{zoom:1;overflow:hidden;padding:0px 0 0px 65px;margin-top:10px;border-bottom:1px solid #e5e5e5}
    .mod_subcate_main dt{float:left;#display:inline;margin-left:-65px;width:185px;font:700 12px/22px tahoma;color:#1d7ad9}
    .mod_subcate_main dd{overflow:hidden;zoom:1;line-height:22px}
    .mod_subcate_main dd a{display:inline;float:left;margin-left:5px;margin-right:5px;white-space:nowrap}
    .mod_subcate_main dd .hl,.mod_subcate_main dd .hl:hover{color:#ff7300}
    .mod_subcate_dotline{clear:both;display:block;width:100%;height:1px;margin-bottom:5px;font-size:0;overflow:hidden;border-top:5px solid #fff;border-bottom:1px dotted #dadada}
    .mod_subcate_channel{clear:both;margin-top:15px;padding-bottom:20px}
    #category .item:hover .mod_subcate{display: block;border-left:0px;}
    #category .item:hover{background-color: #FFFFFF;}

    .sy_mod_key_dl {
        padding-bottom: 15px;
    }
    .sy_mod_key_dl dt, .sy_mod_key_dl dd {
        display: inline;
    }
    .sy_mod_key_dl dt {
        font-weight: 700;
    }
    .sy_mod_key_dl dt a {
        color: #333;
    }
    .sy_mod_key_dl dt a:hover {
        color: #333;
    }
    .sy_mod_key_dl dd {
        padding-left: 8px;
    }
    .sy_mod_key_dl dd a {
        color: #999;
        padding-right: 2px;
        white-space: nowrap;
        word-break: keep-all;
        word-wrap: normal;
    }
    .sy_mod_key_dl dd a:hover {
        color: #333;
    }
</style>
<script src="<?php echo base_url();?>assets/scripts/home/home.js" type="text/javascript"></script>
<script type="text/javascript">
    var rolling;
    var i=0;
    $(function(){
        $('#rollingHover').find('li').hover(function(){
            clearInterval(rolling);
            var index = parseInt($(this).index());
            //showPic(index);
        },function(){
            i = parseInt($(this).index());
            //startRoll();
        })
        //startRoll();
    })
    function startRoll()
    {
        rolling = setInterval(function(){
            i++;
            showPic(i%<?php echo isset($ad_home)?count($ad_home):0;?>);
        },5000);
    }
    function showPic(index)
    {
        var width = (0-index*1000)+'px';
        $("#rolling-pics").animate({opacity:'fast'},"500",function(){
            $(".rollingPic ul li").each(function(){
                $(this).hide();
            });
        });
        $('#rolling-pics').animate({opacity:'fast'},"500",function(){
             $(".rollingPic ul li").eq(index).show();
        });

        $('#rollingHover').find('li.hover').removeClass('hover');
        $('#rollingHover').find('li').eq(index).addClass('hover');
    }
</script>
    <!-- categorys  -->
    <div class='container'>
        <div class='row'>
            <div id='category' class='col-lg-2 col-md-3 col-no-padding mod_cate mod_on' >
                <?php if(isset($product_cate) && !empty($product_cate)): ?>
                    <?foreach($product_cate as $key => $item):?>
                        <!-- 顶级分类 -->
                        <div class='item'>
                            <a href="<?php echo base_url()?>category/index/cate_id/<?php echo $item['id']?>">
                                <?php echo $item['name'];?>
                            </a>
                            <span class="more">></span>
                            
                            <?php if(isset($item['child']) && !empty($item['child'])): ?>
                            <div class="mod_subcate hide" style="width:350%; top: 0px; overflow: hidden; height:auto;min-height: 372px;">
                                    <div id="panel0" class="mod_subcate_item" index="0" style="display: block;">
                                        <div class="mod_subcate_main">
                                            <?foreach($item['child'] as $k => $i):?>
                                            <dl>
                                                <!-- 二级分类 开始-->
                                                <dt>
                                                    <a href="<?php echo base_url()?>category/index/cate_id/<?php echo $i['id']?>">
                                                        <?php echo $i['name'];?>
                                                    </a>
                                                </dt>
                                                <!-- 二级分类 结束-->
                                                <dd>
                                                    <!-- 三级分类 -->
                                                    <?php if(isset($i['child']) && !empty($i['child'])): ?>
                                                    <?foreach($i['child'] as $k3 => $v):?>
                                                        <a href="<?php echo base_url().'/category/index/cate_id/'.$v['id']?>" target="_blank"><?php echo $v['name'];?></a>
                                                        <?if($k3 >6 && $k3%7 == 0):?>
                                                        <s class="mod_subcate_dotline"></s>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                    <?endif;?>
                                                </dd>
                                            </dl>
                                            <?endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                <?else:?>
                暂未添加商品分类数据！
                <?endif;?>
            </div>
            <div class='col-lg-7 col-p-10 m-t-10 o-h'>
                <div class="layoutRolling_04" id='layoutRolling'>
                    <div class="rollingPic">
                        <div class='rollingContainer'>
                            <?php if(isset($ad_home)&& !empty($ad_home)):?>
                            <ul id='rolling-pics' style="padding-left:0px;">
                                <?php foreach ($ad_home as $key => $value):?>
                                   <li bg='<?php echo $key;?>' class="<?php if($key > 0):?>hide<?php endif;?>">
                                        <a href="<?php echo $value->url;?>">
                                            <img style="height:100%;width:100%;" src="<?php echo $this->ad->pic($value->id);?>"/>
                                        </a>
                                    </li>
                                <?endforeach;?>
                            </ul>
                            <?endif;?>
                        </div>
                    </div>
                    <div class="layoutRolling_bt">
                        <div class="rollingPointer">
                            <?php if(isset($ad_home)&& !empty($ad_home)):?>
                            <ul id='rollingHover' style="list-style:none;">
                                <?php foreach ($ad_home as $key => $value):?>
                                   <li class="<?php echo $key == 0?'hover':'';?>"></li>
                                <?endforeach;?>
                            </ul>
                            <?endif;?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered m-t-10 m-b-0" >
                    <tbody>
                        <tr>
                            <td>
                                <div class='pull-left'>
                                    <div class='title'><strong>进口水果</strong></div>
                                    <div>台湾凤梨</div>
                                    <div>美国水果</div>
                                    <div>意大利水果</div>
                                </div>
                                <div class='pull-right'>
                                    <img src="<?php echo base_url()?>assets/img/home/ad-s-1.png">
                                </div>
                            </td>
                            <td>
                                <div class='pull-left'>
                                    <div class='title'><strong>T恤节女装</strong></div>
                                    <div>条纹T恤</div>
                                    <div>假两件T</div>
                                    <div>情侣T恤</div>
                                </div>
                                <div class='pull-right'>
                                    <img src="<?php echo base_url()?>assets/img/home/ad-s-2.png">
                                </div>
                            </td>
                            <td>
                                <div class='pull-left'>
                                    <div class='title'><strong>意尔康大牌日</strong></div>
                                    <div>高跟单鞋</div>
                                    <div>正装皮鞋</div>
                                    <div>男帆布鞋</div>
                                </div>
                                <div class='pull-right'>
                                    <img src="<?php echo base_url()?>assets/img/home/ad-s-3.png">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col-lg-3 col-no-padding m-t-10'>
                <div id='userinfo'>
                    <div class='pull-left'>
                        <img width=80 height=60 class="img-circle" src="<?php echo $this->user->pic($this->auth->user_id(),'small')?>" >
                    </div>
                    <div class='pull-left username'>
                        <div>Hi,
                            <?php if($this->auth->username()):?>
                            <a href="<?php echo base_url().'home/users/index';?>">
                                <?php echo $this->auth->username();?>
                            </a> 
                            <?else:?>
                                游客
                            <?endif;?>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                </div>
                <div id='info-detail' class='m-b-10'>
                    <div class=''>
                        <div class='col-md-4 info-items'>
                            <div class='text-center item'>
                                <div class='p-t-10 p-b-10'><?php echo $this->cart->count()?></div>
                                <div>购物车</div>
                            </div>
                        </div>
                        <div class='col-md-4 info-items'>
                            <div class=' text-center item'>
                                <div class='p-t-10 p-b-10'><?php echo isset($order_count)?$order_count:0;?></div>
                                <div>我的订单</div>
                            </div>
                        </div>
                        <div class='col-md-4 info-items'>
                            <div class=' text-center item'>
                                <div class='p-t-10 p-b-10'><?php echo isset($score)?$score:0;?></div>
                                <div>积分</div>
                            </div>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                </div>
                <!-- 公告标签 -->
                <div class='notice'>
                    <ul role="tablist" class="nav nav-tabs" id="notice-tab">
                      <li class=""><a data-toggle="tab" class='text-center' role="tab" href="#home">公告</a></li>
                      <li class="active"><a data-toggle="tab" class='text-center' role="tab" href="#profile">VIP专享</a></li>
                      <li class=""><a data-toggle="tab" class='text-center' role="tab" href="#profile1">卡券</a></li>
                    </ul>
                    <div class="tab-content p-15" id="notice-tabContent">
                        <div id="home" class="tab-pane fade">
                            <!-- 只显示最新的五条公告 start-->
                            <?php if(isset($news) && !empty($news)): ?>
                            <ul>
                            <?foreach($news as $key => $item):?>
                                <li><a href="<?php echo base_url()?>news/info/<?php echo $item->id;?>" target='_blank'><?php echo $item->title;?></a></li>
                            <?endforeach;?>
                            </ul>  
                            <?else:?>
                            暂无公告!
                            <?endif;?>  
                            <!-- 公告 end-->
                        </div>
                        <div id="profile" class="tab-pane fade active in">
                            <?php if(isset($vip_news) && !empty($vip_news)): ?>
                            <ul>
                            <?foreach($vip_news as $key => $item):?>
                                <li><a href="<?php echo base_url()?>news/info/<?php echo $item->id;?>" target='_blank'><?php echo $item->title;?></a></li>
                            <?endforeach;?>
                            </ul>  
                            <?else:?>
                            暂无VIP专享!
                            <?endif;?>
                        </div>
                        <div id="profile1" class="tab-pane fade">
                            <?php if(isset($coupon) && !empty($coupon)): ?>
                            <ul>
                            <?foreach($coupon as $key => $item):?>
                                <li><a href="<?php echo base_url()?>coupon/<?php echo $item->id;?>"><?php echo $item->code;?></a></li>
                            <?endforeach;?>
                            </ul>  
                            <?else:?>
                            暂无VIP专享!
                            <?endif;?>
                        </div>
                    </div>
                </div>
                <!-- 公告标签结束 -->
            </div>
        </div>
    </div>
    <!-- categorys end -->
    
    <!-- 精选品牌 开始-->
    <div class='container sway m-t-20'>
        <div class='left pull-left'>
            <a id="skin_pre" href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-left"></span></a>
        </div>
        <div class='right pull-right'>
            <a id="skin_next" href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
        <div class='list skin-content'>
        <?php if(isset($product_brand) && !empty($product_brand)): ?>
        <?foreach($product_brand as $key => $item):?>
            <?if($key%9 == 0):?>
                <?if($key>2):?>
                <ul id="<?php echo floor(($key+1)/9)?>" class='list-inline hide'>
                <?else:?>
                <ul id="<?php echo floor(($key+1)/9)?>" class='list-inline show'>
                <?endif;?>
            <?endif;?>
                <li item-index='<?php echo $item->id?>'>
                    <a target="_blank" href="<?php echo $item->id;?>" title='<?php echo $item->name?>'>
                        <img height="45" width="105" src='<?php echo $this->product_brand->pic($item->id)?>'>
                    </a>
                </li>
            <?if(($key+1)%9 == 0):?>
            </ul>
            <?endif;?>
        <?endforeach;?>
        <?else:?>
        <p style="text-align:center;">站长暂未挑选精选品牌！<p>
        <?endif;?>  
        </div>  
    </div>
    
    <!-- 精选品牌 结束-->
    <!-- 每日精选 开始-->
    <?php $CI =& get_instance(); ?>
    <?php $CI->load->model('product');?>
    <div class='container jingxuan'>
        <?if(isset($handpick_product) && !empty($handpick_product)):?>
        <div class='row'>
            <h3><span class='title'>每日精选</span><small class='subtitle'>精彩每一天</small></h3>
        </div>
        <div class='row'>
            <?if(isset($handpick_product[0]) && $handpick_product[0]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[0]->name;?></h4>
                    <!-- <div class="s-name">新品上市</div> -->
                    <div class="s-ext"><b>￥<?php echo $handpick_product[0]->price;?></b></div>
                    <!-- <ul class="s-hotword">
                        <li><i></i>更多品牌</li>
                        <li><i></i>进入品牌街</li>
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[0]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[0]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[1]) && $handpick_product[1]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6  item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[1]->name;?></h4>
                    <!-- <div class="s-name">NIKE休闲板鞋</div> -->
                    <div class="s-ext"><b>￥<?php echo $handpick_product[1]->price;?></b></div>
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[1]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[1]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[2]) && $handpick_product[2]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left w-bg'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[2]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[2]->price;?></b></div>
                    <!-- <div class="s-name">型男养成记</div>
                    <div class="s-ext"><b>￥天王表低至3折</b></div>
                    <ul class="s-hotword">
                        <li><i></i>型男休闲范儿</li>
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[2]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[2]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[3]) && $handpick_product[3]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item tuangou pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[3]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[3]->price;?></b></div>
                    <!-- <div class="s-name">3D电影票</div>
                    <div class="s-ext"><b>￥</b></div>
                    <a target="_blank" href="" class="s-tuangou"> 
                        <span class='t'>团购价</span>
                        <strong class='price'>￥9.9</strong>
                    </a> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[3]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[3]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
        </div>
        <div class='row'>
            <?if(isset($handpick_product[4]) && $handpick_product[4]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[4]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[4]->price;?></b></div>
                    <!-- <div class="s-name">三星NX系列镜</div>
                    <div class="s-ext"><b>￥首发下单赠礼</b></div>
                    <ul class="s-hotword">
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[4]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[4]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[5]) && $handpick_product[5]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[5]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[5]->price;?></b></div>
                    <!-- <div class="s-name">给宝宝的礼物</div>
                    <div class="s-ext"><b>￥低至2折</b></div>
                    <ul class="s-hotword">
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[5]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[5]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[6]) && $handpick_product[6]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[6]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[6]->price;?></b></div>
                    <<!-- div class="s-name">苹果联合首发</div>
                    <div class="s-ext"><b>￥全球限量预售</b></div>
                    <ul class="s-hotword">
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[6]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[6]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
            <?if(isset($handpick_product[7]) && $handpick_product[7]->id):?>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4><?php echo $handpick_product[7]->name;?></h4>
                    <div class="s-ext"><b>￥<?php echo $handpick_product[7]->price;?></b></div>
                    <!-- <div class="s-name">六一嘉年华</div>
                    <div class="s-ext"><b>￥玩趣青春</b></div>
                    <ul class="s-hotword">
                        <li><i></i>NB Kids</li>
                        <li><i></i>千趣会</li>
                        <li>...</li>
                    </ul> -->
                </div>
                <a href="<?php echo base_url()."item/id/".$handpick_product[7]->id;?>"><img style="height:190px;width:99%;padding-right:1%" src="<?php echo $CI->product->pic($handpick_product[7]->id,1,'thumb')?>"></a>
            </div>
            <?endif;?>
        </div>
        <?endif;?>
    </div>
    <!-- 每日精选 结束-->

    <!-- 商品分类楼层 开始-->
    <?php if(isset($product_cate) && !empty($product_cate)): ?>
        <?foreach($product_cate as $key => $item):?>
            <!-- 开放三个楼层,修改楼层数量显示，后台要相应加热门商品数据 -->
            <?if($key == $show_count)
                break;
            ?>
            <!-- 顶级分类 -->
            <div class='container <?php if($key == 0):?><?php echo 'm-t-20';?><?endif;?>' id='f<?php echo $key+1;?>'>
                <div class='row' id='title'>
                    <div class='col-md-2 col-no-padding'>
                        <span class="label floor-sign"><?php echo $key+1;?> F</span>
                        <span class='floor-name'><?php echo $item['name'];?></span>
                    </div>
                    <div class='col-md-8 col-no-padding'>
                        <ul id="list-tab" class="nav nav-pills" role="tablist">
                            <li class=""><a href="#home2" role="tab" class="text-center" data-toggle="tab">爆品疯抢</a></li>
                            <li class=""><a href="#profile2" role="tab" class="text-center" data-toggle="tab">新品专区</a></li>
                            <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">特价商品</a></li>
                            <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">热卖推荐</a></li>
                            <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">好评商品</a></li>
                        </ul>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-2 relative' id='left'>
                        <div class='row' >
                            <div style="margin: 0px 10px;">
                                <div class="sy_mod_key">
                                    <!-- 二级商品分类开始 -->
                                    <?php if(isset($item['child']) && !empty($item['child'])): ?>
                                    <?foreach($item['child'] as $k => $i):?>
                                    <?if($k >= 4):?>
                                    <?break;?>
                                    <?endif;?>
                                    <dl class="sy_mod_key_dl">
                                        <dt><a href="<?php echo base_url().'category/index/cate_id/'.$i['id']?>" target="_blank"><?php echo $i['name'];?></a></dt>
                                        <dd>
                                            <!-- 三级商品分类开始 -->
                                            <?php if(isset($i['child']) && !empty($i['child'])): ?>
                                            <?foreach($i['child'] as $k3 => $v):?>
                                                <?if($k >= 4):?>
                                                <?break;?>
                                                <?endif;?>
                                                <a href="<?php echo base_url().'/category/'.$v['id']?>" target="_blank"><?php echo $v['name'];?></a>
                                            <?endforeach;?>
                                            <?endif;?>
                                            <!-- 三级商品分类结束 -->
                                        </dd>
                                    </dl>
                                    <?endforeach;?>
                                    <?endif;?>
                                    <!-- 二级商品分类结束 -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class='bottom'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/2f.png"></a>
                        </div> -->
                    </div>
                    <div class='col-md-8 col-no-padding' id='list'>
                        <div id='list1'>
                            <?php if(isset($item['hot_product']) && !empty($item['hot_product'])): ?>
                                <?foreach($item['hot_product'] as $k => $i):?>
                            <div class='item pull-left'>
                                <div class='img'>
                                    <a><img class='img-responsive' src="<?php echo $CI->product->pic($i->product_id,1,'thumb')?>"></a>
                                </div>
                                <div class='name'>
                                    <a><?php echo $i->name;?></a>
                                </div>
                                <div class='price'>
                                    <span>￥</span><?php echo $i->price;?></span>
                                </div>
                            </div>
                                <?endforeach;?>
                            <?else:?>
                            <p style="text-align:center;vertical-align:middle;">站长暂未设置首页展示商品，在创建商品时勾选首页展示，便可以在此展示。</p>
                            <?endif;?>
                        </div>
                    </div>
                    <div class='col-md-2 col-no-padding' id='right'>
                        <?php if(isset($item['product_cate_brand']) && !empty($item['product_cate_brand'])): ?>
                            <ul class="nav">
                            <?foreach($item['product_cate_brand'] as $k => $i):?>
                            <li>
                                <a href="<?php echo base_url()."category/index/cate_id/".$i->product_cate_id;?>"><img class='img-responsive pull-right' src='<?php echo $this->product_brand->pic($i->id)?>'></a>
                            </li>
                            <?endforeach;?>
                            </ul>
                        <?else:?>
                        暂无品牌显示，可以在品牌设置关联商品分类
                        <?endif;?>
                    </div>
                </div>
            </div>
            <!-- 顶级分类结束 -->
        <?endforeach;?>
    <?endif;?>
    <!-- 商品分类楼层 结束-->
    
    <div class='container m-b-20' id='ad-footer'>
        <div class='row'>
            <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
        </div>
    </div>
<?$this->load->view('home/footer')?>
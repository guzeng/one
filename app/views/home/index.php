<?$this->load->view('home/header')?>
<style type="text/css">
    /*.mod_cate{position:relative;z-index:600;margin-top:-1px;float:left;width:190px;height:40px;background-color:#4593fd;box-shadow:2px -1px 3px rgba(55,55,55,.5)}.mod_cate a{color:#fff}.mod_cate a:hover{color:#fff}.mod_cate_on .mod_cate_hd{border-color:#3586f2}.mod_cate_on .mod_cate_bd{display:block}.mod_cate_on .mod_cate_hd_arrow{visibility:hidden}
    .mod_subcate{position:absolute;display:none;z-index:4;left:188px;top:40px;color:#333;width:798px;height:626px;border:2px solid #4594fd;background-color:#fff;box-shadow:5px 5px 10px rgba(55,55,55,0.4);overflow:hidden}.mod_subcate a{color:#666}.mod_subcate a:hover{color:#333}.mod_subcate_item{position:relative;width:801px;zoom:1;overflow:hidden}.mod_subcate_main{float:left;width:530px;padding:0 20px;border-right:1px solid #ddd;padding-bottom:1000px;margin-bottom:-1000px}.mod_subcate_side{float:left;width:230px;padding-bottom:1000px;margin-bottom:-1000px}.mod_subcate_gg{clear:both;position:absolute;bottom:0;right:0;_right:-1px;_bottom:-1px}.mod_subcate_main dl{zoom:1;overflow:hidden;padding:10px 0 10px 65px;border-bottom:1px solid #e5e5e5}.mod_subcate_main dt{float:left;#display:inline;margin-left:-65px;width:65px;font:700 12px/22px tahoma;color:#1d7ad9}.mod_subcate_main dd{overflow:hidden;zoom:1;line-height:22px}.mod_subcate_main dd a{display:inline;float:left;margin-left:5px;margin-right:5px;white-space:nowrap}.mod_subcate_main dd .hl,.mod_subcate_main dd .hl:hover{color:#ff7300}.mod_subcate_dotline{clear:both;display:block;width:100%;height:1px;margin-bottom:5px;font-size:0;overflow:hidden;border-top:5px solid #fff;border-bottom:1px dotted #dadada}.mod_subcate_channel{clear:both;margin-top:15px;padding-bottom:20px}
    */
</style>
    <!-- categorys  -->
    <div class='container'>
        <div class='row'>
            <div id='category' class='col-lg-2 col-md-3 col-no-padding mod_cate mod_on' >
                <?php if(isset($product_cate) && !empty($product_cate)): ?>
                    <?foreach($product_cate as $key => $item):?>
                        <!-- 顶级分类 -->
                        <div class='item' style="position:relative;">
                            <a><?php echo $item['name'];?></a>
                            <span class="more">></span>
                            <?php if(isset($item['child']) && !empty($item['child'])): ?>
                            <?foreach($item['child'] as $k => $i):?>
                                <!-- 二级分类 -->
                                <div style="position:absultion">
                                    <a><?php echo $i['name'];?></a>
                                    <!-- 三级分类 -->
                                    <?php if(isset($i['child']) && !empty($i['child'])): ?>
                                    <?foreach($i['child'] as $k3 => $v):?>
                                        <div style="position:absultion">
                                            <a><?php echo $v['name'];?></a>
                                            
                                        </div>
                                    <?endforeach;?>
                                    <?endif;?>
                                </div>
                            <?endforeach;?>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                <?endif;?>
               
                <div class='item'>
                    <span><a>家居</a></span>、
                    <span><a>家具</a></span>、
                    <span><a>家装</a></span>、
                    <span><a>厨具</a></span>
                    <span class="more">></span>
                </div>
                <!-- <div id="second_list" class="mod_subcate" style="display: block; top: 40px; overflow: hidden; height: 597px;">
                    <div id="panel0" class="mod_subcate_item" index="0" style="display: block;">
                        <div class="mod_subcate_main">
                            <dl>
                                <dt>手机通讯</dt>
                                <dd>
                                    <a r="true" ytag="85050" href="http://searchex.yixun.com/html?path=705852t705856" class="" target="_blank">全部手机</a>
                                    <a r="true" ytag="85051" href="http://searchex.yixun.com/html?path=705852t705854" class="" target="_blank">对讲机</a>
                                    <a r="true" ytag="85052" href="http://searchex.yixun.com/html?path=705938t705943" class="" target="_blank">3G上网卡</a>
                                    <a r="true" ytag="85053" href="http://searchex.yixun.com/html?path=705852t705856t707217&amp;attr=42617e25o27o28o31&amp;area=1&amp;so" class="" target="_blank">中国移动</a>
                                    <a r="true" ytag="85054" href="http://searchex.yixun.com/html?path=705852t705856t707217&amp;attr=42617e29o32&amp;area=1&amp;sort=0&amp;s" class="" target="_blank">中国电信</a>
                                    <a r="true" ytag="85055" href="http://searchex.yixun.com/html?path=705852t705856t707217&amp;attr=42617e30o31&amp;area=1&amp;sort=0&amp;s" class="" target="_blank">中国联通</a>
                                    <s class="mod_subcate_dotline"></s>
                                    <a r="true" ytag="85056" href="http://searchex.yixun.com/html?attr=55e5686&amp;path=705852t705856" class="" target="_blank">三星</a>
                                    <a r="true" ytag="85057" href="http://searchex.yixun.com/html?path=706188t706189" class="hl" target="_blank">苹果</a>
                                    <a r="true" ytag="85058" href="http://searchex.yixun.com/html?attr=55e5865&amp;path=706188t705856" class="" target="_blank">华为</a>
                                    <a r="true" ytag="85059" href="http://searchex.yixun.com/html?attr=55e7355&amp;path=705852t705856" class="hl" target="_blank">小米</a>
                                    <a r="true" ytag="85060" href="http://searchex.yixun.com/html?&amp;attr=55e5705&amp;path=705852t705856" class="" target="_blank">诺基亚</a>
                                    <a r="true" ytag="85061" href="http://searchex.yixun.com/html?&amp;attr=55e5707&amp;path=705852t705856" class="" target="_blank">联想</a>
                                    <a r="true" ytag="85062" href="http://searchex.yixun.com/html?&amp;attr=55e5776&amp;path=705852t705856" class="" target="_blank">HTC</a>
                                    <a r="true" ytag="85063" href="http://searchex.yixun.com/html?&amp;attr=55e3614&amp;path=705852t705856" class="" target="_blank">索尼</a>
                                    <a r="true" ytag="85064" href="http://searchex.yixun.com/html?&amp;attr=55e6824&amp;path=705852t705856" class="" target="_blank">酷派</a>
                                    <a r="true" ytag="85065" href="http://searchex.yixun.com/html?&amp;attr=55e3370&amp;path=705852t705856" class="" target="_blank">海尔</a>
                                    <a r="true" ytag="85066" href="http://searchex.yixun.com/html?attr=55e6393&amp;path=705852t705856" class="" target="_blank">OPPO</a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class='col-lg-7 col-p-10 m-t-10 o-h'>
                <div class='m-b-10 ad-top'>
                    <img src="<?php echo base_url()?>assets/img/home/i.png" class="img-responsive">
                </div>
                <div class='ad-top'>
                    <table class="table table-bordered ad-table" >
                        <tbody>
                            <tr>
                                <td width='33.3%'>
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
                                <td width='33.3%'>
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
                                <td width='33.3%'>
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
            </div>
            <div class='col-lg-3 col-no-padding m-t-10'>
                <div id='userinfo'>
                    <div class='pull-left'>
                        <img class="img-circle" src="<?php echo base_url();?>assets/img/home/user.png" >
                    </div>
                    <div class='pull-left username'>
                        <div>Hi,Bevis </div>
                        <div>170ES达人</div>
                    </div>
                    <div class='clearfix'></div>
                </div>
                <div id='info-detail' class='m-b-10'>
                    <div class=''>
                        <div class='col-md-4 info-items'>
                            <div class='text-center item'>
                                <div class='p-t-10 p-b-10'>5</div>
                                <div>购物车</div>
                            </div>
                        </div>
                        <div class='col-md-4 info-items'>
                            <div class=' text-center item'>
                                <div class='p-t-10 p-b-10'>8</div>
                                <div>我的订单</div>
                            </div>
                        </div>
                        <div class='col-md-4 info-items'>
                            <div class=' text-center item'>
                                <div class='p-t-10 p-b-10'>47</div>
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
                                <li><a href="news/<?php echo $item->id;?>"><?php echo $item->title;?></a></li>
                            <?endforeach;?>
                            </ul>  
                            <?else:?>
                            暂无公告!
                            <?endif;?>  
                            <!-- 公告 end-->
                        </div>
                        <div id="profile" class="tab-pane fade active in">
                            <ul>
                                <li>白金、钻石VIP优先配送</li>
                                <li>VIP专享活动规则</li>
                                <li>会员等级制度</li>
                                <li>每用户会员个人限购定义</li>
                                <li>餐厨用品购买说明</li>
                            </ul>
                        </div>
                        <div id="profile1" class="tab-pane fade">
                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div>
                    </div>
                </div>
                <!-- 公告标签结束 -->
            </div>
        </div>
    </div>
    <!-- categorys end -->

    <div class='container sway'>
        <div class='left pull-left'>
            <span class="glyphicon glyphicon-chevron-left"></span>
        </div>
        <div class='right pull-right'>
            <span class="glyphicon glyphicon-chevron-right"></span>
        </div>
        <div class='list'>
            <img src="<?php echo base_url()?>assets/img/home/sway-1.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-2.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-3.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-4.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-5.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-6.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-7.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-8.png">
            <img src="<?php echo base_url()?>assets/img/home/sway-9.png">
            <img class='last' src="<?php echo base_url()?>assets/img/home/sway-10.png">
        </div>
    </div>
    <div class='container jingxuan'>
        <div class='row'>
            <h3><span class='title'>每日精选</span><small class='subtitle'>精彩每一天</small></h3>
        </div>
        <div class='row'>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>品牌街</h4>
                    <div class="s-name">新品上市</div>
                    <div class="s-ext"><b>领50元优惠券</b></div>
                    <ul class="s-hotword">
                        <li><i></i>更多品牌</li>
                        <li><i></i>进入品牌街</li>
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-1.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6  item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>天天低价</h4>
                    <div class="s-name">NIKE休闲板鞋</div>
                    <div class="s-ext"><b>288元秒杀</b></div>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-2.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left w-bg'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>精品周刊</h4>
                    <div class="s-name">型男养成记</div>
                    <div class="s-ext"><b>天王表低至3折</b></div>
                    <ul class="s-hotword">
                        <li><i></i>型男休闲范儿</li>
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-3.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6 item tuangou pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>今日团购</h4>
                    <div class="s-name">3D电影票</div>
                    <div class="s-ext"><b></b></div>
                    <a target="_blank" href="" class="s-tuangou"> 
                        <span class='t'>团购价</span>
                        <strong class='price'>￥9.9</strong>
                    </a>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-4.jpg"></a>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>首发</h4>
                    <div class="s-name">三星NX系列镜</div>
                    <div class="s-ext"><b>首发下单赠礼</b></div>
                    <ul class="s-hotword">
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-5.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>品牌特卖</h4>
                    <div class="s-name">给宝宝的礼物</div>
                    <div class="s-ext"><b>低至2折</b></div>
                    <ul class="s-hotword">
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-6.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6 item pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>预售</h4>
                    <div class="s-name">苹果联合首发</div>
                    <div class="s-ext"><b>全球限量预售</b></div>
                    <ul class="s-hotword">
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-7.jpg"></a>
            </div>
            <div class='col-md-3 col-sm-3 col-xs-6 item w-bg pull-left'>
                <div class="aside">
                    <a href="" target="_blank" class="s-link"></a>
                    <h4>青春国际</h4>
                    <div class="s-name">六一嘉年华</div>
                    <div class="s-ext"><b>玩趣青春</b></div>
                    <ul class="s-hotword">
                        <li><i></i>NB Kids</li>
                        <li><i></i>千趣会</li>
                        <li>...</li>
                    </ul>
                </div>
                <a><img src="<?php echo base_url()?>assets/img/home/jx-8.jpg"></a>
            </div>
        </div>
    </div>
    <!-- 1F -->
    <div class='container m-t-20' id='f1'>
        <div class='row' id='title'>
            <div class='col-md-2 col-no-padding'>
                <span class="label floor-sign">1F</span>
                <span class='floor-name'>服饰箱包</span>
            </div>
            <div class='col-md-8 col-no-padding'>
                <ul id="list-tab" class="nav nav-pills" role="tablist">
                    <li class=""><a href="#home2" role="tab" class="text-center" data-toggle="tab">特价商品</a></li>
                    <li class=""><a href="#profile2" role="tab" class="text-center" data-toggle="tab">品牌男装</a></li>
                    <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">品牌女装</a></li>
                    <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">鞋靴箱包</a></li>
                    <li class=""><a href="#profile12" role="tab" class="text-center" data-toggle="tab">运动户外</a></li>
                </ul>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-2 relative col-no-padding' id='left'>
                <ul >
                    <li><a href="">男装</a></li>
                    <li><a href="">女装</a></li>
                    <li><a href="">服装配饰</a></li>
                    <li><a href="">内衣</a></li>
                    <li><a href="">童装</a></li>
                    <li><a href="">男鞋</a></li>
                    <li><a href="">女鞋</a></li>
                    <li><a href="">功能箱包</a></li>
                    <li><a href="">潮流女包</a></li>
                    <li><a href="">时尚男包</a></li>
                    <li><a href="">户外鞋服</a></li>
                    <li><a href="">户外装备</a></li>
                    <li><a href="">运动器械</a></li>
                    <li><a href="">运动服饰</a></li>
                </ul>
                <span>
                    <a><img class='img-responsive' src='<?php echo base_url()?>assets/img/home/1f.jpg'></a>
                </span>
            </div>
            <div class='col-md-8 col-no-padding' id='list'>
                <div id='list1'>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-1.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-2.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-3.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-4.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-5.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-6.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-7.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-8.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-9.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-10.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-2 col-no-padding' id='right'>
                <img class='img-responsive pull-right' src='<?php echo base_url()?>assets/img/home/1f-111.png'>
            </div>
        </div>
    </div>
    <!-- 1F end -->
    <!-- 2F -->
    <div class='container' id='f2'>
        <div class='row' id='title'>
            <div class='col-md-2 col-no-padding'>
                <span class="label floor-sign">2 F</span>
                <span class='floor-name'>电脑数码</span>
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
            <div class='col-md-2 relative col-no-padding' id='left'>
                <div class='row' >
                    <div class='col-md-6 el'><a href="">男装</a></div>
                    <div class='col-md-6 el'><a href="">女装</a></div>
                    <div class='col-md-6 el'><a href="">服装配饰</a></div>
                    <div class='col-md-6 el'><a href="">内衣</a></div>
                    <div class='col-md-6 el'><a href="">童装</a></div>
                    <div class='col-md-6 el'><a href="">男鞋</a></div>
                    <div class='col-md-6 el'><a href="">女鞋</a></div>
                    <div class='col-md-6 el'><a href="">功能箱包</a></div>
                    <div class='col-md-6 el'><a href="">潮流女包</a></div>
                    <div class='col-md-6 el'><a href="">时尚男包</a></div>
                    <div class='col-md-6 el'><a href="">户外鞋服</a></div>
                    <div class='col-md-6 el'><a href="">户外装备</a></div>
                    <div class='col-md-6 el'><a href="">运动器械</a></div>
                    <div class='col-md-6 el'><a href="">运动服饰</a></div>
                </div>
                <div class='bottom'>
                    <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/2f.png"></a>
                </div>
            </div>
            <div class='col-md-8 col-no-padding' id='list'>
                <div id='list1'>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-1.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-2.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-3.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-4.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-5.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-6.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-7.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-8.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-9.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-10.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-2 col-no-padding' id='right'>
                <img class='img-responsive pull-right' src='<?php echo base_url()?>assets/img/home/1f-111.png'>
            </div>
        </div>
    </div>
    <!-- 2F end -->
    <!-- 3F -->
    <div class='container' id='f3'>
        <div class='row' id='title'>
            <div class='col-md-2 col-no-padding'>
                <span class="label floor-sign">3F</span>
                <span class='floor-name'>居家生活</span>
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
            <div class='col-md-2 relative col-no-padding' id='left'>
                <div class='row' >
                    <div class='col-md-6 el'><a href="">男装</a></div>
                    <div class='col-md-6 el'><a href="">女装</a></div>
                    <div class='col-md-6 el'><a href="">服装配饰</a></div>
                    <div class='col-md-6 el'><a href="">内衣</a></div>
                    <div class='col-md-6 el'><a href="">童装</a></div>
                    <div class='col-md-6 el'><a href="">男鞋</a></div>
                    <div class='col-md-6 el'><a href="">女鞋</a></div>
                    <div class='col-md-6 el'><a href="">功能箱包</a></div>
                    <div class='col-md-6 el'><a href="">潮流女包</a></div>
                    <div class='col-md-6 el'><a href="">时尚男包</a></div>
                    <div class='col-md-6 el'><a href="">户外鞋服</a></div>
                    <div class='col-md-6 el'><a href="">户外装备</a></div>
                    <div class='col-md-6 el'><a href="">运动器械</a></div>
                    <div class='col-md-6 el'><a href="">运动服饰</a></div>
                </div>
                <div class='bottom'>
                    <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/2f.png"></a>
                </div>
            </div>
            <div class='col-md-8 col-no-padding' id='list'>
                <div id='list1'>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-1.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-2.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-3.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-4.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-5.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-6.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-7.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-8.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-9.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                    <div class='item pull-left'>
                        <div class='img'>
                            <a><img class='img-responsive' src="<?php echo base_url()?>assets/img/home/1f-10.png"></a>
                        </div>
                        <div class='name'>
                            <a>欧时力夏装纯棉条纹连衣裙</a>
                        </div>
                        <div class='price'>
                            <span>￥</span>149.<span>00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-2 col-no-padding' id='right'>
                <img class='img-responsive pull-right' src='<?php echo base_url()?>assets/img/home/1f-111.png'>
            </div>
        </div>
    </div>
    <!-- 3F end -->
    <div class='container m-b-20' id='ad-footer'>
        <div class='row'>
            <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
        </div>
    </div>
<?$this->load->view('home/footer')?>
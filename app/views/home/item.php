<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/scripts/home/item.js" type="text/javascript"></script>
<div class='container'>
    <?if(isset($category)):?>
    <div class='row'>
        <ol class="breadcrumb top-bar">
            <?if(isset($parent)):?><li><?php echo $parent->name?></li><?endif;?>
            <li class="active"><?php echo $category->name?></li>
        </ol>
    </div>
    <?endif;?>
</div>
<div class='container m-b-20'>
    <div class='row'>
        <div class='col-md-10 col-sm-10 col-xs-12 pinfo-top-left'>
            <div class='row'>
                <div class='col-md-5 col-sm-5 col-xs-12 '>
                    <div class='img'>
                        <div class='m-b-20'>
                            <img src="<?php echo $this->product->pic($product->id)?>" id='item_img' class='img-responsive'>
                        </div>
                        <div class='text-center m-b-20'>
                            <div class='pinfo-s m-r-10 active'>
                                <img src="<?php echo $this->product->pic($product->id,1,'thumb')?>" class='item-thumb img-responsive'>
                            </div>
                            <div class='pinfo-s m-r-10 '>
                                <img src="<?php echo $this->product->pic($product->id,2,'thumb')?>" class='item-thumb img-responsive'>
                            </div>
                            <div class='pinfo-s m-r-10'>
                                <img src="<?php echo $this->product->pic($product->id,3,'thumb')?>" class='item-thumb img-responsive'>
                            </div>
                            <div class='pinfo-s m-r-10'>
                                <img src="<?php echo $this->product->pic($product->id,4,'thumb')?>" class='item-thumb img-responsive'>
                            </div>
                            <div class='pinfo-s'>
                                <img src="<?php echo $this->product->pic($product->id,5,'thumb')?>" class='item-thumb img-responsive'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-7 col-sm-7 col-xs-12 p-r-0'>
                    <div class='title'>
                        <?php echo $product->name?>
                    </div>
                    <div class='price row'>
                        <div class='col-md-2 t'>促销价</div>
                        <div class='col-md-10 p'>
                            <div class='m-b-10'>
                                <span class='org'>￥<?php echo sprintf('%.2f',$product->price)?></span>
                                <span class='des'>卖家优惠</span>
                            </div>
                            <div class='last'>
                                一口价 ￥<?php echo sprintf('%.2f',$product->best_price)?>
                            </div>
                        </div>
                    </div>
                    <div class='ship-info'>配送范围：新会市区付款后三小时内送达</div>
                    <div class='row info m-b-20'>
                        <div class='col-md-4 col-sm-4 col-xs-4 b-r text-center'>
                            <div class='f-green m-b-10'><strong><?php echo $product->sale_num?></strong></div>
                            <div>销量</div>
                        </div>
                        <div class='col-md-4 col-sm-4 col-xs-4 b-r text-center'>
                            <div class='f-red m-b-10'><strong><?php echo $product->comment_num?></strong></div>
                            <div>累计评价</div>
                        </div>
                        <div class='col-md-4 col-sm-4 col-xs-4 text-center'>
                            <div class='f-blue m-b-10'><strong><?php echo $product->score?></strong></div>
                            <div>送积分</div>
                        </div>
                    </div>
                    <div class='row m-b-20'>
                        <div class='col-md-2'>分类</div>
                        <div class='col-md-10'>
                            <?php echo $category->name?>
                        </div>
                    </div>
                    <div class='row m-b-20 h-35'>
                        <div class='col-md-2'>数量</div>
                        <div class='col-md-10 '>
                            <div class="pinfo">
                                <input type="text" name='cart_num' value="<?php echo $product->min_num>0?$product->min_num:1;?>" class=" form-control">
                                <button class="btn btn-default plus" onclick="cart_count('plus',this)">+</button>
                                <button class="btn btn-default minus" onclick="cart_count('minus',this)">-</button>
                                <input type='hidden' id='min_num' name='min_num' value='<?php echo $product->min_num?>' >
                            </div>
                        </div>
                    </div>
                    <div class='row m-b-20'>
                        <div class='col-md-2'></div>
                        <div class='col-md-10'>
                            <button class='btn btn-warning btn-buy m-r-10'>立即购买</button>
                            <button class='btn btn-success btn-shopcart'>
                                <span class="glyphicon glyphicon-shopping-cart"></span> 加入购物车
                            </button>
                        </div>
                    </div>
                    <div class='row m-b-20'>
                        <div class='col-md-2'>服务承诺</div>
                        <div class='col-md-10 promise'>无理由退换</div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-md-2 col-sm-2 col-xs-12 pinfo-top-right'>			
            <div class="see2see">
                <div class="midline">
                    <div class="midtext">看了又看</div>
                </div>
            </div>
            <div class="img relative" id='see_again'>
                <?if(!empty($view_again)):?>
                <?foreach($view_again as $key => $item):?>
                    <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
                    <img class='img-responsive' src="<?php echo $this->product->pic($item->id)?>">
                    </a>
                <?endforeach;?>
                <?endif;?>
                    <a href="<?php echo base_url()?>item/id/<?php echo $product->id?>" >
                    <img class='img-responsive' src="<?php echo $this->product->pic($product->id)?>">
                    </a>
                    <a href="<?php echo base_url()?>item/id/<?php echo $product->id?>" class='hide'>
                    <img class='img-responsive' src="<?php echo $this->product->pic($product->id)?>">
                    </a>
            </div>
            <div class="nav">
                <span class="pull-left hand" onclick="item_go('up')">
                    <img class='img-responsive' src="<?php echo base_url();?>assets/img/portlet-expand-icon2.png"></span>
                <span class="pull-left hand" onclick="item_go('down')">
                    <img class='img-responsive' src="<?php echo base_url();?>assets/img/portlet-collapse-icon2.png"></span>
            </div>
        </div>
    </div>
</div>
<div class='container'>
    <div class='row'>
        <!-- left -->
        <div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 col-no-padding'>
            <ul class="list-group m-b-10">
                <?if(isset($child) && !empty($child)):?>
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
                    <?if(!empty($goodsale)):?>
                    <?foreach($goodsale as $key => $item):?>
                    <li>
                        <div class='img pull-left'>
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
                            <img src="<?php echo $this->product->pic($item->id,1,'thumb')?>" class='img-responsive'>
                            </a>
                        </div>
                        <div class='name'>
                            <div class=' '>
                                <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
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
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
                            <img src="<?php echo $this->product->pic($item->id,1,'thumb')?>" class='img-responsive'>
                            </a>
                        </div>
                        <div class='m-b-10'>
                            <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
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
        
        <div class='col-lg-8 col-md-7 col-sm-7 col-xs-12 '>
            <div class="pro-x">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#home" role="tab" data-toggle="tab">商品详情</a>
                    </li>
                    <li class="">
                        <a href="#profile" role="tab" data-toggle="tab">
                            累计评价
                            <span class="coun"><?php echo $product->comment_num?></span>
                        </a>
                    </li><li>
                     <a href="#dropdown1" role="tab" data-toggle="tab">
                        服务承诺</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">

                    <table width="100%" border="0">
                      <tr>
                        <td width="106">品牌名称：</td>
                        <td><?php echo $brand_name?></td>
                      </tr>
                    </table>
                    <hr>
                    <table width="100%" border="0">
                      <tr>
                        <td width="108">产品参数：</td>
                        <td width="265">款号：1479396</td>
                        <td width="165">材质：锦纶</td>
                        <td>尺码：均码（高弹）</td>
                      </tr>
                      <tr>
                        <td >&nbsp;</td>
                        <td>颜色分类：绿色048 红色037 灰色084 </td>
                        <td>图案: 其他</td>
                        <td>尺码: 均码（高弹）</td>
                      </tr>
                      <tr>
                        <td >&nbsp;</td>
                        <td>衣长: 及胸</td>
                        <td>服装款式细节: 印花</td>
                        <td>价格区间: 50元以上</td>
                      </tr>
                    </table>

                    <div class="tab-pane fade" id="profile">
                        
                    </div>
                    <div class="tab-pane fade" id="dropdown1">
                        
                    </div>                   
                </div>
            </div>
            <div class="item-xq-img">
                <?php echo $item->info?>
            </div>
        </div>
        <div class='col-md-2 col-sm-2 col-xs-12 pinfo-mid-right ad-box'>
            <div class="ad">
                <div class="midline">
                    <div class="midtext">广告位</div>
                </div>
            </div>
            <div class="img">
                <img class='img-responsive' src="<?php echo base_url();?>assets/img/home/item-r1.jpg">
                <img class='img-responsive' src="<?php echo base_url();?>assets/img/home/item-r2.jpg">
                <img class='img-responsive' src="<?php echo base_url();?>assets/img/home/item-r3.jpg">
            </div>

            <!-- right end --> 
        </div>
    </div>

    <div class='container m-b-20' id='ad-footer'>
        <div class='row'>
            <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
        </div>
    </div>
</div>
    <?$this->load->view('home/footer')?>
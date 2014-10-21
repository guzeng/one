<?$this->load->view('home/header-cart')?> 
<div id="mycart">
  <div class='container m-t-20 m-b-20' > 
    <div class='row'>
      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="order-tab">
            <h5 class="page-title">
  				<span>我的购物车</span>
  			</h5>
            <?php if(isset($list) && !empty($list)):?>
            <div id="myTabContent" class="tab-content">
                <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                    	<th width="90"> <label class="left"><input type="checkbox"> 全选</label> </th>
                      <th width="460">商品</th>
                      <th width="160">价格</th>
                      <th width="120">优惠</th>
                      <th width="150">数量</th>
                      <th width="140">操作</th>  
                    </tr>
                </thead>
                <tbody> 
                    <?php $total_price = $total_best_price = 0;?>
                    <?php foreach ($list as $key => $value) :?>
                        <?php $total_price+=$value['price']*$value['count']; $total_best_price+=$value['best_price']*$value['count'];?>
                        <tr  id='cart_row_<?php echo $value['product_id']?>'>
                        <td >
                            <div class="left"><span class="select-item">
                            <input value="option1" id="inlineCheckbox1" type="checkbox"> 
                            <a href="<?php echo base_url()?>item/id/<?php echo $value['product_id']?>" target='_blank'>
                            <img class='box' src="<?php echo $this->product->pic($value['product_id'],'thumb');?>" width='48' height='48'>
                            </a>
                            </span></div>
                        </td> 
                        <td>
                            <div class="left pro-title">
                                <a href="<?php echo base_url()?>item/id/<?php echo $value['product_id']?>" target='_blank'>
                                <?php echo $value['name']?></a>
                            </div>  
                            <?php if(isset($value['category']) && !empty($value['category'])):?>
                            <div class="left pro-title"><?php echo $value['category']->parent_name;?> <?php echo $value['category']->name;?></div>
                            <?php endif;?>
                            <div class="pro-mark">[赠品] 50元电子京券（订单完成后自动发放）</div>
                        </td>
                        <td><span class="pro-price">&#165;<?php echo round($value['price'],2)?></span></td> 
                        <td><sapn class="pro-price2">&#165;<?php echo round($value['price'],2)-round($value['best_price'],2)?></sapn></td> 
                        <td>
                            <div class="pinfo">
                              <input type="text" name="cart_num" product="<?php echo $value['product_id']?>" value="<?php echo $value['count']?>" class=" form-control">
                              <button class="btn btn-default plus" onclick="cart_count('plus',this,'cart')">+</button>
                              <button class="btn btn-default minus" onclick="cart_count('minus',this,'cart')">-</button>
                              <input type="hidden" name="min_num" value="<?php echo $value['min_num']?>">
                            </div>
                        </td> 
                        <td>
                            <a herf="javascript:void(0)" onclick="confirm_dialog('<?php echo $this->lang->line('delete_confirm')?>', '<?php echo $this->lang->line('sure_to_delete')?>', delCart, '<?php echo $value['product_id']?>')">删除</a>
                        </td>
                        </tr>
                    <?php endforeach;?>
                    <tr>
                        <td ><div class="left"><label class="left"><input type="checkbox"> 全选</label> </div></td> 
                        <td><div class="left"><i class="fa fa-trash-o"></i> 清空</div></td>
                        <td></td> 
                        <td>
                        </td> 
                        <td>
                            <div class="total m-b-5"><span class="num"><?php echo count($list)?></span> 件商品 总计：</div>
                            <div class="total">优惠：</div>
                        </td>
                        <td>
                            <div class="m-b-5">&#165;<span id='total_price'><?php echo round($total_price,2);?></span></div>
                            <div class="">&#165;<span id='total_best_price'><?php echo round($total_price,2)-round($total_best_price,2);?></span></div>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div class="toorder">总计( 不含运费 ) :<span class="order_price">&#165;<span id='order_price'><?php echo round($total_best_price,2);?></span></span><button type="button" class="btn btn-danger">去结算</button></div>
                
                <div class="tab-pane fade" id="profile"></div>
                <div class="tab-pane fade" id="dropdown1"></div> 
            </div> 
            <?php endif;?>  
            
            <p class="m-t-20 m-b-20 text-center <?php if(isset($list) && !empty($list)):?>hide<?php endif;?>" id='cart-empty'>购物车为空，继续购买商品 <a href="<?php echo base_url();?>">商城首页</a></p>  
              
        </div>
      </div>  
    </div>
  </div>
  <div class="container">  
     <div id="recommend">
      <div class="title">购买了同样商品的顾客还购买了</div>
          <div class="img">
            
              <div class="text-center m-b-20">
                  <div class="pinfo-s m-r-5 ">
                      <img src="<?php echo base_url();?>assets/img/home/recommend1.jpg" class="item-thumb img-responsive">
                      <div class="recommend-title">test</div>
                      <div class="recommend-price">&#165;998.00</div>
                  </div>
                  <div class="pinfo-s m-r-5">
                      <img src="<?php echo base_url();?>assets/img/home/recommend1.jpg" class=" img-responsive">
                      <div class="recommend-title">test</div>
                      <div class="recommend-price">&#165;998.00</div>
                  </div>
                  <div class="pinfo-s m-r-5">
                      <img src="<?php echo base_url();?>assets/img/home/recommend1.jpg" class="item-thumb img-responsive">
                      <div class="recommend-title">test</div>
                      <div class="recommend-price">&#165;998.00</div>
                  </div>
                  <div class="pinfo-s m-r-5">
                      <img src="<?php echo base_url();?>assets/img/home/recommend1.jpg" class="item-thumb img-responsive">
                      <div class="recommend-title">test</div>
                      <div class="recommend-price">&#165;998.00</div>
                  </div>
                  <div class="pinfo-s">
                      <img src="<?php echo base_url();?>assets/img/home/recommend1.jpg" class="item-thumb img-responsive">
                      <div class="recommend-title">test</div>
                      <div class="recommend-price">&#165;998.00</div>
                  </div>
              </div>
          </div>
        </div>
    </div>
  </div>


<div class='container m-b-20' id='ad-footer'>
  <div class=''>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
<?$this->load->view('home/header-cart')?> 
<div id="mycart">
  <div class='container m-t-20' > 
    <div class='row'>
      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="order-tab">
          <h5 class="page-title">
  					<span>我的购物车</span>
  				</h5>
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
                    <?php foreach ($list as $key => $value) :?>
                    <tr>
                    <td >
                        <div class="left"><span class="select-item">
                        <input value="option1" id="inlineCheckbox1" type="checkbox"> <img class='box' src="<?php echo base_url();?>assets/img/home/cart-item.jpg">
                        </span></div>
                    </td> 
                    <td><div class="left pro-title"><?php echo $value['name']?></div>  <div class="left pro-title">个性休闲 裙子</div><div class="pro-mark">[赠品] 50元电子京券（订单完成后自动发放）</div></td>
                    <td><span class="pro-price">&#165;<?php echo round($value['price'],2)?></span></td> 
                    <td><sapn class="pro-price2">&#165;<?php echo round($value['best_price'],2)?></sapn></td> 
                    <td><div class="pinfo">
                          <input type="text" name="cart_num" value="<?php echo $value['count']?>" class=" form-control">
                          <button class="btn btn-default plus" onclick="cart_count('plus',this)">+</button>
                          <button class="btn btn-default minus" onclick="cart_count('minus',this)">-</button>
                          <input type="hidden" id="min_num" name="min_num" value="<?php echo $value['min_num']?>">
                      </div>
                    </td> 
                    <td><a herf="">删除</a></td>
                    </tr>
                    <?php endforeach;?>
                 <tr>
                  <td ><div class="left"><span class="select_item"><input value="option1" id="inlineCheckbox1" type="checkbox"> <img class='box' src="<?php echo base_url();?>assets/img/home/cart-item.jpg"></span></div></td> 
                  <td><div class="left pro-title">EGStyle原创设计 连衣裙夏2014 欧美风 宽松中长袖</div>  <div class="left pro-title">个性休闲 裙子</div><div class="pro-mark">[赠品] 50元电子京券（订单完成后自动发放）</div></td>
                  <td><span class="pro-price">&#165;998.00</span></td> <td><sapn class="pro-price2">&#165;998.00</sapn></td> 
                  <td><div class="pinfo">
                          <input type="text" name="cart_num" value="33" class=" form-control">
                          <button class="btn btn-default plus" onclick="cart_count('plus',this)">+</button>
                          <button class="btn btn-default minus" onclick="cart_count('minus',this)">-</button>
                          <input type="hidden" id="min_num" name="min_num" value="33">
                      </div>
                  </td> 
                  <td><a herf="">删除</a></td>
                 </tr>               
                 <tr>
                  <td ><div class="left"><label class="left"><input type="checkbox"> 全选</label> </div></td> 
                  <td><div class="left"><i class="fa fa-trash-o"></i> 清空</div></td>
                  <td></td> 
                  <td>
                  </td> 
                  <td><div class="total m-b-5"><span class="num">2</span> 件商品 总计：</div><div class="total">优惠：</div></td>
                  <td><div class="m-b-5">&#165;998.00</div><div class="">&#165;998.00</div></td>
                 </tr>
                </tbody>
              </table>
              <div class="toorder">总计( 不含运费 ) :<span class="order_price">&#165;998.00</span><button type="button" class="btn btn-danger">去结算</button></div>
            <div class="tab-pane fade" id="profile"></div>
            <div class="tab-pane fade" id="dropdown1"></div>          
            <p style="text-align:center">购物车为空，继续购买商品 <a href="<?php echo base_url();?>">商城首页</a></p>     
          </div>
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
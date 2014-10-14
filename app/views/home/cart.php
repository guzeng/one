<?$this->load->view('home/header-cart')?>
<div class='container m-t-20' id="mycart">
  <div class='row'>
    <!-- left -->
    <!-- left end -->
    <!-- right -->
    <div class='col-lg-12 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
        <h5 class="page-title">
					我的购物车
				</h5>
        <div id="myTabContent" class="tab-content">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
              	<th width="130">
                 <input value="option1" id="inlineCheckbox1" type="checkbox">
                </th>
                <th width="50">全选 </th>
                <th>商品</th>
                <th width="150">价格</th>
                <th width="120">优惠</th>
                <th width="150">数量</th>
                <th width="150">操作</th>  
              </tr>
              </thead>
              <tbody> 
               <tr>
                <td><span><input value="option1" id="inlineCheckbox1" type="checkbox"></span></td> <td></td> <td></td><td></td> <td></td> <td></td> <td></td>
               </tr>
              </tbody>
            </table> 
           
          
      

          <div class="tab-pane fade" id="profile"></div>
          <div class="tab-pane fade" id="dropdown1"></div>
          
          <p style="text-align:center">购物车为空，继续购买商品 <a href="<?php echo base_url();?>">商城首页</a></p>
     
        </div>
      </div>

    </div>
    <!-- right end --> </div>
</div>

<div class='container m-b-20' id='ad-footer'>
  <div class=''>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
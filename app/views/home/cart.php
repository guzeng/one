<?$this->load->view('home/header-cart')?>
<div class='container m-t-20' id="myorder">
  <div class='row'>
    <!-- left -->

    <!-- left end -->
    <!-- right -->
    <div class='col-lg-12 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
        <h3 class="page-title">
					我的购物车
					</h3>
        <div id="myTabContent" class="tab-content">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
              	<th width="130">全选</th>
                <th>商品</th>
                <th width="130">单价</th>
                <th width="100">优惠</th>
                <th width="130">数量</th>
                <th width="130">操作</th>
                
                
              </tr>
            </thead>
          </table>  
          <?php if(isset($order_list) && empty($order_list)):?>
          <div class="portlet-title">                
                <div class="actions btn-set pull-left"><label class="checkbox-inline">
                      <div class="checker" id="uniform-inlineCheckbox1"><span><input type="checkbox" value="option1" id="inlineCheckbox1"></span></div> 全选 </label>
                      &nbsp;&nbsp;<button class="btn default" name="back" type="button">合并付款</button>
                      <button class="btn default">批量收货</button>                 
                </div>
                <div class="dataTables_paginate paging_bootstrap pull-right">
                <ul class="pagination" style="visibility: visible;">
                  <li class="prev disabled">
                    <a title="Prev" href="#">
                      <i class="fa fa-angle-left"></i>
                    </a>
                  </li>
                  <li class="active">
                    <a href="#">1</a>
                  </li>
                  <li>
                    <a href="#">2</a>
                  </li>
                   <li>
                    <a href="#">…</a>
                  </li>
                  <li class="next">
                    <a title="Next" href="#">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            
            <?php foreach ($order_list as $key => $item):?>
            <table class="table table-striped table-advance table-bordered">
              <thead>
                <tr>
                  <th colspan="7">
                    <div class="first-title">
                      <input type="checkbox" value="" id='order_<?php echo $item[0]->id;?>' /> 
                      <span class="m-r-10"><?php echo date('Y-m-d',$item[0]->create_time);?></span>    
                      <span class="m-r-10">订单号：<?php echo $item[0]->code;?></span> - 
                      <span class="m-r-10"><?php echo $item[0]->consignee;?></span>
                    </div>
                    </th>
                </tr>
              </thead>
              <tbody> 
                <?php if($item && !empty($item)):?>
                <?php foreach ($item as $key => $value):?>
                <tr>
                  <td >
                    <div class="img"><img width="150" height="100" src="<?php echo $value->product_pic;?>"></div>
                    <div class="title"><?php echo $value->name;?> </div>
                    <!-- <div class="color">颜色分类：黑</div> -->
                    <div class="price"><?php echo $value->price;?></div>
                    <div class="coun"><?php echo $value->number;?> </div>
                  </td>
                  <td width="130"><a>申请售后</a></td>                
                  <td width="130"><?php echo $value->price;?><label>含运费：0.00</label></td>
                  <td width="130">交易成功</td>
                  <td width="130"><a>再次购买</a></td>               
                </tr>
                <?endforeach;?>
                <?endif;?>
              </tbody>
            </table> 
            <?endforeach;?>
          
          <div class="portlet-title">                
                <div class="actions btn-set pull-left"><label class="checkbox-inline">
                      <div class="checker" id="uniform-inlineCheckbox1"><span><input type="checkbox" value="option1" id="inlineCheckbox1"></span></div> 全选 </label>
                      &nbsp;&nbsp;<button class="btn default" name="back" type="button">合并付款</button>
                      <button class="btn default">批量收货</button>                 
                </div>
                <div class="dataTables_paginate paging_bootstrap pull-right">
                <ul class="pagination" style="visibility: visible;">
                  <li class="prev disabled">
                    <a title="Prev" href="#">
                      <i class="fa fa-angle-left"></i>
                    </a>
                  </li>
                  <li class="active">
                    <a href="#">1</a>
                  </li>
                  <li>
                    <a href="#">2</a>
                  </li>
                   <li>
                    <a href="#">…</a>
                  </li>
                  <li class="next">
                    <a title="Next" href="#">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

          <div class="tab-pane fade" id="profile"></div>
          <div class="tab-pane fade" id="dropdown1"></div>
          <?else:?>
          <p style="text-align:center">暂无订单，这就去挑选商品：<a href="<?php echo base_url();?>">商城首页</a></p>
          <?endif;?>
        </div>
      </div>

    </div>
    <!-- right end --> </div>
</div>

<div class='container m-b-20' id='ad-footer'>
  <div class='row'>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
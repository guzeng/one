<?$this->load->view('home/header')?>
<script type="text/javascript" src="<?php echo base_url().'assets/scripts/home/order.js'?>"></script>
<div class='container m-t-20' id="myorder">
  <div class='row'>
    <!-- left -->
    <?$this->load->view('home/my')?>
    <!-- left end -->
    <!-- right -->
    <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
      <form action="<?=base_url()?>home/orders/index" method="post" id='order_list_search_form'>
        <input type="hidden" name="status" id="status" value="<?php echo $status;?>"/>
        <ul id="orderTab" class="nav nav-tabs" role="tablist">
          <li class="<?php echo $status === '' ? 'active' : '';?>">
            <a data-status="" href="<?=base_url()?>home/orders/index">所有订单</a>
          </li>
          <li class="<?php echo $status != '' && $status==0 ? 'active' : '';?>">
            <a data-status="1" href="<?=base_url()?>home/orders/index/status/0">
              待付款
              <span class="coun"><?php echo $fu_kuan;?></span>
            </a>
          </li>
          <li class="<?php echo $status != '' && $status==1 ? 'active' : '';?>">
            <a data-status="2" href="<?=base_url()?>home/orders/index/status/1">
              待发货
              <span class="coun"><?php echo $fa_huo;?></span>
            </a>
          </li>
          <li data-status="3" class="<?php echo $status != '' && $status==2 ? 'active' : '';?>">
            <a href="<?=base_url()?>home/orders/index/status/2">
              待收货
              <span class="coun"><?php echo $shou_huo;?></span>
            </a>
          </li>
          <li class="<?php echo $status != '' && $status==3 ? 'active' : '';?>">
            <a data-status="4" href="<?=base_url()?>home/orders/index/status/3">
              待评价
              <span class="coun"><?php echo $ping_jia;?></span>
            </a>
          </li>
        </ul>
        <div class="row">
          <div class="col-md-8 col-md-push-4">
              <select class="form-control input-small inline" id="create_time" name="create_time">
                  <option value="">购物时间</option>
                  <option <?php echo isset($create_time) && $create_time == 1? 'selected':'';?>  value="1">最近三个月内</option>
                  <option <?php echo isset($create_time) && $create_time == 2? 'selected':'';?> value="2"><?php echo date('Y',time());?>年</option>
                  <option <?php echo isset($create_time) && $create_time == 3? 'selected':'';?> value="3"><?php echo date('Y',strtotime('-1 year'));?>年</option>
                  <option <?php echo isset($create_time) && $create_time == 4? 'selected':'';?> value="4"><?php echo date('Y',strtotime('-2 year'));?>年</option>
                  <option <?php echo isset($create_time) && $create_time == 5? 'selected':'';?> value="5"><?php echo date('Y',strtotime('-3 year'));?>年</option>
                  <option <?php echo isset($create_time) && $create_time == 6? 'selected':'';?> value="6"><?php echo date('Y',strtotime('-3 year'));?>年之前</option>
              </select>
            <!-- <div class="btn-group">
                <a data-toggle="dropdown" href="#" class=" ">
                   更多筛选条件 <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                  <li>
                    <a href="#">
                       日期
                    </a>
                  </li>
                  <li>
                    <a href="#">
                       金额
                    </a>
                  </li>
                  <li class="divider">
                  </li>
                </ul>
              </div>      -->     
          </div>
          <div class="col-md-4 col-md-pull-8">
            <div class="input-group">
              <input name="keyword" id="keyword" type="text" class="form-control" placeholder='订单号或商品名称' value="<?php echo isset($keyword) ? $keyword :'';?>" />
              <input name="search_type" id="search_type" type="hidden" class="form-control" placeholder='' value='<?php echo isset($search_type) ? $search_type :'';?>' />
              <span class="input-group-btn">
                  <input id="search_btn" class="btn default" type="button" value="&nbsp;&nbsp;订单查询&nbsp;&nbsp;" >
              </span>
            </div>
          </div>
        </div>
      </form>
        <div id="myTabContent" class="tab-content">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
                <th>商品</th>
                <th width="130">单价(元)</th>
                <th width="100">数量</th>
                <th width="130">商品操作</th>
                <th width="130">实付款(元)</th>
                <th width="130">交易状态</th>
                <th width="130">交易操作</th>
              </tr>
            </thead>
          </table>  
          <?php if(isset($order_list) && !empty($order_list)):?>
          <div class="portlet-title">
                <?php if($status != '' && ($status==0 || $status ==2)):?>
                <div class="actions btn-set pull-left" style="margin-left:8px;">
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox1">
                            <span><input type="checkbox" value="option1" id="inlineCheckbox1"></span>
                        </div> 全选 
                    </label>
                    <?php if($status==0):?>
                      &nbsp;&nbsp;<button class="btn default" name="back" type="button">合并付款</button>
                    <?php endif;?>
                    <?php if($status==2):?>
                      &nbsp;&nbsp;<button class="btn default">批量收货</button>
                    <?php endif;?>
                </div>
                <?php endif;?>
                <!-- paginition start -->
                <?if(isset($pagination)):?>
                <div class="pagination pagination-right padding-right-20 pull-right">
                <?=isset($pagination)?$pagination:''?>
                </div>
                <?endif;?>
                <!-- paginition end -->
            </div>
            <div class="clear"></div>
            <?php foreach ($order_list as $key => $item):?>
            <table class="table table-striped table-advance table-bordered" style="border:none;border-top:1px solid #f0f0f0">
              <thead>
                <tr>
                    <th colspan="7">
                    <div class="first-title">
                        <?php if($status != '' && ($status==0 || $status ==2)):?>
                        <input type="checkbox" value="" id='order_<?php echo $item->id;?>' /> 
                        <?php endif;?>
                        <span class="m-r-10"><?php echo date('Y-m-d',$item->create_time);?></span>    
                        <span class="m-r-10">订单号：<?php echo $item->code;?></span> - 
                        <span class="m-r-10"><?php echo $item->consignee;?></span>
                    </div>
                    </th>
                </tr>
              </thead>
              <tbody> 
                <?php if(isset($item->order_detail) && !empty($item->order_detail)):?>
                <?php foreach ($item->order_detail as $key => $value):?>
                <tr>
                  <td width="*">
                    <div class="img"><a target="_bank" href="<?php echo base_url()."item/id/".$value->product_id?>"><img width="150" height="100" src="<?php echo $this->product->pic($value->product_id);?>"></a></div>
                    <div class="title" style="text-align:left"><?php echo $value->name;?> </div>
                    <!-- <div class="color">颜色分类：黑</div> -->
                    <!-- div class="price"></div>
                    <div class="coun"> </div> -->
                  </td>
                  <td width="130"><a><?php echo $value->price;?></a></td>                
                  <td width="100"><a><?php echo $value->number;?></a></td>                
                  <td width="130"><a style="display:block;" target="_bank" href="<?php echo base_url()."item/id/".$value->product_id?>">查看</a></td>     
                             
                  <td width="130"><?php echo $value->price;?><label>含运费：0.00</label></td>
                  <td width="130"><?php echo $this->order->status($item->status);?>  </td>
                  <td width="130">
                    <?php if($item->status!='' && $item->status==0):?>
                    <a href="<?php echo base_url().'home/orders/pay/'.$item->id?>"><button class='btn blue pay'>付款</button></a>
                    <?php elseif($item->status==2):?>
                    <button class='btn blue pay'>收货</button>
                    <?php else:?>
                    <a href="<?php echo base_url()."item/id/".$value->product_id?>">再次购买</a>
                    <?php endif;?>
                  </td>               
                </tr>
                <?endforeach;?>
                <?endif;?>
              </tbody>
            </table> 
            <?endforeach;?>
          
            <div class="portlet-title" style="margin-left:8px;">
                <?php if($status != '' && ($status==0 || $status ==2)):?>
                <div class="actions btn-set pull-left">
                    <label class="checkbox-inline">
                    <div class="checker" id="uniform-inlineCheckbox1">
                        <span><input type="checkbox" value="option1" id="inlineCheckbox1"></span>
                    </div> 全选 
                    </label>
                    <?php if($status != '' && $status==0):?>
                      &nbsp;&nbsp;<button class="btn default" name="back" type="button">合并付款</button>
                    <?php endif;?>
                    <?php if($status != '' && $status==2):?>
                      <button class="btn default">批量收货</button>     
                    <?php endif;?>            
                </div>
                <?php endif;?>
                <!-- paginition start -->
                <?if(isset($pagination)):?>
                <div class="pagination pagination-right padding-right-20 pull-right">
                <?=isset($pagination)?$pagination:''?>
                </div>
                <?endif;?>
                <!-- paginition end -->
            </div>

          <div class="tab-pane fade" id="profile"></div>
          <div class="tab-pane fade" id="dropdown1"></div>
          <?else:?>
          <p style="text-align:center">暂无订单，这就去挑选商品：<a href="<?php echo base_url();?>">商城首页</a></p>
          <?endif;?>
        </div>
      </div>

    </div>
    <!-- right end --> 
  </div>
    
</div>

<div class='container m-b-20' id='ad-footer'>
  <div class='row'>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
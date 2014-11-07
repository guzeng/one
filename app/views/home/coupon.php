<?$this->load->view('home/header')?>
<div class='container m-t-20' id="myorder">
  <div class='row'>
    <!-- left -->
    <?$this->load->view('home/my')?>
    <!-- left end -->
    <!-- right -->
    <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
        <form action="<?=base_url()?>home/coupons/index" method="post" id='list_search_form'>
          <input type="hidden" name="type" id="type" value="<?php echo $type;?>"/>
          <ul id="coupon_tab" class="nav nav-tabs" role="tablist">
            <li class="<?php echo $type != '' && $type==1 ? 'active' : '';?>">
              <a href="<?=base_url()?>home/coupons/index/type/1">
                未使用优惠券
              </a>
            </li>
            <li class="<?php echo $type != '' && $type==2 ? 'active' : '';?>">
              <a href="<?=base_url()?>home/coupons/index/type/2">
                已使用优惠券
              </a>
            </li>
            <li class="<?php echo $type != '' && $type==3 ? 'active' : '';?>">
              <a href="<?=base_url()?>home/coupons/index/type/3">
                已过期优惠券
              </a>
            </li>
          </ul>
        </form>
        <div id="myTabContent" class="tab-content">
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
                <th width="15%">编号</th>
                <th width="15%">类别</th>
                <th width="15%">面值</th>
                <th width="15%">所需消费金额</th>
                <th width="*">有效期</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($list) && !empty($list)):?>
              <?php foreach ($list as $key => $value):?>
              <tr>
                <td width="15%"><?php echo $value->code;?></td>
                <td width="15%"><?php echo $value->type==1 ? '购物赠':'商家赠';?></td>
                <td width="15%"><?php echo $value->value;?></td>
                <td width="15%"><?php echo $value->use;?></td>
                <td width="*"><?php echo date('Y-m-d',$value->expirse_from).' 至 '.date('Y-m-d',$value->expirse_to);?></td>
              </tr>
              <?endforeach;?>
            <?else:?>
              <tr>
                <td colspan="5">暂无您的优惠券数据！</td>
              </tr>
            <?endif;?>
            </tbody>
          </table>  
          <!-- paginition start -->
          <?if(isset($pagination)):?>
          <div class="pagination pagination-right padding-right-20 pull-right">
          <?=isset($pagination)?$pagination:''?>
          </div>
          <?endif;?>
          <!-- paginition end -->
          

        </div>
      </div>
    </div>
    <!-- right end --> 
  </div>
    
</div>

<div class='container m-b-20' id='ad-footer'>
  <div class='row'>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
  </div>
</div>
<?$this->load->view('home/footer')?>
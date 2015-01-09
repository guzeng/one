<?$this->load->view('home/header')?>
<div class='container m-t-20' id="">
  <div class='row m-b-50'>
    <!-- right -->
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
      <div class="order-tab">
       <div style="margin:0 auto;width:60%;text-align:center;">
        <?php if($row->expirse_to>time()):?>
          <form action="<?php echo base_url()?>home/user_coupons/update" method="post" onsubmit='return false' role="form" id='coupon_form' class="form-horizontal">
            <h2  class="req m-b-20">
              <?php echo $row->code;?>
            </h2>
            <h4 class='m-b-20'>满 <?php echo $row->use;?> 减 <?php echo $row->value;?></h4>
            <h4 class='m-b-20'>有效期至<?php echo date('Y-m-d h:m:s',gmt_to_local($row->expirse_to));?></h4>
            <h4 class='m-b-50'>每个ID只能领一次</h4>
            <input type="hidden" name="id" value="<?php echo isset($row)?$row->id:'';?>"/>
            <?php if(!$user_coupon):?>
            <button type="button" class="btn btn-lg inline-block green" onclick="do_submit('coupon_form',getback)" id='coupon_form_submit_btn'>点击领取</button>
            <?php else:?>
            <h3 class="req">您已于<?php echo date("Y年m月d日 H:i",gmt_to_local($user_coupon->create_time));?>领取，<a href="<?php echo base_url()?>home/user_coupons">点此查看</a></h3>
            <?php endif;?>
          </form>
        <?else:?>
            <?php echo $row->code;?>优惠券已过期
        <?endif;?>
        </div>
    </div>
    <!-- right end --> 
  </div>
    
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/scripts/home/coupon.js"></script>
<div class='container m-b-20' id='ad-footer'>
  <div class='row'>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
  </div>
</div>
<?$this->load->view('home/footer')?>
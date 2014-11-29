<?$this->load->view('home/header')?>
<div class='container m-t-20' id="myorder">
  <div class='row'>
    <!-- left -->
    <?$this->load->view('home/my')?>
    <!-- left end -->
    <!-- right -->
    <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
       <div style="margin:0 auto;width:60%;text-align:center;">
        <?php if($row->expirse_to>time()):?>
          <form action="<?php echo base_url()?>home/user_coupons/update" method="post" onsubmit='return false' role="form" id='coupon_form' class="form-horizontal">
            <p style="font-size:28px;font-weight:blod;" class="req">
              正在领取<?php echo $row->code;?>优惠券（满<?php echo $row->use;?>减<?php echo $row->value;?>）
            </p>
            <p>优惠劵有效期至<?php echo date('Y-m-d h:m:s',gmt_to_local($row->expirse_to));?></p>
            <p>每个ID只能领一次</p>
             <input type="hidden" name="id" value="<?php echo isset($row)?$row->id:'';?>"/>
             <button type="button" class="btn inline-block green" style="padding:6px 12px;" onclick="do_submit('coupon_form')" id='coupon_form_submit_btn'>领取</button>
             <button type="button" class="btn inline-block default" style="padding:6px 12px;" onclick="window.history.back();">取消</button>
          </form>
        <?else:?>
            <?php echo $row->code;?>优惠券已过期
        <?endif;?>
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
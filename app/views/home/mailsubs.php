<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="mailsubs">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <h4>订阅邮件即可享受以下服务：</h4>
            <div class="readme">
                为了您能准确收到邮件，请确认您的邮箱是否正确：
                <a href="javascript:void(0)" class="mail"><?php echo isset($user->email) ? $user->email:'暂未填写';?></a>
                <a href="<?php echo base_url().'home/users#email';?>" class="btn btn-xs green"><?php echo isset($user->email) ? '修改':'马上填写';?></a>
            </div>
            <form action="<?php echo base_url()?>home/mailsubs/update" method="post" onsubmit='return false' role="form" id='email_book_form' class="form-horizontal">
            <div class="well"> 
                <div class="block title">购物邮箱提醒</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox21" <?php echo (!empty($subs) && in_array("order", $subs)) ? 'checked' : '';?> value="order" name='subs[]' style="">
                        下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox22" <?php echo (!empty($subs) && in_array("notPay", $subs)) ? 'checked' : '';?> value="notPay" name='subs[]' style="">
                        未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox23" <?php echo (!empty($subs) && in_array("pay", $subs)) ? 'checked' : '';?> value="pay" name='subs[]' style="">
                        付款成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox23" <?php echo (!empty($subs) && in_array("notComment", $subs)) ? 'checked' : '';?> value="notComment" name='subs[]' style="">
                        未评价提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">账户提醒邮件：</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox21" <?php echo (!empty($subs) && in_array("hasCoupon", $subs)) ? 'checked' : '';?> value="hasCoupon" name='subs[]' style="">
                        优惠券到账提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox22" <?php echo (!empty($subs) && in_array("couponDue", $subs)) ? 'checked' : '';?> value="couponDue" name='subs[]' style="">
                        优惠券到期提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox23" <?php echo (!empty($subs) && in_array("memberLevel", $subs)) ? 'checked' : '';?> value="memberLevel" name='subs[]' style="">
                        会员级别变动提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox23" <?php echo (!empty($subs) && in_array("monthlyBill", $subs)) ? 'checked' : '';?> value="monthlyBill" name='subs[]' style="">
                        月度账单提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">促销/活动邮件：</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox21" <?php echo (!empty($subs) && in_array("promotion", $subs)) ? 'checked' : '';?> value="promotion" name='subs[]' style="">
                        订阅
                    </label>
                    <label class="checkbox-inline">
                        <strong>综合促销</strong> &nbsp; 每周最热门商品推荐、每周最新的促销物价抢购及神秘促销商品推荐
                    </label>
                </div>
            </div>
            <div class="col-md-offset-2 col-md-3 m-b-20">
                <button id="email_book_submit_btn" onclick="do_submit('email_book_form')" class="btn btn-block green" type="button">保存</button>
            </div>
        </form>
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

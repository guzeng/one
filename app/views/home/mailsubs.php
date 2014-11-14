<?$this->
load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="mailsubs">
        <!-- left -->
        <?$this->
        load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <h4>订阅邮件即可享受以下服务：</h4>
            <div class="readme">
                为了您能准确收到京东邮件，请确认您的邮箱是否正确：
                <a class="mail">z.b.n@qq.com</a>
                <button class="btn btn-xs green" id="pulsate-once">修改邮箱</button>
            </div>
            <div class="well"> 
                <div class="block title">购物邮箱提醒</div>
                <div class="checkbox-list">

                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox21">
                            <span>
                                <input type="checkbox" id="inlineCheckbox21" value="order" name='subs' style="">
                            </span>
                        </div>
                        下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox22">
                            <span>
                                <input type="checkbox" id="inlineCheckbox22" value="notPay" name='subs' style=""></span>
                        </div>
                        未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="pay" name='subs' style=""></span>
                        </div>
                        付款成功提醒
                    </label>

                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="notComment" name='subs' style=""></span>
                        </div>
                        未评价提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">账户提醒邮件：</div>
                <div class="checkbox-list">

                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox21">
                            <span>
                                <input type="checkbox" id="inlineCheckbox21" value="hasCoupon" name='subs' style=""></span>
                        </div>
                        优惠券到账提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox22">
                            <span>
                                <input type="checkbox" id="inlineCheckbox22" value="couponDue" name='subs' style=""></span>
                        </div>
                        优惠券到期提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="memberLevel" name='subs' style=""></span>
                        </div>
                        会员级别变动提醒
                    </label>

                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="monthlyBill" name='subs' style=""></span>
                        </div>
                        月度账单提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">促销/活动邮件：</div>
                <div class="checkbox-list">

                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox21">
                            <span>
                                <input type="checkbox" id="inlineCheckbox21" value="promotion" name='subs' style=""></span>
                        </div>
                        订阅
                    </label>
                    <label class="checkbox-inline">
                        <strong>综合促销</strong> &nbsp; 每周最热门商品推荐、每周最新的促销物价抢购及神秘促销商品推荐
                    </label>
                </div>
            </div>

        </div>

        <!-- right end --> </div>
</div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->
load->view('home/footer')?>
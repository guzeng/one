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
                                <input type="checkbox" id="inlineCheckbox21" value="option1" style=""></span>
                        </div>
                        下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox22">
                            <span>
                                <input type="checkbox" id="inlineCheckbox22" value="option2" style=""></span>
                        </div>
                        未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
                        </div>
                        付款成功提醒
                    </label>

                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
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
                                <input type="checkbox" id="inlineCheckbox21" value="option1" style=""></span>
                        </div>
                        优惠券到账提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox22">
                            <span>
                                <input type="checkbox" id="inlineCheckbox22" value="option2" style=""></span>
                        </div>
                        未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
                        </div>
                        付款成功提醒
                    </label>

                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
                        </div>
                        未评价提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">购物邮箱提醒</div>
                <div class="checkbox-list">

                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox21">
                            <span>
                                <input type="checkbox" id="inlineCheckbox21" value="option1" style=""></span>
                        </div>
                        下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker" id="uniform-inlineCheckbox22">
                            <span>
                                <input type="checkbox" id="inlineCheckbox22" value="option2" style=""></span>
                        </div>
                        未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
                        </div>
                        付款成功提醒
                    </label>

                    <label class="checkbox-inline">
                        <div class="checker disabled" id="uniform-inlineCheckbox23">
                            <span>
                                <input type="checkbox" id="inlineCheckbox23" value="option3" disabled="" style=""></span>
                        </div>
                        未评价提醒
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
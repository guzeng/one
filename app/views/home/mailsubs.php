<?$this->load->view('home/header')?>
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
                为了您能准确收到邮件，请确认您的邮箱是否正确：
                <a class="mail"><?php echo isset($user->email) ? $user->email:'暂未填写';?></a>
                <a href="<?php echo base_url().'home/users#email';?>" class="btn btn-xs green"><?php echo isset($user->email) ? '修改':'马上填写';?></a>
            </div>
            <div class="well"> 
                <div class="block title">购物邮箱提醒</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> 下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" value="option2"> 未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" value="option3"> 付款成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox4" value="option4"> 未评价提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">账户提醒邮件：</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> 优惠券到账提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" value="option2"> 未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" value="option3"> 付款成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox4" value="option4"> 未评价提醒
                    </label>
                </div>
            </div>
            <div class="well"> 
                <div class="block title">购物邮箱提醒</div>
                <div class="checkbox-list">
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> 下单成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" value="option2"> 未付款提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" value="option3"> 付款成功提醒
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox4" value="option4"> 未评价提醒
                    </label>
                </div>
            </div>
            <div class="col-md-offset-2 col-md-3">
                <button id="email_book_submit_btn" onclick="do_submit('email_book_form')" class="btn btn-block green" type="button">保存</button>
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
<?$this->load->view('home/header')?>

<div class='container m-t-20'>
    <div class='row' id="user-info">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <div id="main">
                <div class="o-mt">
                    <h2>设置支付密码</h2>
                </div>
                <form action="<?php echo base_url()?>home/users/updatePayPwd" method="post" onsubmit='return false' role="form" id='paypwd_form' class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">支付密码：</label>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                <input value="" id="paypwd" type="password" name="paypwd" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"></label>
                            <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                <button type="button" class="btn btn-lg green" onclick="do_submit('paypwd_form')" id='paypwd_submit_btn'>
                                    保存
                                </button> 
                                <button type="button" class="btn btn-lg btn-default" onclick="goback()" id='paypwd_back'>
                                    取消
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>


<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
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
                    <h2>邮箱验证</h2>
                </div>
                <?php if(isset($error)):?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error;?></strong>
                    </div>
                <?php elseif($validate_email == 1):?>
                    <div class="alert alert-success">
                        <strong>您的邮箱已经验证!</strong> 如需更改，请在下方填写新的邮箱地址重新验证。
                    </div>
                <?php endif;?>
                <form action="<?php echo base_url()?>validate/sendemail" method="post" role="form" id='email_form' class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">邮箱地址：</label>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                <input value="<?php echo $email;?>" id="email" type="text" name="email" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"></label>
                            <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                <button type="submit" class="btn btn-lg green" id='email_submit_btn'>
                                    验证
                                </button> 
                                <button type="button" class="btn btn-lg btn-default" onclick="goback()" id='email_back'>
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
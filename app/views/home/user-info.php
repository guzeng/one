<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").eq(0).css("overflow-y","scroll");
    });
</script>
    <div class='container m-b-20 m-t-20'>
        <div class='row'>
            <div class="col-lg-2 col-md-2" style="padding:0px;">
                <?$this->load->view('home/user-left')?>
            </div>
            <div class="col-lg-10 col-md-10">
                <div id="main">
                    <div class="tab-content">
                        <!-- 账户信息 -->
                	    <div id="tab_1-1" class="tab-pane active">
                            <div class="tabbable tabbable-custom boxless">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#account-info">账户信息</a></li>
                                    <li class=""><a data-toggle="tab" href="#account-pic">头像照片</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="account-info" class="tab-pane active">
                                        <div class="portlet-body form">
                                            <form action="<?php echo base_url()?>admin/users/update_by_id" method="post" onsubmit='return false' role="form" id='user-form' class="form-horizontal">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">真实姓名：</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                            <input type="text" value="<?php echo isset($user)&&isset($user->name)?$user->name:'';?>" id="name" name="name" maxlength="30" class="form-control">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">生日：</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                            <input type="text" value="<?php echo isset($user)&&isset($user->birthday)?$user->birthday:'';?>" id="birthday" name="birthday" maxlength="30" class="form-control">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">身份证：</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                            <input type="text" value="<?php echo isset($user)&&isset($user->id_card_number)?$user->id_card_number:'';?>" id="id_card_number" name="id_card_number" maxlength="30" class="form-control">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">邮箱：</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                            <input type="text" value="<?php echo isset($user)&&isset($user->email)?$user->email:'';?>" id="email" name="email" maxlength="30" class="form-control">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">手机：</label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                            <input type="text" value="<?php echo isset($user)&&isset($user->phone)?$user->phone:'';?>" id="phone" name="phone" maxlength="30" class="form-control">
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"></label>
                                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                             <button type="submit" class="btn btn-block green" onclick="do_submit('user-form')" id='login_form_submit_btn'>保存</button>
                                                        </div>
                                                    </div>
                                                    <input type='hidden' id='id' name='id' value="<?php echo isset($user)?$user->id:'';?>">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="account-pic" class="tab-pane">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 账户信息结束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN FOOTER -->
    <!-- <div class="footer">
        <div class="footer-inner">
            2013 &copy; Zeng.
        </div>
        <div class="footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div> -->
    <!-- END FOOTER -->

</body>
<!-- END BODY -->
</html>
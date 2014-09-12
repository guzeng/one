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
                <div id="left-side">
                	 <ul class="ver-inline-menu tabbable margin-bottom-25">
                        <li><a data-toggle="tab" href="#tab_1-2"><i class="fa fa-user"></i> 我的订单</a></li>
                        <li><a data-toggle="tab" href="#tab_1-2"><i class="fa fa-user"></i> 我的积分</a></li>
    					<li class="active"><a data-toggle="tab" href="#tab_1-1"><i class="fa fa-user"></i> 账户信息</a></li>
    					<li><a data-toggle="tab" href="#tab_1-2"><i class="fa fa-info-circle"></i> 账户安全</a></li>
    					<li><a data-toggle="tab" href="#tab_1-3"><i class="fa fa-tint"></i> 账户余额</a></li>
    					<li><a data-toggle="tab" href="#tab_1-4"><i class="fa fa-leaf"></i> 收货地址</a></li>
    				</ul>
                </div>
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

                        <!-- 账户安全 -->
                        <div id="tab_1-2" class="tab-pane">
                            <div class="o-mt">
                                <h2>安全中心</h2>
                            </div>
                            <div id="safe04" class="m-b-10 m3">
                                <div class="mc">
                                    <strong class="fore fore1">安全级别：</strong>
                                    <strong class="rank-text ftx-04">中级</strong><i class="icon-rank04"></i>
                                    <span id="promptInfo" class="ftx-04">建议您启动全部安全设置，以保障账户及资金安全。</span>
                                </div>
                            </div>
                            <div id="safe05" class="m-b-10 m5">
                                <div class="mc">
                                    <div class="fore1"><s class="icon-01"></s><strong>登录密码</strong></div>
                                    <div class="fore2"><span class="ftx-03"></span><span style="color:#cc0000;">互联网账号存在被盗风险，建议您定期更改密码以保护账户安全。</span></div>
                                    <div class="fore3"><a href="/validate/updatePassword">修改</a></div>
                                </div>
                                <div class="mc">
                                    <div class="fore1">
                                        <s class="icon-02"></s><strong>邮箱验证</strong><b class="icon-id01d">邮箱认证</b></div>
                                        <div class="fore2"><span class="ftx-03">验证后，可用于快速找回登录密码，接收账户余额变动提醒。</span></div>
                                        <div class="fore3"><a class="btn btn-7" href="/validate/verifyMail"><s></s>立即验证</a></div>
                                                            
                                </div>
                                
                                <div class="mc">
                                    <div class="fore1">
                                        <s class="icon-01"></s><strong>手机验证</strong><b class="icon-id01">手机认证</b></div>
                                        <div class="fore2"><span class="ftx-03">您验证的手机：</span>
                                            <strong class="ftx-06" id="mobile">130*****905</strong>&nbsp;&nbsp;
                                            <span class="ftx-03">若已丢失或停用，请立即更换，</span><span style="color:#cc0000;">避免账户被盗</span>
                                        </div>
                                        <div class="fore3"><a href="/validate/updateMobile">修改</a></div>
                                    </div>
                        
                                <div style="" id="usedFlagCloseDiv" class="mc">
                                    <div class="fore1"><s class="icon-02"></s><strong>支付密码</strong><b class="icon-id02d">安全认证</b></div>
                                    <div class="fore2">
                                        <span class="ftx-03">启用支付密码后，在使用账户资产时，需通过支付密码进行身份认证。</span>
                                    </div>
                                    <div class="fore3">
                                        <a class="btn btn-7" href="/validate/payPwd/openPayPwd.action"><s></s>立即启用</a>
                                    </div>
                                </div>
                                
                                <div style="display:none" id="usedFlagCloseLhdlDiv" class="mc">
                                    <div class="fore1"><s class="icon-02"></s><strong>支付密码</strong><b class="icon-id02d">安全认证</b></div>
                                    <div class="fore2"><span class="ftx-03">为保障您的资金安全，建议您启用支付密码。</span><span style="color:#cc0000;">联合登录用户需要完善京东账户信息。</span></div>
                                    <div class="fore3"><a class="btn btn-7" href="http://qq.jd.com/new/regbind.aspx"><s></s>立即完善</a></div>
                                </div>
                                
                                <div style="display:none" id="usedFlagOpenDiv" class="mc">
                                    <div class="fore1">
                                        <s class="icon-01"></s>
                                        <strong>支付密码</strong><b class="icon-id02">安全认证</b>
                                    </div>
                                    
                                    <div class="fore2"><span class="ftx-03">安全程度：</span>
                                        <i class="ir icon-s-01"></i> 
                                        <span class="ftx-03">建议您设置更高强度的密码。</span>
                                    </div>
                                    <div class="fore3">
                                        <a class="btn btn-7" href="/user/paymentpassword/findByPin.action"><s></s>支付密码管理</a>
                                    </div>
                                </div>
                            
                                <!--新增数字证书-->
                                <div class="mc">                            
                                <!--未开启支付密码-->
                                    <div class="fore1"><s class="icon-02"></s><strong>数字证书</strong><b class="icon-id01d">手机认证</b></div>
                                    <div class="fore2"><span class="ftx-03">安装数字证书后，即使密码被盗，对方也不能使用您的账户资产。</span></div>  
                                    <div class="fore3"><a onclick="usedDCCheckThick('3')" href="#none" class="btn btn-7"><s></s>立即启用</a></div>
                                </div>
                                <!--新增数字证书结束-->
                            
                            </div>
                        </div>
                        <!-- 账户安全结束 -->

                        <!-- 账户余额 -->
                        <div id="tab_1-3" class="tab-pane">
                            <div class="o-mt">
                                <h2>账户余额</h2>
                            </div>
                            <div class="mod-main mod-comm">
                                <div class="mc">
                                    <div class="p-l-20 user-info-cont">
                                        可用余额：<strong class="ftx01 num">￥<label id="lblBalance">0</label>&nbsp;&nbsp;</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="mod-main mod-comm lefta-box">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#last-three-month">近三个月收支明细</a></li>
                                    <li class=""><a data-toggle="tab" href="#three-month-ago">三个月前收支明细</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="last-three-month" class="tab-pane active">
                                    </div>
                                    <div id="three-month-ago" class="tab-pane">
                                    </div>
                                </div>
                                <div class="mt10 clearfix">
                                    <div class="ftx-03 fl">提示：系统仅显示您两年之内的余额明细，更早的余额明细不再显示。</div>
                                </div>
                            </div>
                        </div>
                        <!-- 账户余额结束 -->

                        <!-- 账户地址 -->
                        <div id="tab_1-4" class="tab-pane">
                            <div class="o-mt">
                                <h2>收货地址</h2>
                            </div>
                            <div id="addressList" class="mod-main mod-comm">
                                <div class="mc">
                                    <div id="addresssDiv-90034502" class="sm easebuy-m ">
                                        <div class="smt">
                                            <h3>
                                                收货人-**区
                                                                </h3>
                                            <div class="extra">
                                                <a onclick="makeAddressDefault('90034502');" class="hide" id="setDefaultHref-90034502" href="javascript:;">设为默认</a>
                                                <a onclick="alertUpdateAddressDiag(90034502);" class="btn-9" href="javascript:;">编辑</a>
                                                <a onclick="alertDelAddressDiag(90034502)" class="btn-9 del" href="javascript:;">删除</a>
                                            </div>
                                        </div>

                                        <div class="smc">
                                            <div class="items new-items">
                                                <div class="item-lcol">
                                                    <div class="item">
                                                        <span class="label">收货人：</span>
                                                        <div class="fl">
                                                            Alex
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                    <div class="item">
                                                        <span class="label">所在地区：</span>
                                                        <div class="fl">
                                                            广东珠海市香洲区拱北区
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                    <div class="item">
                                                        <span class="label">地址：</span>
                                                        <div class="fl">
                                                            地址
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                    <div class="item">
                                                        <span class="label">手机：</span>
                                                        <div class="fl">
                                                            159999999999
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                    <div class="item">
                                                        <span class="label">固定电话：</span>
                                                        <div class="fl">
                                                            
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                    <div class="item">
                                                        <span class="label">电子邮箱：</span>
                                                        <div class="fl">
                                                            
                                                        </div>
                                                        <div class="clr"></div>
                                                    </div>
                                                </div>
                                                <div class="item-rcol">
                                                    <div class="extra">
                                                        <a class="btn-5 update-eshop e-btn" href="javascript:getPayment(90034502,0,0);">升级为轻松购</a>
                                                    </div>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="addAddressDiv_bottom" class="mt">
                                    <a href="javascript:;" class="e-btn add-btn btn-5" onclick="alertAddAddressDiag()">新增收货地址</a>
                                    <span class="ftx-03">您已创建<span class="ftx-02" id="addressNum_botton">3 </span>个收货地址，最多可创建<span class="ftx-02">20</span>个</span>
                                </div>
                            </div>
                        </div>
                        <!-- 账户地址结束 -->
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
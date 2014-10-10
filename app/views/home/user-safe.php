<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <div class='container m-t-20'>
        <div class='row' id="user-safe">
            <!-- left -->
            <?$this->load->view('home/my')?>
            <!-- left end -->
            <!-- right -->
            <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
                <div id="main">
                    <div class="tab-content">
                        <!-- 账户安全 -->
                        <div id="tab_1-2" class="tab-pane active">
                            <div class="o-mt">
                                <h2>安全中心</h2>
                            </div>
                            <div id="safe05" class="m-b-10 m5">
                                <div class="mc" style="border-width:0px;">
                                    <strong class="m-l-25">安全级别：</strong>
                                    <i class="icon-rank icon-rank04"></i>
                                    <strong class="rank-text ftx-04">中高级</strong>
                                    <div style="margin-left:95px;margin-top:15px;"><span style="color:orange;">建议您启动全部安全设置，以保障账户及资金安全。</span></div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
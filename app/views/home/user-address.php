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
                        <!-- 账户地址 -->
                        <div id="tab_1-4" class="tab-pane active">
                            <div class="o-mt">
                                <h2>收货地址</h2>
                            </div>
                            <div id="addressList" class="b">
                                <div class="address-top bg-c-f5 p-b-10 b-b">
                                    <h3 class="pull-left p-l-5" style="margin:0px;">收货人-**区</h3>
                                    <div class="pull-right"><a class="btn btn-default btn-success m-r-20">bianji</a><a class="btn btn-default btn-danger">del</a></div>
                                </div>
                                <div class="address-body p-10">
                                    <div class="item-lcol m-l-25">
                                        <div class="item">
                                            <span class="pull-left">收货人：</span>
                                            <div class="pull-left">
                                                Alex
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">所在地区：</span>
                                            <div class="pull-left">
                                                广东珠海市香洲区拱北区
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">地址：</span>
                                            <div class="pull-left">
                                                地址
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">手机：</span>
                                            <div class="pull-left">
                                                159999999999
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">固定电话：</span>
                                            <div class="pull-left">
                                                
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">电子邮箱：</span>
                                            <div class="pull-left">
                                                
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="address-foot">
                                <a href="javascript:;" class="e-btn add-btn btn-5" onclick="alertAddAddressDiag()">新增收货地址</a>
                                <span class="ftx-03">您已创建<span class="ftx-02" id="addressNum_botton">3 </span>个收货地址，最多可创建<span class="ftx-02">20</span>个</span>
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
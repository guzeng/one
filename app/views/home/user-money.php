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
                        <!-- 账户余额 -->
                        <div id="tab_1-3" class="tab-pane active">
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
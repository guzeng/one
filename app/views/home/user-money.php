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

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="history">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        
        <div class='col-lg-11 col-md-11 col-sm-11 col-xs-12 '>
            <ul class="timeline clearfix">
                        <li class="timeline-yellow">
                            <div class="timeline-icon col-md-1">vvvv
                            </div>
                            <div class="timeline-body col-md-11">
            <h4 class="page-title">
                今天
                <small><span class="time">2014-8-19</span> 浏览了9件宝贝</small>
            </h4>
            <!-- list -->
            <div class='row m-b-20 '>
                <div class='col-md-3 p-thumb'>
                    <div class='text-center m-b-10'>
                        <img src='<?php echo base_url()?>assets/img/home/p.jpg' class='img-responsive'></div>

                    <div class='price'>
                        ￥ 999.00
                        <span class="label label-sm label-warning pull-right">限时特价</span>
                    </div>
                    <div class=' m-b-5'>
                        <a>已销售量3件</a>
                        <span class="label label-sm  label-default  pull-right">Blocked</span>
                    </div>

                </div>
                <div class='col-md-3 p-thumb'>
                    <div class='text-center m-b-10'>
                        <img src='<?php echo base_url()?>assets/img/home/p.jpg' class='img-responsive'></div>

                     <div class='price'>
                        ￥ 999.00
                        <span class="label label-sm label-warning pull-right">限时特价</span>
                    </div>
                    <div class=' m-b-5'>
                        <a>已销售量3件</a>
                        <span class="label label-sm  label-default  pull-right">Blocked</span>
                    </div>
                </div>
                <div class='col-md-3 p-thumb'>
                    <div class='text-center m-b-10'>
                        <img src='<?php echo base_url()?>assets/img/home/p.jpg' class='img-responsive'></div>

                     <div class='price'>
                        ￥ 999.00
                        <span class="label label-sm label-warning pull-right">限时特价</span>
                    </div>
                    <div class=' m-b-5'>
                        <a>已销售量3件</a>
                        <span class="label label-sm  label-default  pull-right">Blocked</span>
                    </div>
                </div>
                <div class='col-md-3 p-thumb'>
                    <div class='text-center m-b-10'>
                        <img src='<?php echo base_url()?>assets/img/home/p.jpg' class='img-responsive'></div>

                    <div class='price'>
                        ￥ 999.00
                        <span class="label label-sm label-warning pull-right">限时特价</span>
                    </div>
                    <div class=' m-b-5'>
                        <a>已销售量3件</a>
                        <span class="label label-sm  label-default  pull-right">Blocked</span>
                    </div>
                </div>

            </div>
            <!-- like list end --> </div>
        </li>
    </ul>
        <!-- right end --> </div></div>
</div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
<?$this->load->view('home/header')?>
<div class='container'>
    <div class='row'>
        <ol class="breadcrumb top-bar">
            <li><a href="#">食品饮料</a></li>
            <li class="active">进口食品</li>
        </ol>
    </div>
</div>
<div class='container'>
    <div class='row'>
        <!-- left -->
        <div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 col-no-padding'>
            <ul class="list-group">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <div class='row m-l-0 b'>
                <div class='col-md-1 p-15'>
                    品牌
                </div>
                <div class='col-md-11 b-l p-15'>
                    <div class='row m-b-10'>
                        <div class='col-md-3'>德运/devondale</div>
                        <div class='col-md-3'>德亚/Weidendorf</div>
                        <div class='col-md-3'>维芬堡/WELFINBURGER</div>
                        <div class='col-md-3'>安佳/Anchor</div>
                    </div>
                    <div class='row m-b-10'>
                        <div class='col-md-3'>欧德堡/OLDENBURGER</div>
                        <div class='col-md-3'>纽麦福/Meadow Fresh</div>
                        <div class='col-md-3'>兰特/Lactel</div>
                        <div class='col-md-3'>田园/COUNTRY GOODNESS</div>
                    </div>
                    <div class='row m-b-10'>
                        <div class='col-md-3'>宾格瑞/Binggrae</div>
                        <div class='col-md-3'>多美鲜/Suki</div>
                        <div class='col-md-3'>艾思达/ASDA</div>
                        <div class='col-md-3'>德拉米尔/delamere</div>
                    </div>
                </div>
            </div>
            <div class='row m-l-0 b-l b-r b-b'>
                <div class='col-md-1 p-15'>
                    价格
                </div>
                <div class='col-md-11 b-l p-15'>
                        <span class='m-r-30'>0-30元</span>
                        <span class='m-r-30'>30-60元</span>
                        <span class='m-r-30'>60-100元</span>
                        <span class='m-r-30'>200-1000元</span>
                        <span class=''>1000元以上</span>
                </div>
            </div>
            <!-- order line -->
            <div class='row m-t-10 m-l-0 order-line'>
                <div class='col-md-1 p-t-6 order-line-title' >排序</div>
                <div class='col-md-5 p-t-5 p-b-5 p-l-0'>
                    <a><span class='order-item'>销量</span></a>
                    <span class='order-item'>价格</span>
                    <span class='order-item'>评论数</span>
                    <span class='order-item'>上架时间</span>
                </div>
                <div class='col-md-6 p-t-5 p-b-5 text-right'>
                    <span class='order-page total'>共 1787 个商品</span>
                    <span class='order-page'><span class='order-page-current'>1</span>/51</span>
                    <span class='order-page-btn'><button class='btn btn-default'>上一页</button> <button class='btn btn-default'>下一页</button></span>
                </div>
            </div>
            <!-- order line end -->
            <div class='m-t-20'>
            </div>
        </div>
        <!-- right end -->
    </div>
</div>


<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'>
    </div>
</div>
<?$this->load->view('home/footer')?>
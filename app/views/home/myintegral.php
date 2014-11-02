<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="myintegral">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <ul class="nav nav-tabs">
                <li class="">
                    <h4>我的积分</h4>
                </li>                
            </ul>
            <div class="block">
            <div class="nav ">
            
            <li class="dropdown col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin:0;padding:0">
                        积分记录(近三个月数据) <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu " role="menu">
                        <li>
                            <a href="#overview_4" tabindex="-1" data-toggle="tab">123</a>
                        </li>
                        <li>
                            <a href="#overview_4" tabindex="-1" data-toggle="tab">123456</a>
                        </li>
                    </ul>
                </li>
            </div>
        </div>
            <div id="myTabContent" class="tab-content">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="">积分</th>
                            <th width="30%">变动时间</th>
                            <th width="40%">原因</th>
                            <th width="20%">订单金额</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >
                                <div>
                                   1111
                                </div>
                            </td>
                            <td>2014-12-10</td>
                            <td>
                                2222222
                            </td>
                             <td>
                                2222222
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div>
                                   1111
                                </div>
                            </td>
                            <td>2014-12-10</td>
                            <td>
                                2222222
                            </td>
                             <td>
                                2222222
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div>
                                   1111
                                </div>
                            </td>
                            <td>2014-12-10</td>
                            <td>
                                2222222
                            </td>
                             <td>
                                2222222
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="text-right">
                        <ul class="pagination">
                            <li>
                                <a href="#">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">6</a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="faq">
                        <h5>积分获取及使用常见问题</h5>
                        <p>
                            1. 您兑换的购物券为电子券，有效期为一年，自成功兑换之日起计算。<br>
2. 购物券仅限本ID使用，不能折算为现金、也不能再次兑换为积分。<br>
3. 每日至多换取三张优惠券。
                        </p>
                </div>

            </div>
        </div>
    </div>

    <?$this->load->view('home/footer')?>
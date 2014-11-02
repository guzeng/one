<?$this->load->view('home/header')?>
<div class='container m-t-20'>
    <div class='row' id="evaluation">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <ul class="nav nav-tabs">
                <li class="">
                    <h4>商品评价</h4>
                </li>

                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        更多筛选条件 <i class="fa fa-angle-down"></i>
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
            </ul>
            <div id="myTabContent" class="tab-content">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="">商品信息</th>
                            <th width="30%">购买时间</th>
                            <th width="20%">评价</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >
                                <div class="text-left">
                                    <span class="select-item">
                                        <a href="" target='_blank'>
                                            <img class='box' src="" width='48' height='48'></a>
                                        [赠品] 50元电子京券（订单完成后自动发放）
                                    </span>
                                </div>
                            </td>
                            <td>2014-12-10</td>
                            <td>
                                <a herf="javascript:void(0)" onclick="confirm_dialog('', '', delCart, '66')">发表评价</a>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div class="text-left">
                                    <span class="select-item">
                                        <a href="" target='_blank'>
                                            <img class='box' src="" width='48' height='48'></a>
                                        [赠品] 50元电子京券（订单完成后自动发放）
                                    </span>
                                </div>
                            </td>
                            <td>2014-12-10</td>
                            <td>
                                <a herf="javascript:void(0)" onclick="confirm_dialog('', '', delCart, '66')">发表评价</a>
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="3" class="tdorder text-left">

                                <div class="message">
                                    <span class="arrow"></span>
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-1 control-label">评分</label>
                                                <div class="col-md-7">

                                                    <ul class="stars list-inline">
                                                        <li class="select"> <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star-empty"></i>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-1 control-label">评语</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-7">
                                                    <button type="submit" class="btn green">确认</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div class="text-left">
                                        <span class="select-item">
                                            <a href="" target='_blank'>
                                                <img class='box' src="" width='48' height='48'></a>
                                            [赠品] 50元电子京券（订单完成后自动发放）
                                        </span>
                                    </div>
                                </td>
                                <td>2014-12-10</td>
                                <td>
                                    <a herf="javascript:void(0)" onclick="confirm_dialog('', '', delCart, '66')">发表评价</a>
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
                </div>

            </div>
        </div>
    </div>
</div>
    <?$this->load->view('home/footer')?>
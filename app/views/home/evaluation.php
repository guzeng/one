<?$this->load->view('home/header')?>
<script type="text/javascript">
    $("document").ready(function(){

    });
    function show_pingjia(detail_id,product_id,obj)
    {
        if($(obj).parent().parent().next(".tr_pingjia").html()){
            $(".tr_pingjia").remove();   
            return;
        }
        var html = "<tr class='tr_pingjia'>"+
                            "<td colspan='3' class='tdorder text-left'>"+
                                "<div class='message'>"+
                                    "<span class='arrow'></span>"+
                                    "<form class='form-horizontal' role='form'>"+
                                        "<div class='form-body'>"+
                                            "<div class='form-group'>"+
                                                "<label class='col-md-1 control-label'>评分</label>"+
                                                "<div class='col-md-7'>"+
                                                    "<input type='hidden' value='5' name='point' id='point'>"+
                                                    "<p style='margin-top:2px;*margin-top:5px' class='grade con'>"+
                                                        "<a href='javascript:void(0);' onclick='rate_review(1);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(2);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(3);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(4);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(5);' class='selected'></a> "+
                                                    "</p>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='form-group'>"+
                                                "<label class='col-md-1 control-label'>评语</label>"+
                                                "<div class='col-md-7'>"+
                                                    "<textarea id='content' name='content' class='form-control' rows='3'></textarea>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='form-group'>"+
                                                "<div class='col-md-offset-1 col-md-7'>"+
                                                    "<button type='button' onclick='commit("+detail_id+","+product_id+")' class='btn green'>确认</button>"+
                                                "</div>"+
                                            "</div>"+
                                        "</form>"+
                                    "</div>"+
                                "</td>"+
                            "</tr>";
        $(".tr_pingjia").remove();                   
        $(obj).parent().parent().after(html);
        if($(".tr_pingjia").length>0){
           $(".tr_pingjia").show();
        }
        $('.grade').find('a').mouseover(function(){
            var index = $(this).index();
            $.each($('.grade').find('a'),function(key,item){
                if(key < index){
                    $(item).addClass('hover');
                }
            })
        }).mouseout(function(){
            $('.grade').find('a').removeClass('hover');
        })
    }  

    function show_pingjia2(user_comment_id,detail_id,product_id,obj)
    {
        if($(obj).parent().parent().next(".tr_pingjia").html()){
            $(".tr_pingjia").remove();   
            return;
        }

        $.ajax({
            url:msg.base_url+"home/evaluation/edit",
            type:'post',
            data:{'id':user_comment_id},
            dataType:'json',
            success:function(json){
                if(json.code=='1000')
                {
                    if($(obj).parent().parent().next(".tr_pingjia").html()){
                        $(".tr_pingjia").remove();   
                    }
                    var html = "<tr class='tr_pingjia'>"+
                                        "<td colspan='3' class='tdorder text-left'>"+
                                            "<div class='message'>"+
                                                "<span class='arrow'></span>"+
                                                "<form class='form-horizontal' role='form'>"+
                                                    "<div class='form-body'>"+
                                                        "<div class='form-group'>"+
                                                            "<label class='col-md-1 control-label'>评分</label>"+
                                                            "<div class='col-md-7'>"+
                                                                "<input type='hidden' value='"+json.row['point']+"' name='point' id='point'>"+
                                                                "<input type='hidden' value='"+json.row['id']+"' name='id' id='id'>"+
                                                                "<p style='margin-top:2px;*margin-top:5px' class='grade con'>"+
                                                                    "<a href='javascript:void(0);' onclick='rate_review(1);' class='selected'></a> "+
                                                                    "<a href='javascript:void(0);' onclick='rate_review(2);' class='selected'></a> "+
                                                                    "<a href='javascript:void(0);' onclick='rate_review(3);' class='selected'></a> "+
                                                                    "<a href='javascript:void(0);' onclick='rate_review(4);' class='selected'></a> "+
                                                                    "<a href='javascript:void(0);' onclick='rate_review(5);' class='selected'></a> "+
                                                                "</p>"+
                                                            "</div>"+
                                                        "</div>"+
                                                        "<div class='form-group'>"+
                                                            "<label class='col-md-1 control-label'>评语</label>"+
                                                            "<div class='col-md-7'>"+
                                                                "<textarea id='content' name='content' class='form-control' rows='3'>"+json.row['content']+"</textarea>"+
                                                            "</div>"+
                                                        "</div>"+
                                                        "<div class='form-group'>"+
                                                            "<div class='col-md-offset-1 col-md-7'>"+
                                                                "<button type='button' onclick='commit("+detail_id+","+product_id+")' class='btn green'>确认</button>"+
                                                            "</div>"+
                                                        "</div>"+
                                                    "</form>"+
                                                "</div>"+
                                            "</td>"+
                                        "</tr>";
                    $(".tr_pingjia").remove();                   
                    $(obj).parent().parent().after(html);
                    if($(".tr_pingjia").length>0){
                       $(".tr_pingjia").show();
                    }
                    $('.grade').find('a').mouseover(function(){
                        var index = $(this).index();
                        $.each($('.grade').find('a'),function(key,item){
                            if(key < index){
                                $(item).addClass('hover');
                            }
                        })
                    }).mouseout(function(){
                        $('.grade').find('a').removeClass('hover');
                    })
                    //选分（星星）
                    rate_review(json.row['point']);
                }
                else if(json.code=='1002')
                {
                    show_login();
                }
                else
                {
                    show_error(json.msg);
                }
            }
        });  

        var html = "<tr class='tr_pingjia'>"+
                            "<td colspan='3' class='tdorder text-left'>"+
                                "<div class='message'>"+
                                    "<span class='arrow'></span>"+
                                    "<form class='form-horizontal' role='form'>"+
                                        "<div class='form-body'>"+
                                            "<div class='form-group'>"+
                                                "<label class='col-md-1 control-label'>评分</label>"+
                                                "<div class='col-md-7'>"+
                                                    "<input type='hidden' value='5' name='point' id='point'>"+
                                                    "<p style='margin-top:2px;*margin-top:5px' class='grade con'>"+
                                                        "<a href='javascript:void(0);' onclick='rate_review(1);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(2);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(3);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(4);' class='selected'></a> "+
                                                        "<a href='javascript:void(0);' onclick='rate_review(5);' class='selected'></a> "+
                                                    "</p>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='form-group'>"+
                                                "<label class='col-md-1 control-label'>评语</label>"+
                                                "<div class='col-md-7'>"+
                                                    "<textarea id='content' name='content' class='form-control' rows='3'></textarea>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='form-group'>"+
                                                "<div class='col-md-offset-1 col-md-7'>"+
                                                    "<button type='button' onclick='commit("+detail_id+","+product_id+")' class='btn green'>确认</button>"+
                                                "</div>"+
                                            "</div>"+
                                        "</form>"+
                                    "</div>"+
                                "</td>"+
                            "</tr>";
        $(".tr_pingjia").remove();                   
        $(obj).parent().parent().after(html);
        if($(".tr_pingjia").length>0){
           $(".tr_pingjia").show();
        }
        $('.grade').find('a').mouseover(function(){
            var index = $(this).index();
            $.each($('.grade').find('a'),function(key,item){
                if(key < index){
                    $(item).addClass('hover');
                }
            })
        }).mouseout(function(){
            $('.grade').find('a').removeClass('hover');
        })
    }  

    /**
     * rate_review
     * 评价，评分
     */
    function rate_review(i)
    {
        if(typeof(i)!='undefined')
        {
            $('#point').val(i);
            $.each($('.grade').find('a'),function(key,item){
                if(key < i){
                    $(item).addClass('selected');
                }else{
                    $(item).removeClass('selected');
                }
            })
        }
    }

    function commit(order_detail_id,product_id)
    {
        var point = $("#point").val();
        var content = $("#content").val();
        var id = $("#id").val();
        if(typeof(id) == 'undefined')
        {
            id = "";
        }
        $.ajax({
            url:msg.base_url+"home/evaluation/update",
            type:'post',
            data:{'order_detail_id':order_detail_id,'product_id':product_id,'point':point,'content':content,'id':id},
            dataType:'json',
            success:function(json){
                if(json.code=='1000')
                {
                    show_success(json.msg);
                    window.location.href = msg.base_url+json.goto;
                }
                else if(json.code=='1002')
                {
                    show_login();
                }
                else
                {
                    show_error(json.msg);
                }
            }
        });  
    }
</script>
<div class='container m-t-20'>
    <div class='row' id="evaluation">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <!-- <ul class="nav nav-tabs">
                <li class="">
                    <h4>商品评价</h4>
                </li>

                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        更多筛选条件 <i class="fa fa-angle-down"></i>
                    </a>
                    <ul style="font-size:12px;" class="dropdown-menu " role="menu">
                        <li>
                            <a href="<?=base_url()?>home/evaluation/index/type/1" style="margin:0,10px;">未评价</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>home/evaluation/index/type/2" style="margin:0,10px;">已评价</a>
                        </li>
                    </ul>
                </li>
            </ul> -->
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
                        <?if(!empty($list)):?>
                        <?foreach($list as $key => $value):?>
                        <tr id="tr_<?php echo $value->id;?>">
                            <td >
                                <div class="text-left">
                                    <span class="select-item">
                                        <a target="_bank" href="<?php echo base_url()."item/id/".$value->product_id?>">
                                            <img width="150" height="100" src="<?php echo $this->product->pic($value->product_id);?>">
                                            <?php echo $value->name;?>
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td><?php echo date('Y-m-d',$value->create_time);?></td>
                            <td>
                                <?php if(isset($value->commented) && $value->commented && isset($value->comment_id) && $value->comment_id):?>
                                <a herf="javascript:void(0)" onclick="show_pingjia2(<?php echo $value->comment_id;?>,<?php echo $value->id;?>,<?php echo $value->product_id;?>,this)" >已评价</a>
                                <?else:?>
                                <a herf="javascript:void(0)" onclick="show_pingjia(<?php echo $value->id;?>,<?php echo $value->product_id;?>,this)">发表评价</a>
                                <?endif;?>
                            </td>
                        </tr>
                        
                        <?endforeach;?>
                        <?else:?>
                        <tr>
                          <td colspan="3">暂无信息！</td>
                       </tr>
                        <?endif;?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <!-- paginition start -->
                        <?if(isset($pagination)):?>
                        <div class="pagination pagination-right padding-right-20 pull-right">
                        <?=isset($pagination)?$pagination:''?>
                        </div>
                        <?endif;?>
                        <!-- paginition end -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <?$this->load->view('home/footer')?>
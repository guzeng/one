<?$this->load->view('admin/header');?>
<!-- BEGIN PAGE -->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            答题统计
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url()?>">首页</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="<?php echo base_url();?>admin/questionnaires">所有调查问卷</a>
                <?if(isset($row)):?>
                <i class="fa fa-angle-right"></i>
                <?endif;?>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">答题统计</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="btn-group">
                <button class="btn btn-link" type="button" onclick="goback()">
                    <i class="fa fa-reply"></i><span>返回</span>
                </button>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SHOW RESULT-->
        <div class="portlet">
            <div class="">
                <div class="caption">
                </div>
            </div>
            <?php if(isset($questionnaire) && !empty($questionnaire)):?>
                <div class="portlet-body">
                    <div style='text-align:center'>
                        <h3 style="padding:15px 0px"><b><?php echo stripslashes($questionnaire->title)?></b></h3>
                    </div>
                    <?php if(isset($questions) && !empty($questions)):$postion=0?>
                        <?php foreach($questions as $k => $q):?>
                            <p style="margin:15px 0 5px 15px;">
                                <?php echo ++$postion.".".stripslashes($q->title);?>&nbsp;(<?php echo "答题人数".": ".$q->record;?>)
                            </p>
                            <?php if(!empty($q->options)):?>
                                <table style="margin-left:22px;width:50%">
                                    <?php foreach($q->options as $k => $o):$percent=($q->title!=0 ? round($o->record / $q->record, 4)*100 : 0)?>
                                        <tr>
                                            <td width="50%">
                                                <label class="<?php echo $q->type == 0 ? 'radio-inline' : 'checkbox-inline';?>">
                                                    <input type="<?php echo $q->type == 0 ? 'radio' : 'checkbox';?>" name="<?php echo $q->id;?>">
                                                    <?php echo stripcslashes($o->title);?>
                                                </label>
                                            </td>
                                            <td width="50%">
                                                <div class="progress" style="width: 160px;height: 10px;margin-bottom: 0px;margin-top: 5px;float:left;">
                                                    <div class="progress-bar progress-bar-success" style="width: <?php echo $percent?>%;"></div>
                                                </div>
                                                <div style="margin-left: 10px;float:left;"><?php echo $percent?>%(<?php echo $o->record;?>)</div>
                                                <div class="clearfix"></div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php else:?>
                        <h5 style="padding:15px 15px;"><?php echo Lang::get('text.questionnaire_list_empty');?></span>
                    <?php endif;?>
                </div>
            <?php endif;?>
        </div>
        <!-- END SHOW RESULT-->
    </div>
</div>
<!-- END PAGE CONTENT-->
<?$this->load->view('admin/footer');?>
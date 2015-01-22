<?$this->load->view('admin/header');?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2_metro.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.css" />
    <!-- END PAGE LEVEL STYLES -->
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        角色设置
                    </h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo base_url()?>admin">首页</a> 
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">系统管理</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>角色设置</li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->


            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue" id='role_list'>
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-list"></i>角色设置</div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a href='<?php echo base_url();?>admin/roles/edit' class="btn blue m-r-5">
                                            <i class="fa fa-plus"></i> 新增角色
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <?php echo $list;?>
                            </div>
                            
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>

    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
    
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        msg.save = "保存";
        msg.name_can_not_empty = "名字不能为空";
        msg.check_permission = "设置权限";
        msg.cancel = "取消";
        msg.delete_confirm = "删除确认";
        msg.sure_to_delete = "您确定要删除该条记录？";
        msg.role_cn_name = "角色名字";
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/scripts/admin/roles.js"></script>
<?$this->load->view('admin/footer');?>
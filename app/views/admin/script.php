
    <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->   
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/plugins/respond.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/excanvas.min.js"></script> 
    <![endif]-->

    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url();?>assets/scripts/app.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    <script type="text/javascript">
        jQuery(document).ready(function() {    
           App.init(); // initlayout and core plugins
        });
    </script>
    <!-- END JAVASCRIPTS -->
    
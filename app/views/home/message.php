<?$this->load->view('home/header')?>

<div class='container m-t-20'>
    <div class='row' id="user-info">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <div id="main">
                <?php if(isset($success)):?>
                    <div class="alert alert-success text-center p-t-50 p-b-50">
                        <strong><?php echo $success?></strong>
                    </div>
                <?php elseif(isset($error)):?>
                    <div class="alert alert-danger text-center p-t-50 p-b-50">
                        <strong><?php echo $error?></strong>
                    </div>
                <?php elseif(isset($msg)):?>
                    <div class="alert alert-info text-center p-t-50 p-b-50">
                        <strong><?php echo $msg?></strong>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>
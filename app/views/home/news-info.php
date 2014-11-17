<?$this->load->view('home/header')?>

<div class='container m-b-20'>
    <div class='row'>
        <div class='col-md-10 col-sm-10 col-xs-12 pinfo-top-left'>
            <h2 class='text-center'><?php echo $row->title?></h2>
            <div><?php echo $row->content?></div>
        </div>
        <div class='col-md-2 col-sm-2 col-xs-12 pinfo-top-right'>			
            <div class="see2see">
                <div class="midline">
                    <div class="midtext">看了又看</div>
                </div>
            </div>
            <div class="img relative" id='see_again'>
                <?if(!empty($view_again)):?>
                <?foreach($view_again as $key => $item):?>
                    <a href="<?php echo base_url()?>item/id/<?php echo $item->id?>">
                    <img class='img-responsive' src="<?php echo $this->product->pic($item->id)?>">
                    </a>
                <?endforeach;?>
                <?endif;?>
            </div>
            <div class="nav">
                <span class="pull-left hand" onclick="item_go('up')">
                    <img class='img-responsive' src="<?php echo base_url();?>assets/img/portlet-expand-icon2.png"></span>
                <span class="pull-left hand" onclick="item_go('down')">
                    <img class='img-responsive' src="<?php echo base_url();?>assets/img/portlet-collapse-icon2.png"></span>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/scripts/home/item.js" type="text/javascript"></script>
<?$this->load->view('home/footer')?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		$data = array();
		$show_count = 3;//首页展示楼层数量
		$this->load->model('product');
		$this->load->model('product_category');
		$this->load->model('product_category_map');
		$this->load->model('newss');
		$this->load->model('link');
		$this->load->model('product_brand');
		
		$product_cate = $this->product_category->get_level_tree();//树状产品类型
		
		if($product_cate){
			foreach ($product_cate as $key => $item) {
				$cate_id_ary = $this->product_category->get_all_children($item['id']);
				$ids = array($item['id']);
				foreach ($cate_id_ary as $k => $v) {
					$ids[] = $v;
				}

				$hot_product = $this->product_category_map->get_product_by_cate($ids);
				$product_cate[$key]['hot_product'] = $hot_product;
				if($key == ($show_count-1))	//只展示前三楼
					break;
			}
		}

		$handpick_product = $this->product->lists(8,'','',array('handpick = 1'));

		$data['handpick_product'] = $handpick_product;
		$data['show_count'] = $show_count;
		$data['product_cate'] = $product_cate;
		$data['news'] = $this->newss->lists(array("status"=>"1","show_time >"=>local_to_gmt()),5,"a.show_time desc");//按发布时间
		$data['link'] = $this->link->lists(array("num"=>"5"));//最新五条友情链接
		$data['product_brand'] = $this->product_brand->lists(array("num"=>"10"));//最新27条品牌信息
		$this->load->view('home/index',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
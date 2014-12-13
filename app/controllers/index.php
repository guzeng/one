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
		$this->load->model('user');
		$this->load->model('product');
		$this->load->model('product_category');
		$this->load->model('product_category_map');
		$this->load->model('newss');
		$this->load->model('link');
		$this->load->model('product_brand');
		$this->load->model('ad');
		$this->load->model('order');
		$this->load->model('coupon');
		
		$product_cate = $this->product_category->get_level_tree();//树状产品类型
/*	
		if($product_cate){
			foreach ($product_cate as $key => $item) {
				$cate_id_ary = $this->product_category->get_all_children($item['id']);
				$ids = array($item['id']);
				foreach ($cate_id_ary as $k => $v) {
					$ids[] = $v;
				}

				$hot_product = $this->product_category_map->get_product_by_cate($ids);	//首页展示的商品
				$brand = $this->product_brand->get_by_cateid($item['id']); 				//首页商品区展示的品牌
				$product_cate[$key]['hot_product'] = $hot_product;
				// $product_cate[$key]['product_cate_brand'] = $brand;
				if($key == ($show_count-1))	//只展示前三楼
					break;
			}
		}
*/
		//$handpick_product = $this->product->lists(8,'','',array('handpick = 1'));

		//$data['handpick_product'] = $handpick_product;
		$data['show_count'] = $show_count;
		$data['product_cate'] = $product_cate;
		$data['news'] = $this->newss->lists(array("status='1' or (status='2' and show_time < ".local_to_gmt().")","cate_id='1'"),5,"a.show_time desc");//按发布时间
		$data['vip_news'] = $this->newss->lists(array("status='1' or (status='2' and show_time < ".local_to_gmt().")","cate_id='2'"),5,"a.show_time desc");//按发布时间
		$data['link'] = $this->link->lists(array("num"=>"5"));//最新五条友情链接
		$data['ad_home'] = $this->ad->lists(array("where"=>"position_id = 1"));//首页广告
		//$data['ad_1F'] = $this->ad->lists(array("where"=>"position_id = 2"));//1L广告
		//$data['ad_2F'] = $this->ad->lists(array("where"=>"position_id = 3"));//2L广告
		//$data['ad_3F'] = $this->ad->lists(array("where"=>"position_id = 4"));//3L广告
		$data['product_brand'] = $this->product_brand->lists(array("num"=>"10"));//最新27条品牌信息
		$data['coupon'] = $this->coupon->lists(array("expirse_from < ".local_to_gmt(),"expirse_to > ".local_to_gmt()),5,"a.id desc");
		if($this->auth->is_login())
		{
			$data['order_count'] = $this->order->user_count(array('user_id'=>$this->auth->user_id()));
			$user = $this->user->get($this->auth->user_id());
			$data['score'] = $user->score;
		}
		$this->load->view('home/index',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
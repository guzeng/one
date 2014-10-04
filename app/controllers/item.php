<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product');
        $this->load->model('product_category');
        $this->load->model('product_brand');
    }
	public function index()
	{
		$this->load->view('home/item');
	}

	public function id($id)
	{
		if(!$id)
		{
			show_error('参数错误',500);
		}
		$product = $this->product->get($id);
		if(!$product)
		{
			show_404();
		}
		$category = $this->product_category->get($product->cate_id);
		
		if($category)
		{
			$data['category'] = $category;
			if($category->parent_id)
			{
				$parent = $this->product_category->get($category->parent_id);
				$data['parent'] = $parent;
				$data['child'] = $this->product_category->all(array('where'=>array('parent_id'=>$category->parent_id)));	
			}
		}
		$brand = $this->product_brand->get($product->brand_id);
		$data['brand_name'] = '';
		if($brand)
		{
			$data['brand_name'] = $brand->name;
		}
		$data['product'] = $product;
		//看了又看
		$data['view_again'] = $this->product->all(array('status'=>1),'view_num desc','',3);
		//销售排行
		$data['goodsale'] = $this->product->all(array('status'=>1),'sale_num desc','',9);
		//最终购买了
		$data['last_buy'] = $this->product->all(array('status'=>1),'','',3);
		$this->load->view('home/item',$data);
	}
}

/* End of file item.php */
/* Location: ./application/controllers/item.php */
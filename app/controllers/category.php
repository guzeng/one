<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_category');
		$this->load->model('product');
		$this->load->model('product_brand');
        $this->list_type = '';
    }
	public function index()
	{
		$cate_id = $this->product->param['cate_id'];
		if($cate_id)
		{
			$category = $this->product_category->get($cate_id);
			$data['category'] = $category;
			if($category)
			{
				if($category->parent_id)
				{
					$parent = $this->product_category->get($category->parent_id);
					$data['parent'] = $parent;
					$data['child'] = $this->product_category->all(array('where'=>array('parent_id'=>$category->parent_id)));	
				}
			}
			else
			{
				show_404();
			}
		}
		$data['hot'] = $this->product->all(array('status'=>1),'a.sale_num desc','',10);
		
		$this->list_type = 'return';
		$data['plist'] = $this->plist();
		//猜你喜欢
		$data['like_list'] = $this->product->all(array('status'=>1),'','',8);
		//最终购买了
		$data['last_buy'] = $this->product->all(array('status'=>1),'','',3);

		$this->load->view('home/category',$data);
	}

	public function plist()
	{
		$order_by = isset($this->product->params['orderby']) ? $this->product->params['orderby'] : '';
		$desc = isset($this->product->params['desc']) && in_array($this->product->params['desc'], array('desc','asc')) ? $this->product->params['desc'] : 'desc';
		$orderby = '';
		switch ($order_by) {
			case 'sale':
				$orderby = 'sale_num '.$desc;
				break;
			case 'price':
				$orderby = 'price '.$desc;
				break;
			case 'comment':
				$orderby = 'comment_num '.$desc;
				break;
			case 'time':
				$orderby = 'putaway_time '.$desc;
				break;
		}
		$data['list'] = $this->product->lists(16,$orderby,'',array("a.`status` = '1'"));
		$data['count'] = $this->product->count();
		$data['all_page'] = ceil($data['count']/16);
		$data['per_page'] = $data['all_page'] > 0 ? $this->product->page : 0;
		$data['orderby'] = $order_by;
		$data['desc'] = $desc=='desc' ? 'asc' : 'desc';
		$data['cate_id'] = $this->product->param['cate_id'];
		$data['brand_id'] = $this->product->param['brand_id'];
		$data['price'] = $this->product->param['price'];
		$data['product_brand'] = $this->product_brand->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('home/category-plist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('home/category-plist',$data,true)
            ));            
        }
	}
}

/* End of file category.php */
/* Location: ./application/controllers/category.php */
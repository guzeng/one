<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
        $this->list_type = '';
    }
	public function index()
	{
		$data['hot'] = $this->product->all(array('status'=>1),'a.sale_num desc','',10);
		$data['product_cate'] = $this->product_category->get_level_tree();//树状产品类型
		//print_r($data['product_cate']);
		$this->list_type = 'return';
		$data['plist'] = $this->plist();

		$this->load->view('home/search',$data);
	}

	public function plist()
	{
		$post = $this->input->post();
		if($post)
		{
			$keyword = $post['keyword'];
		}
		else
		{
			$params = $this->uri->uri_to_assoc(3);
			$keyword= urldecode($params['keyword']);
		}
		$data['keyword'] = urlencode($keyword);

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
		//$this->product->condition(array('a.`status` = "1" and (a.code like "%'.$keyword.'%" or a.name like "%'.$keyword.'%" )'));
		$cond = array('a.`status` = "1" and (a.code like "%'.$keyword.'%" or a.name like "%'.$keyword.'%" )');
		$data['list'] = $this->product->lists(16,$orderby,'',$cond);
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
            return $this->load->view('home/search-plist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('home/search-plist',$data,true)
            ));            
        }
	}
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */
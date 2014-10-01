<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('order');
    }
	public function index()
	{
		$this->auth->check_login();
  	    $user_id = $this->auth->user_id();
        $this->load->model('product');
		// $param = $this->uri->uri_to_assoc(4);
		$keyword = $this->input->post('keyword')!='' ? trim($this->input->post('keyword')) : (isset($param['keyword']) ? $param['keyword'] : '');
        $keyword = urldecode(trim($keyword));
        $search_type = $this->input->post('search_type')!='' ? trim($this->input->post('search_type')) : (isset($param['search_type']) ? $param['search_type'] : '');

        $data['keyword'] = stripslashes($keyword);
        $condition = array("a.user_id = '".$user_id."'");


        if($search_type && $keyword)
        {
            $condition[$search_type] = $keyword;
        }
        
        $temp = $this->order->lists($condition,15,'a.id desc,d.order_id asc');
        $orderlist = array();
        
        if($temp)
        {
            $i = 0;
            foreach ($temp as $key => $item) {
                if($key != 0 && isset($last_order_id) && $last_order_id != $item->order_id)
                {
                    $i++;
                }
                $item->product_pic = $this->product->pic($item->product_id);
                $orderlist[$i][] = $item;
                $last_order_id = $item->order_id;
            }
        }

        $data['order_list'] = $orderlist;
        $data['pagination'] = $this->order->pages($condition);
		$this->load->view('home/order',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
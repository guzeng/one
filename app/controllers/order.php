<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

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
		// $this->auth->check_login();
  //   	$user_id = $this->auth->user_id();
		// $param = $this->uri->uri_to_assoc(4);
		// $keyword = $this->input->post('keyword')!='' ? trim($this->input->post('keyword')) : (isset($param['keyword']) ? $param['keyword'] : '');
  //       $keyword = urldecode(trim($keyword));
  //       $page = isset($param['page']) ? trim($param['page']) : 1;
  //       $base_url = '';
		// $items = array();
  //       $where = array();

  //       if($keyword != '')
  //       {
  //           $where[] = "a.title like '%".addslashes(str_replace('%', '\%', $keyword))."%' ";
		//     $base_url .= 'keyword/'.urlencode($keyword).'/';
  //       }
  //       if(!empty($where))
  //       {
  //           $items['where'] = "(".implode(") and (",$where).")";
  //       }
        
  //       $config['per_page'] = 15;
  //       $items['type'] = 'count(a.id) as count';
  //       $all = $this->news->fetch_items($items);
  //       $count = $all[0]->count;
  //       if($count > 0)
  //       {
        
  //           $items['type'] = 'a.id,a.title,a.create_time,a.status,a.type,u.name';
  //           $items['num'] = $config['per_page'];
  //           $items['start'] = (intval($page)-1)*$config['per_page'];
  //           $items['join_user'] = true;
		//     $orderlist = $this->news->fetch_items($items);
  //           $config['total_rows'] = $count;
  //           $config['base_url'] = rtrim($base_url,'/');
  //           $this->pagination->initialize($config);
  //           $data['pagination'] = $this->order->pages();
  //       }
  //       else
  //       {
  //           $orderlist = array();
  //       }
  //       $data['keyword'] = stripslashes($keyword);
  //       $data['order_list'] = $orderlist;

		$this->load->view('home/order');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
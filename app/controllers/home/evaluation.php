<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */

	public function index()
	{
		$this->load->model('order_detail');
		$this->auth->check_login();
       
        $user_id = $this->auth->user_id();
        $this->load->model('product');
        $this->load->model('order_detail');
        $base_url = base_url().'/home/evaluation/index/';
        $param = $this->uri->uri_to_assoc(4);
        
        $condition = array("a.user_id = '".$user_id."'");
        $list = $this->order_detail->lists($condition,15,'a.id desc');

        $data['list'] = $list;
        $data['pagination'] = $this->order_detail->pages($base_url,$condition);

		$this->load->view('home/evaluation',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
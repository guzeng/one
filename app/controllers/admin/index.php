<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->show_dashboard = '';
    }
	public function index()
	{
        $this->auth->check_login();
		$this->show_dashboard = 'return';
		$this->load->model('product');
		$this->load->model('order');
		$this->load->model('user');
		$this->load->model('newss');
		$data['product_count'] = $this->product->count();
		$data['order_count'] = $this->order->count();
		$data['member_count'] = $this->user->count();
		$data['news_count'] = $this->newss->count();
		$data['dashboard'] = $this->dashboard();
		$this->load->view('admin/index', $data);
	}
	/**
	 * 首页面板内容
	 */
	public function dashboard()
	{
		if($this->show_dashboard == 'return')
		{
			return $this->load->view('admin/dashboard','',true);
		}
		else
		{
        	$this->auth->check_login_json();
			$this->load->view('admin/dashboard');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
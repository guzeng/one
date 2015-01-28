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
        if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
            $this->auth->check_login_json();
            $this->auth->check_permission('json');
        } else {
            $this->auth->check_login();
            $this->auth->check_permission();
        }
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
		//最近15天订单数量
		$orders = $this->order->all(array('create_time >'=>time()-3600*24*15));
		$o = array();
		for($i=15;$i>-1;$i--)
		{
			$o[date('Y-m-d',time()-3600*24*$i)] = array('order'=>0);
		}
		if(!empty($orders))
		{
			foreach ($orders as $key => $value) {
				if(isset($o[date('Y-m-d',$value->create_time)]))
				{
					$o[date('Y-m-d',$value->create_time)]['order']++;
				}
			}
		}
		$data['days'] = $o;
		/*
			订单饼图数据
		*/
        $s = $this->order->status();
        $count = array();
        $total = 0;
        foreach($s as $key => $value)
        {
            $c= $this->order->count(array('status="'.$key.'"'));
            $a = array('status'=>$key,'count'=>$c);
            $count[$value] = $a;
            $total += $c;
        }
        $data['order_pie_count'] = $count;
        $data['order_pie_total'] = $total>0?$total:1;
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
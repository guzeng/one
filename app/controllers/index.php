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
		$this->load->model('product_category');
		$this->load->model('newss');
		$this->load->model('link');
		
		$data['product_cate'] = $this->product_category->get_level_tree();//树状产品类型
		$data['news'] = $this->newss->lists(array("status"=>"1","show_time >"=>local_to_gmt()),5,"a.show_time desc");//按发布时间
		$data['link'] = $this->link->lists(array("num"=>"5"));//最新五条友情链接
		$this->load->view('home/index',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
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
		
		$data['product_cate'] = $this->product_category->get_level_tree();

		$this->load->view('home/index',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
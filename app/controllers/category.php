<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$this->load->model('product_brand');
		$data['product_brand'] = $this->product_brand->all();
		$this->load->view('home/category',$data);
	}

	public function plist()
	{
		$this->load->library('pagination');
		//$config['base_url'] = '';
		
		$config['total_rows'] = 200;
		$config['per_page'] = 20;

		$this->pagination->initialize($config); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
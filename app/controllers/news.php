<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('newss');
    }
	public function index()
	{
	}

	public function info($id)
	{
		$this->load->model('product');
		if(!$id)
		{
			show_error('参数错误',500);
		}
		$row = $this->newss->get($id);
		if(!$row)
		{
			show_404();
		}
		
		$data['row'] = $row;
		//看了又看
		$data['view_again'] = $this->product->all(array('status'=>1),'view_num desc','',3);

		$this->load->view('home/news-info',$data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */
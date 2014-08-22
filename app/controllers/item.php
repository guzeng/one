<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {

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
		$this->load->view('home/item');
	}

}

/* End of file item.php */
/* Location: ./application/controllers/item.php */
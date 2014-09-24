<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

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
		$this->load->view('home/history');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
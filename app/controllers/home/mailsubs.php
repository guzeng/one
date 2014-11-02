<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailsubs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */

	public function index()
	{
	
		$this->load->view('home/mailsubs');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupons extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('coupon');
    }
	public function index()
	{
		$this->auth->check_login();
  	    $user_id = $this->auth->user_id();
        $param = $this->uri->uri_to_assoc(4);
        $type = $this->input->post('type') ? trim($this->input->post('type')) : 
              (isset($param['type']) ? urldecode(trim($param['type'])) : 1);
        $condition = array("a.user_id = '".$user_id."'");

        if ($type == "1") {
            $condition[] = 'a.is_use = 1 and a.expirse_to > '.time();
        }
        else if($type == "2"){
            $condition[] = 'a.is_use = 2';
        }
        else if($type == "3"){
            $condition[] = 'a.is_use = 1 and a.expirse_to <'.time();
        }
        
        $list = $this->coupon->lists($condition,15,'a.id desc');

        $data['list'] = $list;

        $data['pagination'] = $this->coupon->pages($condition);
        $data['type'] = $type;
		$this->load->view('home/coupon',$data);
	}
}

/* End of file Coupons.php */
/* Location: ./application/controllers/Coupons.php */
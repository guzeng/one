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

	public function index($id)
    {
        $this->auth->check_login();
        $this->load->model('user_coupon');
        if(!$id)
            show_404('',false);
        $data['user_coupon'] = $this->user_coupon->get(array('user_id'=>$this->auth->user_id(),'coupon_id'=>$id));
        $data['row'] = $this->coupon->get($id);
        return $this->load->view('home/coupon-detail',$data);
    }
}

/* End of file Coupons.php */
/* Location: ./application/controllers/Coupons.php */
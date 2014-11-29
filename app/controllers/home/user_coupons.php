<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_coupons extends CI_Controller {

    /**
     * Index Page for this controller.
     * 
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_coupon');
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
            $condition[] = 'a.is_use = 1 and c.expirse_to > '.time();
        }
        else if($type == "2"){
            $condition[] = 'a.is_use = 2';
        }
        else if($type == "3"){
            $condition[] = 'a.is_use = 1 and c.expirse_to <'.time();
        }
        
        $list = $this->user_coupon->lists($condition,15,'a.id desc');

        $data['list'] = $list;
        $data['pagination'] = $this->user_coupon->pages($condition);
        $data['type'] = $type;
        $this->load->view('home/coupon',$data);
    }

    public function update()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        $user_id = $this->auth->user_id();
        if(empty($post))
        {
            show_error('参数错误');
        }
        if(!$user_id)
        {
            show_404('',false);
        }
        $data = array('code' => '1000', 'msg' => '成功领取');

        $this->load->model('user_coupon');
        $count = $this->user_coupon->exist(array("user_id"=>$user_id,"coupon_id"=>$post['id']));
        if($count)
        {
            $data['code'] = "1001";
            $data['msg'] = "你已经领取过了";             
        }
        else
        {
            $row = array(
                'user_id' => $user_id,
                'coupon_id' => $post['id'],
                'is_use' => 0
            );
            if(!$this->user_coupon->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_failed'));
            }
        }
        
        // if($data['code'] == '1000')
        // {
        //     $data['goto'] = 'admin/coupons';
        // }
        echo json_encode($data);
    }
}

/* End of file Coupons.php */
/* Location: ./application/controllers/Coupons.php */
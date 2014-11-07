<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('order');
    }
	public function index()
	{
		$this->auth->check_login();
  	    $user_id = $this->auth->user_id();
        $this->load->model('product');
        $this->load->model('order_detail');
		$keyword = $this->input->post('keyword')!='' ? trim($this->input->post('keyword')) :  '';
        $keyword = urldecode(trim($keyword));
        $search_type = $this->input->post('search_type')!='' ? trim($this->input->post('search_type')) : (isset($param['search_type']) ? $param['search_type'] : '');
        
        $params = $this->uri->uri_to_assoc(4);
        $status = $this->param['status'] = $this->input->post('status')!='' ? trim($this->input->post('status')) : 
            (isset($params['status']) ? trim($params['status']) : '');
        $create_time = $this->input->post('create_time')!='' ? trim($this->input->post('create_time')) :  '';
        
        $condition = array("a.user_id = '".$user_id."'");
        if($create_time)
        {
            switch ($create_time) {
                case 1:
                    $start_time = strtotime('-3 month');
                    $end_time = time();
                    break;
                case 2:
                    $start_time = strtotime(date('Y',time()).'-1-1');
                    $end_time = strtotime(date('Y',time()).'-12-31');
                    break;
                case 3:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-1).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-1).'-12-31')));
                    break;
                case 4:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-2).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-2).'-12-31')));
                    break;
                case 5:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-12-31')));
                    break;
                case 6:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-20).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-1-1')));
                    break;
                default:
                    $start_time = strtotime('-1 year');
                    $end_time = time();
                    break;
            }

            $condition[] =$start_time." <= a.create_time";
            $condition[] ="a.create_time <= ".$end_time;
        }

        $all = $this->order->all($condition);
        $fu_kuan = 0;
        $fa_huo = 0;
        $shou_huo = 0;
        $ping_jia = 0;
        if($all)
        {
            foreach ($all as $key => $item) {
                if(intval($item->status) == 1){
                    $fu_kuan++;
                }
                else if(intval($item->status) == 2){
                    $fa_huo++;
                }   
                else if(intval($item->status) == 3){
                    $shou_huo++;
                }
                else if(intval($item->status) == 4){
                    $ping_jia++;
                }
            }
        }

        if($status)
        {
            $condition[] = 'a.status = '.$status.' and a.status != 4 and a.status != 5 ';
        }
        
        $orderlist = $this->order->lists($condition,15,'a.id desc','a.id');
        if($orderlist)
        {
            foreach ($orderlist as $key => $item) {
                $result = $this->order_detail->get($item->id,$item->address_id);
                $item->order_detail = $result;
            }
        }

        $data['fu_kuan'] = $fu_kuan;
        $data['fa_huo'] = $fa_huo;
        $data['shou_huo'] = $shou_huo;
        $data['ping_jia'] = $ping_jia;

        $data['order_list'] = $orderlist;
        $data['pagination'] = $this->order->pages($condition);
        $data['keyword'] = stripslashes($keyword);
        $data['search_type'] = $search_type;
        $data['status'] = $status;
        $data['create_time'] = $create_time;
		$this->load->view('home/order',$data);
	}
}

/* End of file orders.php */
/* Location: ./application/controllers/orders.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistic extends CI_Controller {

	/**
	 * statistic Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
		$this->list_type = '';
    }
	public function product()
	{
        $this->auth->check_login();
        $this->list_type = 'return';
		$this->load->model('product');
        $this->load->model('product_category');
        $this->load->model('product_category_map');
        $category = $this->product_category->tree();
        $data['category_list'] = $category;

        $param = $this->uri->uri_to_assoc(4);
        $keyword = $this->input->post('keyword')!='' ? trim($this->input->post('keyword')) : (isset($param['keyword']) ?       $param['keyword'] : '');
        $keyword = urldecode(trim($keyword));

        $stock = $this->input->post('stock')!='' ? trim($this->input->post('stock')) : 
                    (isset($param['stock']) ? $param['stock'] : '');
        $stock = intval(urldecode(trim($stock)));
        
        $page = isset($param['page']) ? trim($param['page']) : 1;
        $base_url = '';
        $items = array();
        $where = array();
        if($keyword != '')
        {
            $where[] = "a.name like '%".addslashes(str_replace('%', '\%', $keyword))."%' ";
            $base_url .= 'keyword/'.urlencode($keyword).'/';
        }
        if($stock > 0)
        {
            $where[]="a.amount <= ".$stock;
        }
        if(!empty($where))
        {
            $items['where'] = "(".implode(") and (",$where).")";
        }
        
        $config['per_page'] = 2;
        $items['type'] = 'count(a.id) as count';
        $all = $this->product->fetch_items($items);
        $count = $all[0]->count;
        if($count > 0)
        {
            $items['type'] = 'a.*';
            $items['num'] = $config['per_page'];
            $items['start'] = (intval($page)-1)*$config['per_page'];
            //$items['join_user'] = true;
            $list = $this->product->fetch_items($items);
            $config['total_rows'] = $count;
            $config['base_url'] = rtrim($base_url,'/');
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->links();
        }
        else
        {
            $list = array();
        }
        $data['keyword'] = stripslashes($keyword);
        $data['list'] = $list;
        $data['stock'] = $stock;

		$this->load->view('admin/statistic/product_list', $data);
	}
    //-------------------------------------------------------------------------

    public function product_lists()
    {
        $data['list'] = $this->product->all(array('status !='=>2));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/statistic/product_datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/statistic/product_datalist',$data,true)
            ));            
        }
    }
    //-------------------------------------------------------------------------

    public function order()
    {
        $this->auth->check_login();
        $this->list_type = 'return';
		$this->load->model('order');
        $s = $this->order->status();
        $count = array();
        $total = 0;
        foreach($s as $key => $value)
        {
            $c= $this->order->count(array('status="'.$key.'"'));
            $a = array('status'=>$key,'count'=>$c);
            $count[$value] = $a;
            $total += $c;
        }
        $data['count'] = $count;
        $data['total'] = $total>0?$total:1;
		$this->load->view('admin/statistic/order_list', $data);
    }
}

/* End of file statistic.php */
/* Location: ./application/controllers/statistic.php */
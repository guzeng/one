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
        $data['param'] = $this->product->get_param();//stripslashes
        $data['list'] = $this->product_lists();
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
		$this->load->view('admin/statistic/order_list', $data);
    }
}

/* End of file statistic.php */
/* Location: ./application/controllers/statistic.php */
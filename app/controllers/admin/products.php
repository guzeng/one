<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product');
        $this->load->model('product_category');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $category = $this->product_category->all(array('orderby' =>'parent_id asc,id asc'));
        $data['category_list'] = $category;
        $data['param'] = $this->product->get_param();//stripslashes
        echo json_encode(array(
        	'code' => '1000',
        	'data' => $this->load->view('admin/product-list',$data,true)
        ));
	}
    //-------------------------------------------------------------------------

}
/* End of file products.php */
/* Location: ./lms_app/controllers/admin/products.php */
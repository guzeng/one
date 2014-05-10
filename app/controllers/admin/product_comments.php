<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_comments extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_comment');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/product_comment/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->product_comment->all(array('orderby' =>'id asc'));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product_comment/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product_comment/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

}
/* End of file product_comments.php */
/* Location: ./lms_app/controllers/admin/product_comments.php */
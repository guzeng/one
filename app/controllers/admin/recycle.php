<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recycle extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author alex
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_category');
        $this->load->model('product');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $category = $this->product_category->all(array('orderby' =>'parent_id asc,id asc'));
        $data['category_list'] = $category;
        $data['list'] = $this->recycle_lists();
        $this->load->view('admin/product/recycle-list',$data);
	}
    //-------------------------------------------------------------------------

    public function recycle_lists()
    {
        $data['list'] = $this->product->all(array('status'=>2));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product/recycle-datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product/recycle-datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function reagin($id)
    {
        if(!$id)
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '还原成功');
        $row = array(
            'status' => 0
        );
        if(!$this->product->update($row,$id))
        {
            $data = array('code'=>'1001','msg'=>"还原失败");
        }
        else
        {
            $data['data'] = array('id'=>$id);
        }
        echo json_encode($data);
    }
    //-------------------------------------------------------------------------

    public function delete($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->product->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
            @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'.png');
            @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'_thumb.png');
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }
}
/* End of file provider.php */
/* Location: ./lms_app/controllers/admin/provider.php */
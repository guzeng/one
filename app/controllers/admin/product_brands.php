<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_brands extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_brand');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/product_brand/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->product_brand->all(array('orderby' =>'id asc'));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product_brand/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product_brand/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $data = array();
        if($id)
        {
            $row = $this->product_brand->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/product_brand/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', ' ', 'required|max_length[50]'); 
        $this->form_validation->set_rules('info', ' ', 'max_length[100]'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['name'] = form_error('name');
            $error['info'] = form_error('info');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
            $where = array('name'=>trim($post['name']),'id !='=>$post['id']);
            if($this->product_brand->exist($where))
            {
                $error['name'] = '名称已存在';
            }
        }
        else
        {
            $where = array('name'=>trim($post['name']));
            if($this->product_brand->exist($where))
            {
                $error['name'] = '名称已存在';
            }
        }
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
            exit;
        }
        $row = array(
            'name' => trim($post['name']),
            'info' => trim($post['info'])
        );
        if($post['id'])
        {
            if(!$this->product_brand->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->product_brand->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/product_brands';
        }
        echo json_encode($data);
    }

    public function delete($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->product_brand->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }
}
/* End of file product_brands.php */
/* Location: ./lms_app/controllers/admin/product_brands.php */
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
        $this->load->model('product_type');
		$this->list_type = '';
    }
	public function index()
	{
        $this->auth->check_login();
        $this->list_type = 'return';
        $category = $this->product_category->all(array('orderby' =>'parent_id asc,id asc'));
        $data['category_list'] = $category;
        $data['param'] = $this->product->get_param();//stripslashes
        $data['list'] = $this->lists();
        $this->load->view('admin/product/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->product->all(array('status !='=>2));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product/datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->product->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $data['cates'] = $this->product_category->all();
        $data['types'] = $this->product_type->all();
        $this->load->view('admin/product/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pcode', ' ', 'max_length[20]'); 
        $this->form_validation->set_rules('name', ' ', 'required|max_length[50]'); 
        $this->form_validation->set_rules('price', ' ', 'numeric|max_length[8]'); 
        $this->form_validation->set_rules('best_price', ' ', 'numeric|max_length[8]'); 
        $this->form_validation->set_rules('amount', ' ', 'integer|max_length[8]'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['pcode'] = form_error('pcode');
            $error['name'] = form_error('name');
            $error['price'] = form_error('price');
            $error['best_price'] = form_error('best_price');
            $error['amount'] = form_error('amount');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
            if($post['pcode'])
            {
                $where = array('code'=>$post['pcode'],'id !='=>$post['id']);
                if($this->product->exist($where))
                {
                    $error['pcode'] = '编码已存在';
                }                
            }
            $where = array('name'=>$post['name'],'id !='=>$post['id']);
            if($this->product->exist($where))
            {
                $error['name'] = '名称已存在';
            }
        }
        else
        {
            if($post['pcode'])
            {
                $where = array('code'=>$post['pcode']);
                if($this->product->exist($where))
                {
                    $error['pcode'] = '编码已存在';
                }
            }
            $where = array('name'=>$post['name']);
            if($this->product->exist($where))
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
            'code' => $post['pcode'],
            'name' => $post['name'],
            'price' => $post['price'] ? $post['price'] : 0,
            'best_price' => $post['best_price'] ? $post['best_price'] : 0,
            'amount' => $post['amount'] ? $post['amount'] : 0,
            'cate_id' => $post['cate_id'],
            'type_id' => $post['type_id']
        );
        if($post['id'])
        {
            if(!$this->product->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->product->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/products';
        }
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->product->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

    public function recycle()
    {
        $this->auth->check_login();
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
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product/recycle-datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------
}
/* End of file products.php */
/* Location: ./lms_app/controllers/admin/products.php */
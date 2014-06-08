<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_cate extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_category');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/product_cate/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['tree'] = $this->product_category->tree();
        //$data['list'] = $this->product_category->all(array('orderby' =>'parent_id asc,id asc'));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product_cate/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/product_cate/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $data = array();
        if($id)
        {
            $row = $this->product_category->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/product_cate/edit',$data);
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
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['name'] = form_error('name');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
            $where = array('name'=>$post['name'],'id !='=>$post['id']);
            if($this->product_category->exist($where))
            {
                $error['name'] = '名称已存在';
            }
        }
        else
        {
            $where = array('name'=>$post['name']);
            if($this->product_category->exist($where))
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
            'name' => $post['name'],
            'parent_id' => $post['parent_id']
        );
        if($post['id'])
        {
            if(!$this->product_category->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->product_category->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/product_cate';
        }
        echo json_encode($data);
    }

    public function delete($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1004','msg'=>'参数错误'));
            exit;
        }
        $this->load->model('product_category_map');
        $data = array(
            'code' => '1000',
            'msg' => $this->lang->line('delete_success')
        );
        $ids = array();
        if($id)
        {
            //循环删除该节点下的所有节点
            $children_node = $this->product_category->get_all_children($id);
            $children_node[] = $id;
            $cate = $this->product_category->get($id);
            foreach ($children_node as $key => $value)
            {
                if(!$this->product_category->delete($value))
                {
                    $data['code'] = '1001';
                    $data['msg'] = Lang::get('text.delete_failed');
                }
                else
                {
                    $this->product_category_map->update_by_condition(array('category_id'=>$cate->parent_id), array('category_id'=>$value));
                }
                $ids[] = 'add_new_childNode_'.$value;
            }
        }
        else
        {
            $data['code'] = '1004';
            $data['msg'] = '参数错误';
        }
        if($data['code'] == '1000')
        {
            $data['ids'] = $ids;
        }
        /*
        if($this->product_category->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','removeId'=>'add_new_childNode_'.$id);
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }*/
        echo json_encode($data);
    }
}
/* End of file products.php */
/* Location: ./lms_app/controllers/admin/products.php */
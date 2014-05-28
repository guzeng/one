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
        $this->load->model('product_brand');
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
        $data['brands'] = $this->product_brand->all();
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
        $this->form_validation->set_rules('unit', ' ', 'max_length[30]');  
        $this->form_validation->set_rules('weight', ' ', 'numeric|max_length[8]');  
        $this->form_validation->set_rules('min_num', ' ', 'integer|max_length[11]');  
        $this->form_validation->set_rules('score', ' ', 'integer|max_length[11]');  
        $this->form_validation->set_rules('status', ' ', 'integer');
        $this->form_validation->set_rules('recommend', ' ', 'integer');  
        $this->form_validation->set_rules('specials', ' ', 'integer');  
        $this->form_validation->set_rules('hot', ' ', 'integer');  
        $this->form_validation->set_rules('allow_comment', ' ', 'integer');    
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['pcode'] = form_error('pcode');
            $error['name'] = form_error('name');
            $error['price'] = form_error('price');
            $error['best_price'] = form_error('best_price');
            $error['amount'] = form_error('amount');
            $error['unit'] = form_error('unit');
            $error['weight'] = form_error('weight');
            $error['min_num'] = form_error('min_num');
            $error['score'] = form_error('score');
            $error['status'] = form_error('status');
            $error['recommend'] = form_error('recommend');
            $error['specials'] = form_error('specials');
            $error['hot'] = form_error('hot');
            $error['allow_comment'] = form_error('allow_comment');
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
            'type_id' => $post['type_id'],
            'brand_id' => $post['brand_id'],
            'unit' => $post['unit'],
            'weight' => isset($post['weight'])?floor($post['weight']):0,
            'min_num' => isset($post['min_num'])?intval($post['min_num']):0,
            'score' => isset($post['score'])?intval($post['score']):0,
            'info' => $post['info'],
            'status' => isset($post['status'])?round($post['status'],2):0,
            'recommend' => isset($post['recommend'])?intval($post['recommend']):0,
            'specials' => isset($post['specials'])?$post['specials']:0,
            'hot' => isset($post['hot'])?intval($post['hot']):0,
            'allow_comment' => isset($post['allow_comment'])?intval($post['allow_comment']):0
        );
        if($post['id'])
        {
            if(!$this->product->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
            $id = $post['id'];
        }
        else
        {
            if(!$id = $this->product->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }

        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/products';
            //处理图片
            if($post['pro_pic_path'] && is_file(upload_folder('temp').DIRECTORY_SEPARATOR.$post['pro_pic_path']))
            {
                $this->load->library('image_lib');
                $target = upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id);
                create_folder($target);
                $config['image_library'] = 'gd2';
                $config['source_image'] = upload_folder('temp').DIRECTORY_SEPARATOR.$post['pro_pic_path'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = $target.DIRECTORY_SEPARATOR.file_save_name($id).'.png';
                $config['width'] = 800;
                $config['height'] = 480;
                $this->image_lib->initialize($config); 
                $this->image_lib->resize();
                $config['new_image'] = $target.DIRECTORY_SEPARATOR.file_save_name($id).'_thumb.png';
                $config['width'] = 250;
                $config['height'] = 150;
                $this->image_lib->initialize($config); 
                $this->image_lib->resize();
                @unlink($config['source_image']);
            }
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
            @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'.png');
            @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'_thumb.png');
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
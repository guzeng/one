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
        $this->load->model('product_category_map');
        $this->load->model('product_type');
        $this->load->model('product_brand');
		$this->list_type = '';
    }
	public function index()
	{
        $this->auth->check_login();
        $this->list_type = 'return';
        $category = $this->product_category->tree();
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
        $cate = array();
        if($id)
        {
            $row = $this->product->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
            $cates = $this->product_category_map->all(array('where'=>array('product_id'=>$id)));
            if(!empty($cates))
            {
                foreach ($cates as $key => $value) {
                    $cate[] = $value->category_id;
                }
            }
        }
        $data['cate'] = $cate;
        $data['cate_list'] = $this->product_category->all(array('where'=>array('parent_id'=>0)));
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
        $this->form_validation->set_rules('sale_num', ' ', 'integer|max_length[8]'); 
        $this->form_validation->set_rules('unit', ' ', 'max_length[30]');  
        $this->form_validation->set_rules('weight', ' ', 'numeric|max_length[8]');  
        $this->form_validation->set_rules('min_num', ' ', 'integer|max_length[11]');  
        $this->form_validation->set_rules('score', ' ', 'integer|max_length[11]');  
        $this->form_validation->set_rules('status', ' ', 'integer');
        $this->form_validation->set_rules('recommend', ' ', 'integer');  
        $this->form_validation->set_rules('specials', ' ', 'integer');  
        $this->form_validation->set_rules('hot', ' ', 'integer');  
        $this->form_validation->set_rules('allow_comment', ' ', 'integer');
        $this->form_validation->set_rules('show_home', ' ', 'integer');
        $this->form_validation->set_rules('handpick', ' ', 'integer');

        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['pcode'] = form_error('pcode');
            $error['name'] = form_error('name');
            $error['price'] = form_error('price');
            $error['best_price'] = form_error('best_price');
            $error['amount'] = form_error('amount');
            $error['sale_num'] = form_error('sale_num');
            $error['unit'] = form_error('unit');
            $error['weight'] = form_error('weight');
            $error['min_num'] = form_error('min_num');
            $error['score'] = form_error('score');
            $error['status'] = form_error('status');
            $error['recommend'] = form_error('recommend');
            $error['specials'] = form_error('specials');
            $error['hot'] = form_error('hot');
            $error['allow_comment'] = form_error('allow_comment');
            $error['show_home'] = form_error('show_home');
            $error['handpick'] = form_error('handpick');
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
            'sale_num' => $post['sale_num'] ? $post['sale_num'] : 0,
            'type_id' => $post['type_id'],
            'cate_id' => $post['cate'],
            'brand_id' => $post['brand_id'],
            'unit' => $post['unit'],
            'weight' => isset($post['weight'])?floor($post['weight']):0,
            'min_num' => isset($post['min_num'])?intval($post['min_num']):0,
            'score' => isset($post['score'])?intval($post['score']):0,
            'info' => $post['info'],
            'promise' => $post['promise'],
            'status' => isset($post['status'])?round($post['status'],2):0,
            'recommend' => isset($post['recommend'])?intval($post['recommend']):0,
            'specials' => isset($post['specials'])?$post['specials']:0,
            'hot' => isset($post['hot'])?intval($post['hot']):0,
            'allow_comment' => isset($post['allow_comment'])?intval($post['allow_comment']):0,
            'show_home' => isset($post['show_home'])?intval($post['show_home']):0,
            'handpick' => isset($post['handpick'])?intval($post['handpick']):0
        );
        if($post['id'])
        {
            if(!$this->product->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
            $id = $post['id'];
            $this->product_category_map->delete_by_product($id);
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
            if(isset($post['cate_id']) && $post['cate_id'] && is_array($post['cate_id']) && !empty($post['cate_id']))
            {
                foreach ($post['cate_id'] as $key => $value) {
                    $this->product_category_map->insert(array('product_id'=>$id,'category_id'=>$value));
                }
            }
            $data['goto'] = 'admin/products';
            //处理图片
            $this->load->library('image_lib');
            $target = upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id);
            create_folder($target);
            $tmp_folder = upload_folder('temp');
            $target_name = file_save_name($id);
            $unlink = array();
            for($i=1;$i<=5;$i++)
            {
                if($post['pro_pic_path_'.$i] && is_file($tmp_folder.DIRECTORY_SEPARATOR.$post['pro_pic_path_'.$i]))
                {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $tmp_folder.DIRECTORY_SEPARATOR.$post['pro_pic_path_'.$i];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = TRUE;
                    $config['new_image'] = $target.DIRECTORY_SEPARATOR.$target_name.'_'.$i.'.png';
                    $config['width'] = 800;
                    $config['height'] = 600;
                    $this->image_lib->initialize($config); 
                    $this->image_lib->resize();
                    $config['new_image'] = $target.DIRECTORY_SEPARATOR.$target_name.'_'.$i.'_thumb.png';
                    $config['width'] = 200;
                    $config['height'] = 150;
                    $this->image_lib->initialize($config); 
                    $this->image_lib->resize();
                    $unlink[] = $config['source_image'];
                }
            }
            if(!empty($unlink))
            {
                foreach ($unlink as $key => $value) {
                    @unlink($value);
                }
            }
        }
        echo json_encode($data);
    }

    public function update_product_category($category_id){
        $this->auth->check_login_json();

        $data = array('code' => '1000','msg'=>'批量分配分类成功' );
        $ids = $this->input->post('ids');
        if(is_array($ids) && empty($ids) && !category)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        foreach ($ids as $key => $product_id) {
            $product = $this->product->get($product_id);
            if($product && !empty($product))
            {
                $row = $this->product_category_map->get_by_product($product_id);
                $isExist = true; //商品是否已经分配过该分类
                foreach ($row as $key => $item) {
                    if($item->category_id == $category_id)
                    {
                        $isExist = false;
                    }
                }
                if($isExist)
                {
                    $insert_id = $this->product_category_map->insert(array('product_id'=>$product_id,'category_id'=>$category_id));
                    if(!$insert_id)
                    {
                        $data['code'] = '1001';
                        $data['msg'] = '批量分配商品分类出错';
                    }
                }
            }
            else
            {
                $data['code'] = '1001';
                $data['msg'] = '商品不存在';
            }
        }
        echo json_encode($data);
    }

    public function bath_update_status(){
        $this->auth->check_login_json();

        $data = array('code' => '1000','msg'=>'批量处理成功' );
        $ids = $this->input->post('ids');
        $status = $this->input->post('status');
        $row = array("status"=>$status);
        if(is_array($ids) && empty($ids))
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if(!$this->product->bath_update_status($row,$ids))
        {
            $data['msg'] = '批量处理失败';
            $data['code'] = 1001;
        }
        echo json_encode($data);
    }

    public function change_status($id)
    {
        $this->auth->check_login_json();
        $status = $this->input->post('status');
        $row = array("status"=>$status);
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->product->update($row,$id))
        {
            $data = array('code'=>'1000','msg'=>'修改成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'修改失败');
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
        if($this->product->update(array('status'=>2),$id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
            // @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'.png');
            // @unlink(upload_folder('product').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'_thumb.png');
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

    public function reagin($id)
    {
        $this->auth->check_login_json();
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
}
/* End of file products.php */
/* Location: ./lms_app/controllers/admin/products.php */
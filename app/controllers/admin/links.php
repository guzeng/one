<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('link');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/link/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->link->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/link/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/link/datalist',$data,true)
            ));            
        }
    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $data = array();
        if($id)
        {
            $row = $this->link->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/link/edit',$data);
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
        $this->form_validation->set_rules('title', ' ', 'required|max_length[50]'); 
        $this->form_validation->set_rules('url', ' ', 'required|max_length[200]'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $error['title'] = form_error('title');
            $error['url'] = form_error('url');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $row = array(
            'title' => trim($post['title']),
            'url' => trim($post['url'])
        );
        if($post['id'])
        {
            if(!$this->link->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
            $id = $post['id'];
        }
        else
        {
            if(!$id = $this->link->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code']=='1000')
        {
            $data['goto'] = 'admin/links';
            //处理图片
            if($post['link_pic_path'] && is_file(upload_folder('temp').DIRECTORY_SEPARATOR.$post['link_pic_path']))
            {
                $target = upload_folder('link').DIRECTORY_SEPARATOR.file_save_dir($id);

                create_folder($target);
                $config['image_library'] = 'gd2';
                $config['source_image'] = upload_folder('temp').DIRECTORY_SEPARATOR.$post['link_pic_path'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = $target.DIRECTORY_SEPARATOR.file_save_name($id).'.png';
                $config['width'] = 120;
                $config['height'] = 80;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                @unlink($config['source_image']);
            }
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
        if($this->link->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
            @unlink(upload_folder('link').DIRECTORY_SEPARATOR.file_save_dir($id).DIRECTORY_SEPARATOR.file_save_name($id).'.png');
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }
}
/* End of file links.php */
/* Location: ./app/controllers/admin/links.php */
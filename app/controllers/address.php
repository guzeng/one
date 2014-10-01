<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_address');
        $this->load->model('area');
    }

    /**
     * 展示用户收货地址信息
     * 
     */
	public function index($user_id)
	{
		if(!$user_id)
        {
            show_404('',false);
        }
        
        $address = $this->user_address->lists(array('where'=>'user_id = '.$user_id.' and status = 1','orderby'=>'default desc,id desc'));
        $address2 = array();
        if($address)
        {
            foreach ($address as $key => $item) {
            if($item->area)
            {
                $qu = $this->area->get($item->area);
                $city = $this->area->get($qu->parent_id);
                if($city)
                {
                    $province = $this->area->get($city->parent_id);
                }
                else
                {
                    $province = $this->area->get($qu->parent_id);
                }
                

                $item->qu = isset($qu->area_name)?$qu->area_name:'';
                $item->city = isset($city->area_name)?$city->area_name:'';
                $item->province = isset($province->area_name)?$province->area_name:'';
                $address2[$key] = $item;
            }
        }
        }
        $data['address'] = $address2;
        $this->load->view('home/address/lists',$data);
	}

    /**
     * 编辑用户收货地址信息
     * 
     */
    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->user_address->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            else if($row->area)
            {
                $qu = $this->area->get($row->area);

                $qu_list = $this->area->lists(array('where' => 'parent_id = '.$qu->parent_id));
                
                $city = $this->area->lists(array('where' => 'area_level = 2 and area_id = '.$qu->parent_id));

                $city_list = array();
                if($city && !empty($city)){
                    $city = $city[0];
                    $city_list = $this->area->lists(array('where' => 'area_level = 2 and parent_id = '.$city->parent_id));
                    $province =  $this->area->get($city->parent_id);
                }
                else{
                    $province =  $this->area->get($qu->parent_id);
                }
                
                $province_list = $this->area->lists(array('where' => 'area_level = 1'));

                $area = array('qu'=>$qu,'qu_list'=>$qu_list,
                    'city'=>$city,'city_list'=>$city_list,
                    "province"=>$province,"province_list"=>$province_list);
            }

            $data['row'] = $row;
            $data['area'] = $area;
            $this->load->view('home/address/edit',$data);
        }
        else{
            $area['province_list'] = $this->area->lists(array('where' => 'area_level = 1') );
            $data['area'] = $area;
            $this->load->view('home/address/edit',$data);
        }
    }
    //-------------------------------------------------------------------------

    /**
     * 更新用户收货地址信息
     * 
     */
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

        $this->form_validation->set_rules('phone', ' ', 'required');
        $this->form_validation->set_rules('consignee', ' ', 'required');
        $this->form_validation->set_rules('telephone', ' ', 'required');
        $this->form_validation->set_rules('address', ' ', 'required');

        if($post['area'] == -1)
        {
            $error['area'] = '请选择地区';
        }
        if(!isset($post['default']))
        {
            $post['default'] = 0;
        }
        else if($post['default'] == 'ON')
        {
            $post['default'] = 1;
        }
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['phone'] = form_error('phone');
            
            $error['consignee'] = form_error('consignee');
            $error['telephone'] = form_error('telephone');
            $error['address'] = form_error('address');
            $data['msg'] = "出错";
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }
        $error = array();
        
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>"出错",'error'=>$error));
            exit;
        }

        $row = array(
            'phone' => $post['phone'],
            'telephone' => $post['telephone'],
            'address' => $post['address'],
            'consignee' => $post['consignee'],
            'area' => $post['area'] != ''? $post['area'] : 0,
            'gender' => $post['gender'],
            'default' => $post['default'] ? 1 : 0,
            'user_Id' => $this->auth->user_id()
        );

        if($post['id'])
        {
            if(!$this->user_address->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_failed'));
            }
            else{
                if($post['default'])
                {
                    $this->user_address->update_by_default($post['id']);//取消原来的默认地址
                }
            }
        }
        else
        {
            $count = $this->user_address->count();
            if(intval($count)>=21){
                $data = array('code'=>'1001','msg'=>"添加的收货地址不能超过20个");
                echo json_encode($data);
                exit;
            }
            
            $insert_id = $this->user_address->insert($row);
            if(!$insert_id)
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_failed'));
            }
            else{
                if($post['default'])
                {
                    $this->user_address->update_by_default($insert_id);//取消原来的默认地址
                }
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'address/index/'.$this->auth->user_id();
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
        if($this->user_address->update(array('status'=>0),$id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>'address_'.$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }
}

/* End of file address.php */
/* Location: ./application/controllers/address.php */
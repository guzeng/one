<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carts extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    	$this->load->library('session');
        $this->load->model('cart');
        $this->load->model('product');
    }
	public function index()
	{

        $user_id = $this->auth->user_id();
        if($user_id)
        {
            $list = $this->cart->all(array('type'=>'a.product_id,a.count,p.name,p.price,p.best_price', 'where'=>array('user_id'=>$user_id)))->toArray();
        }
        else
        {
            $list = $this->session->userdata('cart');
        }
        $data['list'] = $list;
		$this->load->view('home/cart', $data);
	}

	public function add()
	{
        $post = $this->input->post();
        $product_id = $post['product_id'];
        $count = $post['count'];
        $product = $this->product->get($product_id);
        if(!$product)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
		if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            $this->cart->insert(array('user_id'=>$user_id,'product_id'=>$product_id,'count'=>$count));
        }
        else
        {
            $p = array(
                'product_id'=>$product_id,
                'name' => $product->name,
                'count'=>$count,
                'price'=>$product->price,
                'best_price'=>$product->best_price
            );
            $cart = $this->session->userdata('cart');
            if(!$cart)
            {
                $cart = array();
            }
            $cart[] = $p;
            $this->session->set_userdata('cart', $cart);
        }
        echo json_encode(array('code'=>'1000','msg'=>$this->lang->line('success'),'data'=>$p));
	}

    public function del($product_id)
    {
        if(!$product_id)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('param_error')));
            exit;
        }
        if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            if($this->cart->del($user_id, $product_id))
            {
                echo json_encode(array('code'=>'1000'));
            }
            else
            {
                echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('failed')));
                exit;
            }
        }
        else
        {
            $cart = $this->session->userdata('cart');
            if(!empty($cart))
            {
                foreach ($cart as $key => $value) {
                    if($value['product_id'] == $product_id)
                    {
                        unset($cart[$key]);
                        break;
                    }
                }
                $this->session->set_userdata('cart',$cart);
            }
            echo json_encode(array('code'=>'1000'));
        }
    }
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */
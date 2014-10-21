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
        $this->load->model('product_category');
    }
	public function index()
	{
        $list = $this->cart->lists();
        if(!empty($list))
        {
            foreach ($list as $key => $value) {
                if(isset($value['cate_id']) && $value['cate_id'])
                {
                   $list[$key]['category'] = $this->product_category->get_parent($value['cate_id']); 
                }
            }
        }
        $data['list'] = $list;
		$this->load->view('home/cart', $data);
	}

	public function add()
	{
        $post = $this->input->post();
        $product_id = intval($post['product_id']);
        $count = intval($post['count']);
        $product = $this->product->get($product_id);
        if(!$product)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
		if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            $exist = $this->cart->get_by_user($user_id,$product_id);
            if($exist)
            {
                $this->cart->update(array('count'=>$exist->count+$count),$exist->id);
            }
            else
            {
                $this->cart->insert(array('user_id'=>$user_id,'product_id'=>$product_id,'count'=>$count));
            }
            $total = $this->cart->count();
        }
        else
        {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            if(!is_array($cart))
            {
                $cart = array();
            }
            $exist = false;
            foreach($cart as $key => $value)
            {
                if($value['product_id'] == $product_id)
                {
                    $cart[$key]['count'] = $value['count']+$count;
                    $exist = true;
                    break;
                }
            }
            if(!$exist)
            {
                $p = array(
                    'product_id'=>$product_id,
                    'name' => $product->name,
                    'count'=>$count,
                    'price'=>$product->price,
                    'best_price'=>$product->best_price,
                    'min_num' => $product->min_num,
                    'cate_id' => $product->cate_id
                );
                $cart[] = $p;
            }
            $_SESSION['cart'] = $cart;
            $total = count($cart);
        }
        echo json_encode(array('code'=>'1000','msg'=>$this->lang->line('success'),'total'=>$total));
	}

    public function del()
    {
        $post = $this->input->post();
        $product_id = intval($post['product_id']);
        if(!$product_id)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('param_error')));
            exit;
        }
        if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            if(!$this->cart->del($user_id, $product_id))
            {
                echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('failed')));
                exit;
            }
        }
        else
        {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            if(!empty($cart))
            {
                foreach ($cart as $key => $value) {
                    if($value['product_id'] == $product_id)
                    {
                        unset($cart[$key]);
                        break;
                    }
                }
                $_SESSION['cart'] = $cart;
            }
        }
        echo json_encode(array('code'=>'1000','total'=>$this->cart->count(),'price'=>$this->cart->price()));
        exit;
    }

    public function update()
    {
        $post = $this->input->post();
        $product_id = intval($post['product_id']);
        $count = intval($post['count']);
        if(!$product_id)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('param_error')));
            exit;
        }
        $product = $this->product->get($product_id);
        if(!$product)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
        if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            $cart = $this->cart->get_by_user($user_id,$product_id);
            if(!$cart)
            {
                echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('no_data_exist')));
                exit;
            }
            if(!$this->cart->update(array('count'=>$count), $cart->id))
            {
                echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('failed')));
                exit;
            }
        }
        else
        {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            if(!empty($cart))
            {
                foreach ($cart as $key => $value) {
                    if($value['product_id'] == $product_id)
                    {
                        $cart[$key]['count'] = $count;
                        break;
                    }
                }
                $_SESSION['cart'] = $cart;
            }
        }
        echo json_encode(array('code'=>'1000','price'=>$this->cart->price()));
    }
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */
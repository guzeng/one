<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart  extends CI_Model{
	private $table='cart';
	private $product_table = 'product';
	
	public function insert($row){
		if(is_array($row) && !empty($row)){
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
	//-------------------------------------------------------
	
	public function update($row,$id){
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}
	//--------------------------------------------------------

	public function delete($id){
		if($id){
			$this->db->where('id',$id);
			return $this->db->delete($this->table);
		}
		return false;
	}

	public function del($user_id, $product_id){
		if($user_id && $product_id){
			$this->db->where('user_id',$user_id);
			$this->db->where('product_id',$product_id);
			return $this->db->delete($this->table);
		}
		return false;
	}
	//---------------------------------------------------------

	public function get($id){
		if($id){
			$this->db->where('id',$id);
			$query = $this->db->get($this->table);
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//---------------------------------------------------------
	public function get_by_user($user_id,$product_id=''){
		if($user_id){
			$this->db->where('user_id',$user_id);
			if($product_id)
			{
				$this->db->where('product_id',$product_id);
			}
			$query = $this->db->get($this->table);
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//---------------------------------------------------------
    /**
    *   exist
    *   检查是否存在
    *   @param int id
    * 
    */
    public function exist($where)
    {
        if($where){
            $this->db->from($this->table. ' as a');
            $this->db->where($where);
            $type = 'count(a.id) as count';
            $this->db->select($type);
            $query = $this->db->get();
            if($query->row()->count > 0)
            {
                return true;
            }
        }
        return false;
    }
    //----------------------------------------------------------------

    public function count()
    {
    	if($this->auth->is_login())
        {
        	$user_id = $this->auth->user_id();
        	$this->db->where('user_id', $user_id);
			$this->db->select ('count(id) as count');
	        $this->db->limit(1);
			$query = $this->db->get ( $this->table);
	        if($query->num_rows() > 0){
	            $res = $query->result();
	            return $res[0]->count;
	        }
	    }
	    else
	    {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            if(!is_array($cart))
            {
                $cart = array();
            }
            return count($cart);
	    }
		return 0;
    }
	/**
	 * lists
	 * 查询所有分类, 用于分页显示列表
	 * 
	 *	@param item array 
	 *	@return array
	 */    
	public function lists()
	{
		
        if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            $list = $this->all(array('type'=>'a.product_id,a.count,p.name,p.price,p.best_price,p.min_num,p.cate_id','join_product'=>true, 'where'=>array('user_id'=>$user_id)));
        }
        else
        {
            $list = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        }
        return $list;
	}
	//---------------------------------------------------------
	/**
	 * all
	 * 查询所有分类
	 * 
	 *	@param item array 
	 *	@return array   
	 *  @author zeng.gu
	 */    
	public function all($items=array())
	{
		if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'a.id asc';
        if(!isset($_type)){
            $_type = '*';
        }
		$this->db->select ( $_type );
		$this->db->from($this->table.' as a');
        if(isset($_where)){
            $this->db->where($_where);
        }
        if(isset($_join_product))
        {
        	$this->db->join($this->product_table.' as p','p.id=a.product_id','left');
        }
        $this->db->order_by($_orderby);
		$query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
		return false;
	}
	//---------------------------------------------------------

	public function price()
	{
		$lists = $this->lists();
		$total_price = $total_best_price = 0;
		if(!empty($lists))
		{
			foreach ($lists as $key => $value) {
				$total_price += $value['price']*$value['count'];
				$total_best_price += $value['best_price']*$value['count'];
			}				
		}
		return array('total_price' => $total_price,'total_best_price'=>$total_best_price);
	}
}
/* End of file cart.php */
/* Location: ./application/models/cart.php */	
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_map  extends CI_Model{
	private $table='product_category_map';
	private $table_product='product';
	private $table_category='product_category';
	
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
	public function update_by_condition($row,$condition){
		if(!empty($row) && $condition){
			$this->db->where($condition);
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
	//---------------------------------------------------------

	public function delete_by_product($pid){
		if($pid){
			$this->db->where('product_id',$pid);
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

	/**
	 * get_by_product
	 * 获取商品所有分类
	 * 
	 *	@param product_id
	 *	@return array   
	 */   
	public function get_by_product($product_id){
		if($product_id){
			$this->db->where('product_id',$product_id);
            $this->db->select('category_id');
			$query = $this->db->get($this->table);
			if($query->num_rows()>0){
				return $query->result();
			}
		}
		return false;
	}
	//---------------------------------------------------------

	/**
	 * get_product_by_cate
	 * 获取分类下的首页热门商品
	 * 
	 *	@param cate_id
	 *	@return array   
	 */   
	public function get_product_by_cate($cate_id_ary){
        $this->db->select('a.category_id,a.product_id,p.name,p.price,p.best_price,p.status,p.brand_id,p.recommend,p.specials,p.hot');
        $this->db->from( $this->table.' as a');
        $this->db->join($this->table_product.' as p','p.id=a.product_id','left');
        $this->db->where_in('a.category_id',$cate_id_ary);
        $this->db->where('p.show_home',1);
        $this->db->where('p.status',1);
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return false;
		}
		
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
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id desc';
        if(!isset($_type)){
            $_type = 'a.*';
        }
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
        $this->db->from($this->table . ' as a');
        if(isset($_join_category))
        {
        	$this->db->join($this->table_category.' as c','a.category_id=c.id','left');
            $_type = 'a.*,c.name';
        }
		$this->db->select ( $_type );
		$query = $this->db->get ();
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;
	}
	//---------------------------------------------------------

}
/* End of file product_categorys.php */
/* Location: ./application/models/product_categorys.php */	
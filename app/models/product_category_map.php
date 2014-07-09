<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_category_map  extends CI_Model{
	private $table='product_category_map';
	
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
            $_type = '*';
        }
		$this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
		$query = $this->db->get ( $this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;
	}
	//---------------------------------------------------------

}
/* End of file product_categorys.php */
/* Location: ./application/models/product_categorys.php */	
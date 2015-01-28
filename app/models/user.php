<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User  extends CI_Model{
	private $table='member';
	
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

	public function assign_role($user_id,$role_id){
		if($user_id && $role_id){
			$this->db->where('id',$user_id);
			$row= array("role_id"=>$role_id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}
	//---------------------------------------------------------

	public function delete($id){
		if($id){
			$this->db->where('id',$id);
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

	public function get_by_username($username){
		if($username){
			$this->db->where('username',$username);
			$query = $this->db->get($this->table);
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//---------------------------------------------------------

	public function get_by_condition($login_item){
		if($login_item){
			$this->db->where('username',$login_item);
			$this->db->or_where('email =',$login_item);
			$this->db->or_where('phone =',$login_item);
			$query = $this->db->get($this->table,1,0);
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
	/**
	 * lists
	 * 查询, 用于分页显示列表
	 * 
	 *	@param item array 
	 *	@return array
	 */    
	public function lists($items=array()){
		
		if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_num = isset($_num) && intval($_num)>0 ? intval($_num) : 10;
        $_start = isset($_start) && intval($_start)>0 ? intval($_start) : 0;
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id desc';
        if(!isset($_type)){
            $_type = '*';
        }
		$this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
        $this->db->limit($_num,$_start);
		$query = $this->db->get ( $this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;	
		
	}
	//---------------------------------------------------------
	/**
	 * all
	 * 查询所有
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
    /**
     * count
     * 查询所有数量
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/3/31
     */    
    public function count()
    {
        $this->db->select ('count(a.id) as count');
        return $this->db->count_all($this->table);
    }
    //----------------------------------------------------------------

    public function pic($id,$size='normal')
	{
		if(!$id){
			return base_url().'assets/img/avatar.jpg';
		}
		
		$this->config->load('upload');
		$folder = $this->config->item('user_folder');
		$file_save_dir = file_save_dir($id);
		$file_save_name = file_save_name($id);
		if(is_file($folder.DIRECTORY_SEPARATOR.$file_save_dir.DIRECTORY_SEPARATOR.$file_save_name.'.png'))
		{
			return base_url().$folder.'/'.$file_save_dir.'/'.$file_save_name.'.png';
		}
		return base_url().'assets/img/avatar.jpg';
	}

}
/* End of file product_brand.php */
/* Location: ./application/models/product_brand.php */	
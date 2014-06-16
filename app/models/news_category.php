 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_category  extends CI_Model{
	private $table='news_category';
	
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
	 * all
	 * 查询所有分类
	 * 
	 *	@param item array 
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

	public function tree()
	{
		$this->db->order_by('parent_id asc, id asc');
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
		{
			$rows = $query->result();
			$items = $this->tree_items($rows);
			return $this->build_tree($items);
		}
		return false;
	}
	//---------------------------------------------------------

    public function tree_items($arr,$pid=0) 
    {
        $ret = array();
        if(is_array($arr) && !empty($arr))
        {
	        foreach($arr as $k => $v) {
	            if($v->parent_id == $pid) {
	                $tmp = $arr[$k];
	                unset($arr[$k]);
	                $tmp->children = $this->tree_items($arr,$v->id);
	                $ret[] = $tmp;
	            }
	        }        	
        }
        return $ret;
    }
	//---------------------------------------------------------

    /**
     * 返回带有深度参数的一维数组
     * param deep int 深度
     */
	public function build_tree($arr, $deep=0)
	{
		$a = array();
		if (is_array($arr) && !empty($arr)){
		   	foreach ($arr as $key=>$val){
		   		$b = array('id'=>$val->id,'name'=>$val->name,'parent_id'=>$val->parent_id,'deep'=>$deep);
		   		if(!empty($val->children))
		   		{
		   			$b['hasChild'] = true;
		   		}
		   		else
		   		{
		   			$b['hasChild'] = false;
		   		}
		   		$a[] = $b;
				$a = array_merge($a, $this->build_tree($val->children, $deep+1));
		    }
		}
		return $a;
	}
	//---------------------------------------------------------

    public function get_all_children($pid=0)
    {
		$this->db->order_by('parent_id asc');
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
		{
			$rows = $query->result();
			return $this->get_child($rows, $pid);
		}
		return false;
    }
	//---------------------------------------------------------

    public function get_child($arr, $pid=0)
    {
        $ret = array();
        foreach($arr as $k => $v) {
            if($v->parent_id == $pid) {
                $ret[] = $v->id;
                unset($arr[$k]);
                $ret = array_merge($ret, $this->get_child($arr,$v->id));
            }
        }
        return $ret;
    }
}
/* End of file news_categorys.php */
/* Location: ./application/models/product_categorys.php */	
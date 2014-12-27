<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pay  extends CI_Model{
	private $table='pay';
	
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
	 * lists
	 * 查询所有分类, 用于分页显示列表
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

    public function payType($t='',$type=false)
    {
        $arr = array(
            '1' => array(
                    'id' => 'daofu',
                    'name' => '货到付款'
                ),
            '2' => array(
                    'id' => 'alipay',
                    'name' => '支付宝'
                ),
            '3' => array(
                    'id' => 'bank',
                    'name' => '网上银行'
                ),
            '4' => array(
                    'id' => 'weixin',
                    'name' => '微支付'
                )
        );
        if($t)
        {
            if(array_key_exists($t, $arr))
            {
                if($type)
                {
                    switch (strtolower($type)) {
                        case 'name':
                            return $arr[$t]['name'];
                            break;
                        default:
                            return $arr[$t]['id'];
                            break;
                    }
                }
            }
            else
            {
                return false;
            }
        }
        return $arr;
    }

    public function getType($type)
    {
        $types = $this->payType();
        $k = '';
        if($type)
        {
            foreach($types as $key => $value)
            {
                if($type == $value['id'])
                {
                    $k = $key;
                    break;
                }
            }
            return $k;
        }
        return false;
    }
}
/* End of file pay.php */
/* Location: ./application/models/pay.php */	
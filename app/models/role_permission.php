<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role_permission  extends CI_Model{
    private $table_permission='permission';
    private $table = 'role_permission_map';
    
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

    public function delete_by_role_permission($roleId, $permissionId)
    {
        if($roleId && $permissionId)
        {
            $this->db->where(array('role_id'=>$roleId,'permission_id'=>$permissionId));
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
 * fetch_items
 * 查询所有分类
 * 
 *  @param item array 
 *  @return array   
 *  @author varson
 *  2013/08/28
 */    
    public function fetch_items($items=array()){
        
        if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_num = isset($_num) && intval($_num)>0 ? intval($_num) : 0;
        $_start = isset($_start) && intval($_start)>0 ? intval($_start) : 0;
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id desc';
        $this->db->from($this->table.' as a');
        if(!isset($_type)){
            $_type = 'a.*';
        }
        $this->db->select ( $_type );
        
        if(isset($_where)){
            $this->db->where($_where);
        }
        if(isset($_where_in))
        {
            $keys = array_keys($_where_in);
            $values = array_values($_where_in);
            $this->db->where_in($keys[0],$values[0]);
        }
        if(isset($_join_permission))
        {
            $this->db->join($this->table_permission.' as p','a.permission_id=p.id','left');
        }
        if(isset($_group_by))
        {
            $this->db->group_by($_group_by);
        }
        $this->db->order_by($_orderby);
        if($_num > 0)
        {
            $this->db->limit($_num,$_start);
        }
        $query = $this->db->get ();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
        
    }
    
    public function map($roleId, $permissionId)
    {
        if($roleId && $permissionId)
        {
            $this->db->where(array('role_id'=>$roleId,'permission_id'=>$permissionId));
            $query = $this->db->get($this->table);
            if($query->num_rows()>0){
                return $query->row();
            }
        }
        return false;
    }
//---------------------------------------------------------
}
/* End of file permission.php */
/* Location: ./application/models/permission.php */ 
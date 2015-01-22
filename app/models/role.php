<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Role  extends CI_Model{
    private $table='role';
    private $role_permission_table = 'role_permission_map';
    
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
            if($this->db->delete($this->table))
            {
                $this->db->delete($this->role_permission_table, array('role_id'=>$id));
                return true;
            }
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

    public function get_by_type($type){
        if($type){
            $this->db->where('is_default',$type);
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
 * 查询所有
 * 
 *  @param item array 
 *  @return array   
 *  @author chunhua.hong
 *  2013/1/10 11:12:56
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
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'a.id desc';
        $this->db->from( $this->table.' as a');
        if(!isset($_type)){
            $_type = 'a.*';
        }
        $this->db->select ( $_type );
        
        if(isset($_where)){
            $this->db->where($_where);
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
    //---------------------------------------------------------

    /**
     * all
     * 查询所有分类
     * 
     *  @param item array 
     *  @return array   
     *  @author alex
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
/* End of file role.php */
/* Location: ./application/models/role.php */   
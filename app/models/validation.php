<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Validation  extends CI_Model{
	private $table='validation';
	
	public function insert($row){
		if(is_array($row) && !empty($row)){
			if(!isset($row['create_time']) || intval($row['create_time'])<=0)
			{
				$row['create_time'] = local_to_gmt();
			}
			$row['expires'] = $row['create_time'] + 24*3600;
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
	//-------------------------------------------------------

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
            $type = 'a.*';
            $this->db->select($type);
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                return $query->row();
            }
        }
        return false;
    }
    //----------------------------------------------------------------

}
/* End of file Validation.php */
/* Location: ./application/models/Validation.php */	
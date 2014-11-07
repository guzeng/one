<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pay_log  extends CI_Model{
	private $table='pay_log';
	
	public function insert($row){
		if(is_array($row) && !empty($row)){
            if(!isset($row['create_time']) || intval($row['create_time'])==0)
            {
                $row['create_time'] = local_to_gmt();
            }
            if(!isset($row['user_id']) || intval($row['user_id'])==0)
            {
                $row['user_id'] = $this->auth->is_login() ? $this->auth->user_id() : 0;
            }
            if(!isset($row['status']))
            {
                $row['status'] = 1;
            }
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
}
/* End of file pay_log.php */
/* Location: ./application/models/pay_log.php */	
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Questionnaire_question extends CI_Model {
    private $table = 'questionnaire_question';
    private $table_option = 'questionnaire_option';
  
    public function insert($row)
    {
        if (is_array($row) && ! empty($row))
        {
            if ($this->db->insert($this->table, $row))
            {
                return $this->db->insert_id();
            }
        }
        return false;
    }
  
//------------------------------------------------------

    public function update($row, $id)
    {
        if ( ! empty($row) && $id)
        {
            $this->db->where('id', $id);
            return $this->db->update($this->table, $row);
        }
        return false;
    }

//------------------------------------------------------

    public function delete($id)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            if($this->db->delete($this->table))
            {
                $this->db->delete($this->table_option, array('questionnaire_question_id'=>$id));
            }
            return true;
        }
        return false;
    }
  
//------------------------------------------------------

    public function get($id)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get($this->table);
            if ($query->num_rows() > 0)
            {
                return $query->row();
            }
        }
        return false;
  }
  
//------------------------------------------------------

    public function fetch_items($items = array())
    {
        if (count($items) > 0)
        {
                foreach($items as $key => $val)
                {
                    $c = '_'.$key;
                    $$c = $val;
                }
            }
            $_orderby = isset($_orderby) && $_orderby != '' ? $_orderby : 'a.id asc';
            $this->db->from($this->table.' as a');

            if ( ! isset($_type))
            {
                $_type = 'a.*';
            }
            $this->db->select($_type);
        
            if (isset($_where))
            {
                $this->db->where($_where);
            }
            
            $this->db->order_by($_orderby);
            
            $query = $this->db->get();
        
            if($query->num_rows() > 0)
            {
                return $query->result();
            }
        return false;
    }

//---------------------------------------------------------

    public function record_increment($ids = array())
    {
        if (count($ids) > 0)
        {
            foreach ($ids as $key => $id)
            {
                if ($id)
                {
                    $this->db->select('record');
                    $this->db->where('id', $id);
                    $query = $this->db->get($this->table);

                    if ($query->num_rows() > 0)
                    {
                        $record = $query->row();
                        $this->db->where('id', $id);
                        $this->db->update($this->table, array('record' => (1 + intval($record->record))));
                    }
                }
            }
        }
        return false;
    }
    
}
/* End of file questionnaire_question.php */
/* Location: ./app/models/questionnaire_question.php */
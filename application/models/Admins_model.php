<?php
class Admins_model extends CI_Model {
	
    function get_count($table=''){
        return $this->db->count_all($table);
	}
    
	function read_user($user_id=''){

		if($user_id=='' || $user_id==NULL){
			return false;
		}

		$sql = "SELECT id, email, user_name, user_sccode FROM users WHERE id = ?"; 
		$query = $this->db->query($sql, $user_id);
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   $data = array(
            'id' => $row->id,
		   	'name' => $row->user_name,
		   	'email' => $row->email,
		   	'sccode' => $row->user_sccode
		   	);

		   return $data;
		}else{
			return false;
		}
    }

	function get_users($start, $limit){

		$users = array();

		$sql = "SELECT id FROM users ORDER BY user_sccode ASC LIMIT ".$this->db->escape($start).",".$this->db->escape($limit).""; 
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$uid = $row->id;
				array_push($users, $this->read_user($uid));
			}
		}

		return $users;
	}
    
    function truncate_booking($table)
    {
        $this->db->from($table);
        $this->db->truncate();
    }
    
    function get_bf_state()
    {
        $this->db->from('is_booking_active');
		$this->db->where('id',1);
		$this->db->where('active',1);
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
			return TRUE;
		}
        else return FALSE;
    }
    
    function toggle_bf_active()
    {
        $this->db->from('is_booking_active');
		$this->db->where('id',1);
		$this->db->where('active',1);
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
            
            $data = array(
                'active' => 0
                );
            $this->db->where('id', 1);
		    $this->db->update('is_booking_active', $data);
		
        }else
        {
            $data = array(
                'active' => 1
                );
            $this->db->where('id', 1);
		    $this->db->update('is_booking_active', $data);
        }
    }
    
}
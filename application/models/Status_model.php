<?php
class Status_model extends CI_Model {
	
    function get_count($table=''){
        return $this->db->count_all($table);
	}
    
	function get_booked_user(){
        $users = array();
		$sql = "SELECT id, user_name, user_sccode, timestamp FROM booking_si ORDER BY timestamp ASC"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
            foreach($query->result() as $row)
            {
            $row = $query->row();
            $data = array(
                'id' => $row->id,
                'user_name' => $row->user_name,
                'user_sccode' => $row->user_sccode,
                'timestamp' => $row->timestamp
                );
                array_push($users, $data);
            }
		    return $users;
		}else{
			return false;
		}
    }
    
    function get_bfbooked_user(){
        $users = array();
		$sql = "SELECT id, user_name, user_sccode, timestamp FROM booking_bf ORDER BY timestamp ASC"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
            foreach($query->result() as $row)
            {
            $row = $query->row();
            $data = array(
                'id' => $row->id,
                'user_name' => $row->user_name,
                'user_sccode' => $row->user_sccode,
                'timestamp' => $row->timestamp
                );
                array_push($users, $data);
            }
		    return $users;
		}else{
			return false;
		}
    }
    
    function get_vegbooked_user(){
        $users = array();
		$sql = "SELECT id, user_name, user_sccode FROM booking_bf ORDER BY user_sccode ASC"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
            foreach($query->result() as $row)
            {
            $row = $query->row();
            $data = array(
                'id' => $row->id,
                'user_name' => $row->user_name,
                'user_sccode' => $row->user_sccode,
                );
                array_push($users, $data);
            }
		    return $users;
		}else{
			return false;
		}
    }
    
}
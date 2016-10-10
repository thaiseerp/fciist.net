<?php
class Booking_veg_model extends CI_Model {
	
    function get_count($table=''){
        return $this->db->count_all($table);
	}
    
	function book_si_veg($email,$sccode)
    {
        $this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('user_sccode',$sccode);
		$sql = $this->db->get()->result();
        if (!(count($sql)==1)){
			return FALSE;
		}
        else
        {
            // Make sure user is not already booked
            $this->db->from('booking_veg');
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $sql = $this->db->get()->result();
            if (is_array($sql)&&count($sql)==1){
                return TRUE;
            }else{
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'user_name' => $this->session->userdata('user_name'),
                    'user_sccode' => $this->session->userdata('user_sccode')
                    );
                $this->db->insert('booking_veg',$data);
                return TRUE;
            }
        }
    }
    
    function alreadybooked()
    {
        $this->db->from('booking_veg');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
			return TRUE;
		}
        else
        return FALSE;
    }
    
    function isbookingtime()
    {
        $time = date('H:i');
        $day = date('D');
        //if($time<'23:30' && $time<'23:00')
        if($time>'2:00' && $time<'18:00' && ($day=='Sat' || $day=='Tue' || $day=='Thu'))
        {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function is_vegetarian()
    {
        $this->db->from('users');
		$this->db->where('id',$this->session->userdata('user_id'));
		$this->db->where('vegetarian',1);
		$sql = $this->db->get()->result();
        if (!(count($sql)==1)){
			return FALSE;
		}else return TRUE;
    }
    
    function is_default_vegetarian()
    {
        $this->db->from('users');
		$this->db->where('id',$this->session->userdata('user_id'));
		$this->db->where('veg_default',1);
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
			return TRUE;
		}else return FALSE;
    }
    
    function toggle_default()
    {
        $this->db->from('users');
		$this->db->where('id',$this->session->userdata('user_id'));
		$this->db->where('veg_default',1);
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
            
            $data = array(
                'veg_default' => 0
                );
            $this->db->where('id', $this->session->userdata('user_id'));
		    $this->db->update('users', $data);
		
        }else
        {
            $data = array(
                'veg_default' => 1
                );
            $this->db->where('id', $this->session->userdata('user_id'));
		    $this->db->update('users', $data);
        }
    }
}
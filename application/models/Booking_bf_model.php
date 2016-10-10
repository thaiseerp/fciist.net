<?php
class Booking_bf_model extends CI_Model {
	
    function get_count($table=''){
        return $this->db->count_all($table);
	}
    
	function book_si_bf($email,$sccode)
    {
        $this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('user_sccode',$sccode);
		$sql = $this->db->get()->result();
        if (!(count($sql)==1)){
			return 2;
		}
        else
        {
            // Make sure user is not already booked
            $this->db->from('booking_bf');
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $sql = $this->db->get()->result();
            if (is_array($sql)&&count($sql)==1){
                return 1;
            }else{
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'user_name' => $this->session->userdata('user_name'),
                    'user_sccode' => $this->session->userdata('user_sccode')
                    );
                if($this->db->count_all('booking_bf')<1)
                {
                    $this->db->insert('booking_bf',$data);
                    return(1);
                }
                else
                {
                    return(3);
                }
            }
        }
    }
    
    function alreadybooked()
    {
        $this->db->from('booking_bf');
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
			return TRUE;
		}
        else
        return FALSE;
    }
    
    function bookingover()
    {
        if($this->db->count_all('booking_bf')>1)
        return TRUE;
        else 
        return FALSE;
    }
    
    function isbookingtime()
    {
        $this->db->from('is_booking_active');
		$this->db->where('id',1);
		$this->db->where('active',1);
		$sql = $this->db->get()->result();
        if ((count($sql)==1)){
			return TRUE;
		}
        else
        {
            $time = date('H:i');
            if($time>'23:30' && $time<'23:00')
            //if($time>'17:58' && $time<'18:00')
            {
                return true;
            }
            else
            {
                return TRUE;
            }
        }
        
    }
}
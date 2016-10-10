<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Thaiseer
 * Date: 02-04-2016
 * Time: 04:17 PM
 */

class Status extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth'));
        $this->load->model('status_model');
    }    
    
    public function index()
    {
        $data['page'] = 'status';
        $data['header_data'] = array('title' => 'FCIIST | Status');
        $this->load->view('template',$data);
    }
    
    public function southindianlunch()
    {
        $users = $this->status_model->get_booked_user();        
        $this->data['users'] = $users;
        $this->data['page'] = 'status_si';
        $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Status');
        $this->load->view('template',$this->data);
    }
    
    public function breakfast()
    {
        $users = $this->status_model->get_bfbooked_user();        
        $this->data['users'] = $users;
        $this->data['page'] = 'status_bf';
        $this->data['header_data'] = array('title' => 'FCIIST | Breakfast Booking Status');
        $this->load->view('template',$this->data);
    }
    
    public function vegspecial()
    {
        $users = $this->status_model->get_vegbooked_user();        
        $this->data['users'] = $users;
        $this->data['page'] = 'status_veg';
        $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Booking Status');
        $this->load->view('template',$this->data); 
    }

}

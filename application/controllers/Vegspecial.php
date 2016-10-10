<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Thaiseer
 * Date: 02-04-2016
 * Time: 04:17 PM
 */

class Vegspecial extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('booking_veg_model');
        $this->lang->load('auth');
        if(!$this->ion_auth->logged_in())
        {
            redirect(base_url().'login', 'refresh');
            exit();
        }else if(!$this->booking_veg_model->is_vegetarian())
        {
            redirect(base_url().'notveg', 'refresh');
            exit();
        }else if($this->ion_auth->is_banned())
        {
            redirect(base_url().'banned', 'refresh');
            exit();
        }
    }

    public function index()
    {
        if($this->booking_veg_model->isbookingtime()==FALSE)
        {
            $this->data['page'] = 'wait_veg';
            $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Booking');
            $this->load->view('template',$this->data);
        }
        else if($this->booking_veg_model->is_default_vegetarian())
        {
            $this->data['page'] = 'default_veg';
            $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Already Booked');
            $this->load->view('template',$this->data);
        }
        else if($this->booking_veg_model->alreadybooked())
        {
            $this->data['page'] = 'booked_veg';
            $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Already Booked');
            $this->load->view('template',$this->data);
        }
        else
        {
            $this->form_validation->set_rules('user_email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            $this->form_validation->set_rules('user_sccode','SCcode', 'trim|required|exact_length[8]|alpha_numeric');
            
            if ($this->form_validation->run() == true)
            {
                $email    = strtolower($this->input->post('user_email'));
                $sccode = $this->input->post('user_sccode');

                $booked = $this->booking_veg_model->book_si_veg($email,$sccode);
                if($booked)
                {
                    $this->data['page'] = 'booked_veg';
                    $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Booking Done');
                    $this->load->view('template',$this->data);
                }
                else
                {
                    $this->session->set_flashdata('message', 'Email and SCode doesn\'t match');
                    redirect("vegspecial", 'refresh');
                }
                
            }
            else
            {
                $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                
                $this->data['user_email'] = array(
                    'name'  => 'user_email',
                    'type'  => 'email',
                    'placeholder' => 'Enter your email address',
                    'required' => '',
                );
                $this->data['user_sccode'] = array(
                    'name'  => 'user_sccode',
                    'type'  => 'text',
                    'placeholder' => 'Enter your Student Code',
                    'required' => '',
                );
                
                $this->data['page'] = 'booking_veg';
                $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Booking');
                $this->load->view('template',$this->data);
            }
        }
    }
    
    public function veg_default()
    {
        if($this->booking_veg_model->isbookingtime()==FALSE)
        {
            $this->data['page'] = 'wait_veg';
            $this->data['header_data'] = array('title' => 'FCIIST | Veg. Special Booking');
            $this->load->view('template',$this->data);
        }
        else
        {
            $this->booking_veg_model->toggle_default();
            redirect(base_url().'vegspecial', 'refresh');
        }
    }

}

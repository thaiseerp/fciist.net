<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Thaiseer
 * Date: 02-04-2016
 * Time: 04:17 PM
 */

class Lunch extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('booking_model');
        if(!$this->ion_auth->logged_in())
        {
            $this->session->set_flashdata('redirect_url', base_url().'lunch');
            $this->session->set_flashdata('message', 'Please Log In to continue');
            redirect(base_url().'login', 'refresh');
            exit();
        }else if($this->ion_auth->is_banned())
        {
            redirect(base_url().'banned', 'refresh');
            exit();
        }
        $this->lang->load('auth');
    }

    public function index()
    {
        if($this->booking_model->isbookingtime())
        {
            $this->data['page'] = 'wait_si';
            $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Booking');
            $this->load->view('template',$this->data);
        }
        else if($this->booking_model->alreadybooked())
        {
            $this->data['page'] = 'booked_si';
            $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Already Booked');
            $this->load->view('template',$this->data);
        }
        else if($this->booking_model->bookingover())
        {
            $this->data['page'] = 'booking_over';
            $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Booked Completed');
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

                $booked = $this->booking_model->book_si_lunch($email,$sccode);
                if($booked==1)
                {
                    $this->data['page'] = 'booked_si';
                    $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Booking Done');
                    $this->load->view('template',$this->data);
                }
                if($booked==2)
                {
                    $this->session->set_flashdata('message', 'Email and SCode doesn\'t match');
                    redirect("lunch", 'refresh');
                }
                else if($booked==3)
                {
                    $this->data['page'] = 'booking_over';
                    $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Booking Over');
                    $this->load->view('template',$this->data);
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
                
                $this->data['page'] = 'booking_si';
                $this->data['header_data'] = array('title' => 'FCIIST | South Indian Lunch Booking');
                $this->load->view('template',$this->data);
            }
        }
    }

}

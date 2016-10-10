<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Thaiseer
 * Date: 02-04-2016
 * Time: 04:17 PM
 */

class Cpanel extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->model('admins_model');
        
        if(!$this->ion_auth->logged_in())
        {
            redirect(base_url().'login', 'refresh');
            exit();
        }else if(!$this->ion_auth->is_admin())
        {
            redirect(base_url().'oops404', 'refresh');
            exit();
        }
    }



    public function index()
    {
        $this->data['bf_state'] = $this->admins_model->get_bf_state();
        $this->data['page'] = 'cpanel';
        $this->data['header_data'] = array('title' => 'FCIIST | Control Panel');
        $this->load->view('template',$this->data);
    }
    
    public function add_user()
    {
        $tables = $this->config->item('tables','ion_auth');
        
        // validate form input
        $this->form_validation->set_rules('user_name','Invalid User Name', 'trim|required|min_length[3]|max_length[20]|alpha_numeric_spaces');
        $this->form_validation->set_rules('user_email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('user_sccode','SCcode', 'trim|required|exact_length[8]|alpha_numeric|is_unique[users.user_sccode]');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'trim|required');
        $this->form_validation->set_rules('user_veg','Veg Code', 'trim|required|exact_length[1]|numeric');

        if ($this->form_validation->run() == true)
        {
            $email    = trim(strtolower($this->input->post('user_email')));
            $password = trim($this->input->post('password'));

            $additional_data = array(
                'user_name' => trim($this->input->post('user_name')),
                'user_sccode'  => trim(strtoupper($this->input->post('user_sccode'))),
                'vegetarian'  => trim(strtoupper($this->input->post('user_veg'))),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($email, $password,$additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("cpanel/add_user", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['user_name'] = array(
                'name'  => 'user_name',
                'type'  => 'text',
                'placeholder' => 'User Name',
                'required' => '',
            );
            $this->data['user_email'] = array(
                'name'  => 'user_email',
                'type'  => 'email',
                'placeholder' => 'User email',
                'required' => '',
            );
            $this->data['user_sccode'] = array(
                'name'  => 'user_sccode',
                'type'  => 'text',
                'placeholder' => 'User SCcode',
                'required' => '',
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'type'  => 'password',
                'placeholder' => 'Password',
                'required' => '',
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'type'  => 'password',
                'placeholder' => 'Confirm Password',
                'required' => '',
                
            );
            $this->data['user_veg'] = array(
                'name'  => 'user_veg',
                'type'  => 'text',
                'placeholder' => '0 for NON vegetarian else 1 ',
                'required' => '',  
            );

            $this->data['page'] = 'register';
            $this->data['header_data'] = array('title' => 'FCIIST | Control Panel - Register New Users');
            $this->load->view('template',$this->data);
        }
    }
    
    public function users()
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cpanel/users/page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $this->admins_model->get_count('users');
        $config['per_page'] = 20;
        
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['prev_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="#" class="active" onclick="return false;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $page = preg_replace("/[^0-9]+/", "", $this->uri->segment(4));
        if($page!='')
        {
            if($this->uri->segment(4)>$config['total_rows']/$config['per_page']) $start = $config['total_rows']-$config['per_page'];
            else $start =  ($this->uri->segment(4)*$config['per_page'])-($config['per_page']);
        }
        else $start = 0;
        
        $users = $this->admins_model->get_users($start,$config['per_page']);
        
        $this->data['users'] = $users;
        
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['test_val'] = $this->admins_model->get_count('users');
        $this->data['page'] = 'users';
        $this->data['header_data'] = array('title' => 'FCIIST | Control Panel - Registered Users');
        $this->load->view('template',$this->data);
    }
    
    public function edit_user($id=NULL)
    {
        if(isset($id))
        {
            $user = $this->ion_auth->user($id)->row();
            $groups=$this->ion_auth->groups()->result_array();
            $currentGroups = $this->ion_auth->get_users_groups($id)->result();

            // validate form input
            $this->form_validation->set_rules('user_name','Invalid User Name', 'trim|required|min_length[3]|max_length[20]|alpha_numeric_spaces');
            $this->form_validation->set_rules('user_email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
            $this->form_validation->set_rules('user_sccode','SCcode', 'trim|required|exact_length[8]|alpha_numeric');
            $this->form_validation->set_rules('user_veg','Veg Code', 'trim|required|exact_length[1]|numeric');

            if (isset($_POST) && !empty($_POST))
            {
                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'trim|required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                    $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'trim|required');
                }

                if ($this->form_validation->run() === TRUE)
                {
                    $data = array(
                        'user_email' => strtolower($this->input->post('user_email')),
                        'user_name' => $this->input->post('user_name'),
                        'user_sccode'  => strtoupper($this->input->post('user_sccode')),
                        'vegetarian' => $this->input->post('user_veg'),
                    );

                    // update the password if it was posted
                    if ($this->input->post('password'))
                    {
                        $data['password'] = $this->input->post('password');
                    }


                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                    if($this->ion_auth->update($user->id, $data))
                    {
                        $this->session->set_flashdata('message', 'User details Updated Successfully' );
                        redirect('cpanel/edit_user/'.$id, 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors() );
                        redirect('cpanel/edit_user/'.$id, 'refresh');
                    }
                }
            }

            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            // pass the user to the view
            $this->data['user'] = $user;
            $this->data['groups'] = $groups;
            $this->data['currentGroups'] = $currentGroups;

            $this->data['user_name'] = array(
                'name'  => 'user_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('user_name', $user->user_name),
                'required' => '',
            );
            $this->data['user_email'] = array(
                'name'  => 'user_email',
                'type'  => 'email',
                'value' => $this->form_validation->set_value('user_eamil', $user->email),
                'required' => '',
            );
            $this->data['user_sccode'] = array(
                'name'  => 'user_sccode',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('user_sccode', $user->user_sccode),
                'required' => '',
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'type'  => 'password',
                'placeholder' => 'New Password',
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'type'  => 'password',
                'placeholder' => 'Confirm New Password', 
            );
            $this->data['user_veg'] = array(
                'name'  => 'user_veg',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('user_veg', $user->vegetarian),
                'required' => '',  
            );


            $this->data['page'] = 'change_user_details';
            $this->data['header_data'] = array('title' => 'FCIIST | Control Panel - Change User Details');
            $this->load->view('template',$this->data);
        }
        else
        {
            redirect('cpanel/users', 'refresh');
        }
    }
    
    function clear_booking($id=NULL)
    {
        $this->data['message'] = $this->session->flashdata('message');
        $id = preg_replace("/[^123]+/", "", $id);
        switch ($id) {
            case '1':
                $this->admins_model->truncate_booking('booking_si');
                $this->session->set_flashdata('message', 'South Indian Lunch Booking Cleared');
                redirect(base_url().'cpanel/clear_booking', 'refresh');
                break;
            case '2':
                $this->admins_model->truncate_booking('booking_bf');
                $this->session->set_flashdata('message', 'Breakfast Booking Cleared');
                redirect(base_url().'cpanel/clear_booking', 'refresh');
                break;
            case '3':
                $this->admins_model->truncate_booking('booking_veg');
                $this->session->set_flashdata('message', 'Special Veg. Booking Cleared');
                redirect(base_url().'cpanel/clear_booking', 'refresh');
                break;
            default:
                $this->session->set_flashdata('message', 'Clearing table cannot be undone');
                $this->data['page'] = 'clear_booking';
                $this->data['header_data'] = array('title' => 'FCIIST | Control Panel - Clear Booking');
                $this->load->view('template',$this->data);
                break;
        }
    }
    
    function toggle_bf_state()
    {
        $this->admins_model->toggle_bf_active();
        redirect(base_url().'cpanel', 'refresh');
    }

}
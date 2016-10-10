<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Thaiseer
 * Date: 02-04-2016
 * Time: 04:17 PM
 */

class Home extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }

    public function index()
    {
        $data['page'] = 'home';
        $data['header_data'] = array('title' => 'FCIIST | Home');
        $this->load->view('template',$data);
    }
    
    public function login()
    {
        //validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
            $remember = (bool) $this->input->post('remember');
            
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect($this->session->flashdata('redirect_url'));
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
                $this->session->keep_flashdata('redirect_url');
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array(
                'name' => 'identity',
				'type'  => 'email',
                'placeholder' => 'User email',
                'required' => '',
                'autocomplete' => 'off',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array(
                'name' => 'password',
                'placeholder' => 'Password',
				'type' => 'password',
                'autocomplete' => 'off',
                'required' => '',
			);

		}        

        $this->data['page'] = 'login';
        $this->data['header_data'] = array('title' => 'FCIIST | Login');
        $this->load->view('template',$this->data);
    }
    
	function logout()
	{
		$data['header_data'] = array('title' => 'Logout');

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect(base_url(), 'refresh');
	}

    public function about_us()
    {
        $data['page'] = 'about';
        $data['header_data'] = array('title' => 'FCIIST | About Us');
        $this->load->view('template',$data);
    }

    public function notveg()
    {
        $data['page'] = 'notveg';
        $data['header_data'] = array('title' => 'FCIIST | Not registered for veg food');
        $this->load->view('template',$data);
    }

    public function banned()
    {
        $data['page'] = 'banned';
        $data['header_data'] = array('title' => 'FCIIST | User Bannned from FCIIST');
        $this->load->view('template',$data);
    }
    
}
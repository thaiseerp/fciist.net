<?php 
class Oops403 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('403');
        $this->load->view('403');
    } 
} 
?>
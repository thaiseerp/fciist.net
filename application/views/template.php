<?php

if(!isset($header_data))
{
	$header_data = array(
		'title' => 'FCIIST'
	);
}

//load header, page and footer views
$this->load->view('pages/includes/header',$header_data);
$this->load->view('pages/'.$page);
$this->load->view('pages/includes/footer');
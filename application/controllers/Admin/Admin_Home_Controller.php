<?php

class Admin_Home_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	
    }
	public function index()
   {   
         $check=$this->session->userdata('user_id');
         $user=$this->session->userdata('role');
         if($user=="Admin" && count($check) == 1)
		 {
		  $this->load->view('Admin/Home');
		 }
          else{
			 redirect('admin_login');
		  }		 
         
  
   }

}
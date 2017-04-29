<?php

class Admin_Login_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	//$this->load->model('Job_Seeker/Uploade_Resume_Model');
	$this->load->model('Admin/Login_Model');
    }
	public function index()
   {   
   $this->load->view('Admin/login');
   }
public function admin_login()
   { 
   	    $email_id=$this->input->post('email');
		$pass=$this->input->post('password');
		$user=$this->Login_Model->check_login_user($email_id,$pass);
	    $check=$this->session->userdata('user_id');
		 if($user=="Admin" && count($check) == 1)
		 {
			 
		  redirect('admin_dashboard');	 
		 echo $user; 
		 }
		 else{ 
		   $this->load->view('Admin/login');
		   /* if($user==fail){
			 $data['error']=$data=array("msg"=>"Email Id  and Password Not Valid");	 
            $this->load->view('Admin/login',$data);   
		   }
		   else{
			   $this->load->view('Admin/login');   
		   } */
	       
			//echo $user;
         } 
   
   }
   
   public function get_admin_info(){
	   $user=$this->Login_Model->get_admin_info();
	   echo json_encode($user);
   }
    
	public function change_admin_info(){
		$data=array("email"=>$this->input->post('email'),"password"=> $this->input->post('password'));
		$user=$this->Login_Model->change_admin_info($data);
	   echo json_encode($user);
   }
    
	
}
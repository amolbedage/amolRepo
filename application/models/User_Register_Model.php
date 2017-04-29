<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Register_Model extends CI_Model {

public function __construct()
{
   parent::__construct();
   $this->load->database('');
   $this->load->library('session'); 
   
}

public function index(){

}
	

 public function employer_reg($user){
		 //print_r($user);
		 
		 return  $this->db->insert('fj_user',$user);
		 
	 } 
	 public function job_seeker_reg($user){
		 //print_r($user);
		 
		 return  $this->db->insert('fj_seeker_reg',$user);
		 
	 }
	 public function check_email_id($email_id){
		 //print_r($user);
		 $this->db->select('*');
		$this->db->from('fj_user');
		$this->db->where('email',$email_id);
		return $this->db->get()->result_array();
		 
	 }
	 
	public function check_login_user($email_id,$pass){
		$this->db->select('user_id,role,email');
		$this->db->from('fj_user');
		$this->db->where('email',$email_id);
		$this->db->where('password',$pass);
		//return $this->db->get()->result_array();
	    $login = $this->db->get()->result();
		
		 if( is_array($login) && count($login) == 1 ) {	
           $this->details = $login[0];           
           $this->set_session();    
           $role=$this->session->userdata('role');		   
           return $role;
           }else{
              return "fail"; 
           }	
            
	}
  function set_session() {
        
         $this->session->set_userdata( array(
                'user_id'=>$this->details->user_id,
                'email'=>$this->details->email,
                'role'=>$this->details->role,
                'isLoggedIn'=>true
              ));

    }
     
}
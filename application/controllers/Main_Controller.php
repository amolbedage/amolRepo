<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	
	public function index()
	{
		$this->load->view('User/Home');

	}
	
	public function check_user_login(){
		 $id=$this->session->userdata('user_id'); 
		 $user_role=$this->session->userdata('role');
		 if(count($id)&&$user_role){
			 echo $user_role;
		 }
		
	}
   public function logout(){
	   
	 $id=$this->session->userdata('user_id'); 
	     if(count($id)==1){
				   $newdata = array(
							'user_id'=>' ',
							'email'=> ' ',
							'role'=>' ',
							'isLoggedIn'=>false
						   );
					 $this->session->sess_destroy(); 
					 echo"in";
                    }
					else
						{
							echo "logout";
						}
   }
}

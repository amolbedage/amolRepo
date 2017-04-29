<?php

class RegisterController extends CI_Controller {

    public function __construct()
  {
    parent::__construct();
	$this->load->model('User_Register_Model');
	$this->load->model('Job_Seeker/Uploade_Resume_Sub_Model');
   $this->load->library('session');  
  }
   
   public function index()
	{
      
      
	}
	public function job_seeker_reg(){
  	 $Job_seeker='Job_seeker';
	  $email_id=$this->input->POST('email');
      $password=$this->input->POST('password');
      $con_password=$this->input->POST('con_password');
	  $Count_email=(count($this->User_Register_Model->check_email_id($email_id)));
	 if($Count_email==0){
		         if($password==$con_password){
					 $user=array(
					   'name'=> $this->input->POST('fname')." ".$this->input->POST('lname'),
					    //'gender'=> $this->input->POST('gender'),
					   'email'=> $this->input->POST('email'),
					   'password'=> $this->input->POST('password'),
					  //'role'=>$Job_seeker,
					 );
					// print_r($user);
					$data=$this->User_Register_Model->job_seeker_reg($user);
					 echo "success";
				 }
				  else{echo'Not_valid';}
	        }
	        else{ echo 'already_exist';}
	
	        /* $seeker_id=$this->session->userdata('user_id'); 
			$arr=array('1');
			// $arr2=json_encode($arr);
			$experience=json_encode($arr);
			$expert=json_encode($arr);
	          $user=array(
	                   "seeker_id"=>$seeker_id,
	                   "experience"=>$experience,
	                   "expert"=>$expert,
	                );
		    $data=$this->Uploade_Resume_Sub_Model->add_seeker_experience_expert_ifno($user);  */	
	  // echo $json_response = json_encode($data);
	}
	
	public function employer_reg(){
  	 $Employer='Employer';
      $email_id=$this->input->POST('email');
      $password=$this->input->POST('password');
      $con_password=$this->input->POST('con_password');
	  $Count_email=(count($this->User_Register_Model->check_email_id($email_id)));
	 if($Count_email==0){
			      if($password==$con_password){
					  
				  $user=array(
						'companyname'=> $this->input->POST('companyname'),
						  'name'=> $this->input->POST('name'),
						  'mobile_number'=> $this->input->POST('mobile_number'),
						  'email'=> $this->input->POST('email'),
						  'country'=> $this->input->POST('country'),
						  'password'=> $this->input->POST('password'),
						  'role'=>$Employer,
						  );
						//print_r($user);
				    $data=$this->User_Register_Model->employer_reg($user);
					echo "success";
				  }
				  else{echo'Not_valid';}
		 }
		 else{ echo 'already_exist';}
	 
	 // $data=$this->User_Register_Model->job_seeker_reg($user);
	  //	echo $json_response = json_encode($data);
	}

	public function check_email_employer(){
		 $email_id=$_GET['email_id'];
		 $Count_email=(count($this->User_Register_Model->check_email_id($email_id)));
		 if(!$Count_email==0){
			 echo 'already_exist';
		 }
	}
	public function check_login_user(){
		
		$email_id=$this->input->post('email');
		$pass=$this->input->post('password');
		$user=$this->User_Register_Model->check_login_user($email_id,$pass);
	    $check=$this->session->userdata('user_id');
		 if($user=="Admin" && count($check) == 1)
		 {
		 echo $user; 
		 }
		 else{ 
            
			echo $user;
         } 
	}
     
	/* public function get_bolg_postdata(){
		$getdt=$this->Blog_Model->getdata();
		//print_r($getdt);
		echo $json_response = json_encode($getdt);

	}
	
	 public function edit_category_data(){
		 $cat_id=json_decode($_GET['cat_id']);
		 $cat=$this->Blog_Model->edit_category($cat_id);
		 echo $json_response = json_encode($cat);
	 }
	  */
	 
	
	 


}
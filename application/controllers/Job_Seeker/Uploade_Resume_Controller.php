<?php

class Uploade_Resume_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model('Job_Seeker/Uploade_Resume_Model');
    }
	public function index()
   {   
  //  $this->load->view('Job_Seeker/Job_Seeker');
   }
   
   public function seeker_experience(){
	   /* $data=json_decode($_GET['data']);
	   
	   $amol = array();
	  // print_r($data);
	   for($i = 0; $i<count($data);$i++)
	   {
		 $temp = explode(",",$data[$i]);
		 array_push($amol,$temp[1]);
	   }
	   $amol = array_unique($amol);
	   $amol = implode(",",$amol);
	   $amol = explode(",",$amol);
	  // print_r($amol);
	  $final = array();
	  $rushi = array();
	  $rushi = $amol;
	
	  for($j = 0;$j<count($data);$j++)
	  {
		  $temp = explode(",",$data[$j]);
		 // print_r($temp);
		   for($k = 0;$k<count($amol);$k++)
		  {
			  if($amol[$k] == $temp[1])
			  {
				  $aa =  $rushi[$k];
					$bb = $temp[0];
				 $cc = $aa.",".$bb;	
				 $rushi[$k] = $cc;
			  }
		  } 
	  } 
	  print_r($rushi); */
	   
   }
   
   public function check_seeker_email_id()
   {   
       $email_id=$_GET['email_id'];
		  $Count_email=(count($this->Uploade_Resume_Model->check_seeker_email_id($email_id)));
		 if(!$Count_email==0){
			 echo 'already_exist';
		 } 
   }
   public function job_seeker_login(){
	  
	     $email_id=$this->input->post('email');
	   	$pass=$this->input->post('password');
		$user=$this->Uploade_Resume_Model->job_seeker_login_user($email_id,$pass);
					   $check=$this->session->userdata('user_id');
						 if(count($check)==1)
						 {
						   echo $user; 
					    }
   }
   
   public function uploade_resume_and_job_seeker_reg(){
	 $resume=$this->input->post('resume');  
	 $pro_picture=$this->input->post('pro_picture'); 
	  $categeries_name=$this->input->post('category_name');
	 $email_id=$this->input->post('email');
      $Count_email=(count($this->Uploade_Resume_Model->check_seeker_email_id($email_id)));
		 if($Count_email==0){
			        if(!empty($categeries_name)){
			        $user_data=array(   
					'name'=>$this->input->post('fname')." ".$this->input->post('lname'),
					'email'=>$this->input->post('email'),
					'bs_computer_rel'=>$this->input->post('bs_computer_rel'),
					'ms_computer_rel'=>$this->input->post('ms_computer_rel'),
					'deploy_to_warzones'=>$this->input->post('deploy_to_warzones'),
					'experience'=>$this->input->post('experience'),
					'highest_degree'=>$this->input->post('highest_degree'),
					'low_enforcement_exp'=>$this->input->post('low_enforcement_exp'),
					'military_exp'=>$this->input->post('military_exp'),
					'password'=>$this->input->post('password'),
					'security_clearance'=>$this->input->post('security_clearance'),
					'willing_to_relocate'=>$this->input->post('willing_relocate'),
					'willing_to_travel'=>$this->input->post('willing_to_travel'),
					'zip_code'=>$this->input->post('zipcode'),
					'categeries_name'=>$this->input->post('category_name'),
					'skill_keywords'=>$this->input->post('skill_keywords'),
					//'pro_picture'=>$this->input->post('pro_picture'),
					//'resume_pdf'=>$this->input->post('resume'),
	                 );
	
						 if($pro_picture !=""){
							 $pro=array('pro_picture'=>$this->input->post('pro_picture'));
							$user_data=(array_merge($user_data,$pro));
						 }
						 if($resume !=""){
							 $res=array('resume_pdf'=>$this->input->post('resume'));
							$user_data=(array_merge($user_data,$res));
						 }
	//print_r($user_data);
	       $data = $this->Uploade_Resume_Model->seeker_reg_and_resume_uploade($user_data); 
               if($data){
				      $email_id=$this->input->post('email');
					  $pass=$this->input->post('password');
						$user=$this->Uploade_Resume_Model->job_seeker_login_user($email_id,$pass);
					   $check=$this->session->userdata('user_id');
						 if(count($check) == 1)
						 {
						   echo $user; 
					    }
						 
			   }	
					}
             else{
				 echo 'category_empty';  
			 }					
           //print_r($data);	
		 }
          else{
			 echo 'already_exist';  
		  }		 
	 	   
   }
   
  
  public function get_user_info_and_cat_id(){
	   $user_id=$this->session->userdata('user_id');
	   $role=$this->session->userdata('role');
	   if($user_id&&$role=="Job_Seeker"){
		  $data=$this->Uploade_Resume_Model->get_user_info_and_cat_id($user_id);
		  echo $da=$data[0]['categeries_name'];
		//echo $json_response = json_encode($da);
	     }
		 else{
		 echo "not_login";
		 }
	
  }
  public function get_user_experience_expert(){
	 
	 $cat_list=$_GET['cat_data'];
		//$cat_list="1,2,3";
	 $data=$this->Uploade_Resume_Model->get_user_experience_expert($cat_list);
	 // echo "<pre>";
	 //print_r($data);
	 $newdata=array(); 
	for($i=0;$i<sizeof($data);$i++){
		array_push($newdata,$data[$i][0]);
	}
	// echo "<pre>";
	 //print_r($d);
	 
	   foreach($newdata as $da){
			$exp_name= array();
			
		$cat_id=$da->cat_id;
			//$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Uploade_Resume_Model->get_user_experience_expert_list($cat_id);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($exp_name,$r->option_name);
			}
			
			$da->exp_expert_list=$exp_name; 
		}
		
	 	echo $json_response = json_encode($newdata); 
  }
   
      
    public function Add_pro_picture(){
	
	$target_dir = "./upload/job_seeker/pro_picture/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 
}
public function Add_resume(){
	
	$target_dir = "./upload/job_seeker/resume/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 
}

}
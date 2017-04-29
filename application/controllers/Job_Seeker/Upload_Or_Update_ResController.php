<?php

class Upload_Or_Update_ResController extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model('Job_Seeker/Upload_Or_Update_Res_Model');
	$this->load->model('Job_Seeker/Uploade_Resume_Sub_Model');
    }
	public function index()
   {   
  //  $this->load->view('Job_Seeker/Job_Seeker');
   }
   
     public function get_user_experience_expert_save_data(){
	   $data=$this->Upload_Or_Update_Res_Model->get_user_experience_expert_save_data();
	//  print_r($data);
	 if(!empty($data)){
	  $sde=json_decode($data[0]->experience);
	  echo json_encode($sde); 
	 }
	 /*   $sde=json_decode($data[0]->experience);
	 //  print_r($sde);
	   $da=implode(',',$sde);
   	   
          $res=explode(',',$da);
		echo json_encode($res);     */
		
   }
   public function get_user_experience_expert_save_data_two(){
	   $data=$this->Upload_Or_Update_Res_Model->get_user_experience_expert_save_data();
	 //  print_r($data);
	  if(!empty($data)){
	 $sde=json_decode($data[0]->expert);
	  echo json_encode($sde);
	  }
	   /* $sde=json_decode($data[0]->expert);
	 //  print_r($sde);
	   $da=implode(',',$sde);
   	   
          $res=explode(',',$da);
		echo json_encode($res);  */   
		 
   }
 public function get_seeker_information_for_update(){
 $user_data=$this->Upload_Or_Update_Res_Model->get_seeker_information_for_update();
 //print_r($user_data);
 echo json_encode($user_data);
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
   
   public function uploade_or_update_resume(){
	 $resume=$this->input->post('resume');  
	 $pro_picture=$this->input->post('pro_picture'); 
	  $categeries_name=$this->input->post('category_name');
	  $bs_computer_rel=$this->input->post('bs_computer_rel');
	  $ms_computer_rel=$this->input->post('ms_computer_rel');
	 $email_id=$this->input->post('email');
     		        if(!empty($categeries_name)){
			        $user_data=array(   
					//'name'=>$this->input->post('fname')." ".$this->input->post('lname'),
					//'email'=>$this->input->post('email'),
					'bs_computer_rel'=>$this->input->post('bs_computer_rel'),
					'ms_computer_rel'=>$this->input->post('ms_computer_rel'),
					'deploy_to_warzones'=>$this->input->post('deploy_to_warzones'),
					'experience'=>$this->input->post('experience'),
					'highest_degree'=>$this->input->post('highest_degree'),
					'low_enforcement_exp'=>$this->input->post('low_enforcement_exp'),
					'military_exp'=>$this->input->post('military_exp'),
					//'password'=>$this->input->post('password'),
					'security_clearance'=>$this->input->post('security_clearance'),
					'willing_to_relocate'=>$this->input->post('willing_relocate'),
					'willing_to_travel'=>$this->input->post('willing_to_travel'),
					'zip_code'=>$this->input->post('zipcode'),
					'categeries_name'=>$this->input->post('category_name'),
					'skill_keywords'=>$this->input->post('skill_keywords'),
					//'pro_picture'=>$this->input->post('pro_picture'),
					//'resume_pdf'=>$this->input->post('resume'),
	                 );
	                    if($bs_computer_rel=='Yes' or $ms_computer_rel=='Yes' ){
							 $pro=array('computer_degree'=>'Yes');
							$user_data=(array_merge($user_data,$pro));
						}
						else{
							 $pro=array('computer_degree'=>'No');
							$user_data=(array_merge($user_data,$pro));
						}
						 if($pro_picture !=""){
							 $pro=array('pro_picture'=>$this->input->post('pro_picture'));
							$user_data=(array_merge($user_data,$pro));
						 }
						 if($resume !=""){
							 $res=array('resume_pdf'=>$this->input->post('resume'));
							$user_data=(array_merge($user_data,$res));
						 }
	       //print_r($user_data);
	      $data = $this->Upload_Or_Update_Res_Model->uploade_or_update_resume($user_data); 
		 // print_r($data);
			 echo $user =$this->session->userdata('role'); 		  
							 /*  $email_id=$this->session->userdata('email');
							  $pass=$this->input->post('password');
								$user=$this->Upload_Or_Update_Res_Model->job_seeker_login_user($email_id,$pass);
							   $check=$this->session->userdata('user_id');
								 if(count($check) == 1)
								 {
								   echo $user; 
								} 
								   */
					
					}
             else{
				 echo 'category_empty';  
			 }					
           //print_r($data);
           $seeker_id=$this->session->userdata('user_id'); 
			$da=$this->Uploade_Resume_Sub_Model->count_experience_expert_save_or_not();
			  /*if( count($da)==0){
				$arr=array('1');
			// $arr2=json_encode($arr);
			$experience=json_encode($arr);
			$expert=json_encode($arr);
	          $user=array(
	                   "seeker_id"=>$seeker_id,
	                   "experience"=>$experience,
	                   "expert"=>$expert,
	                );
		    $data=$this->Uploade_Resume_Sub_Model->add_seeker_experience_expert_ifno($user); 
			}
				 */	   
		 
	}	 
	 	   
   
  public function delete_seeker_pro_picture(){
	  $pro_picture=array("pro_picture"=>'');
	  $user=$this->Upload_Or_Update_Res_Model->delete_seeker_pro_picture($pro_picture);
	   echo $user;
  }  
  public function delete_seeker_resume(){
	  $resume=array("resume_pdf"=>'');
	  $user=$this->Upload_Or_Update_Res_Model->delete_seeker_resume($resume);
	  echo $user;
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
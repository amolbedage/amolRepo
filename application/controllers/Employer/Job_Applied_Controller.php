<?php

class Job_Applied_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model("Employer/Job_Applied_model");
	$this->load->library('session');
	$this->load->database('');
	$this->load->library('email');
    }
	public function index()
	{   
		
	}
	 
	public function get_applied_candidate_check_login(){
     $role=$this->session->userdata('role');
	 $user_id=$this->session->userdata('user_id');
	 if($role=='Employer'&&count($user_id)){
		 echo $role;
	 }	
	 else{
		 echo "Not_login";
	 }
	
	}
	public function get_applied_candidate_list(){
	
	    $user_data=$this->Job_Applied_model->get_applied_candidate_list();
		$result=$this->Job_Applied_model->get_applied_candidate_data($user_data);
		//echo "<pre>";
		//print_r($result);
		$newdata=array(); 
		for($i=0;$i<sizeof($result);$i++){
			array_push($newdata,$result[$i][0]);
		}
		

		/*  foreach($newdata as $d){
					$img= array(); 
	
		            $seeker_cat_id=$d['categeries_name'];
				   $cat_ids=explode(",", $seeker_cat_id);
					//print_r($cat_ids);
					$rows=$this->Job_Applied_model->single_user_view_all_cats($cat_ids);
					//print_r($rows);
					 foreach($rows as $r){
					
						array_push($img,$r->cat_logo);
					}
					
					$d->images=$img; 
				}  */
        // echo "<pre>";				
		//print_r($newdata);
		
		echo json_encode($newdata);
		
	}
}
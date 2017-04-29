<?php

class Dashboard_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	
	$this->load->model('Admin/Dashboard_Model');
    }
	public function index()
   {   
         
 
   }
   
   public function get_job_seeker(){
	  
	  
	   $user=$this->Dashboard_Model->get_job_seeker_data();
	   
	   echo count($user);
	   
	   
   } 
   public function employer_reg_count(){
	  
	  
	   $user=$this->Dashboard_Model->employer_reg_count();
	   
	   echo count($user);
	   
	   
   }
   public function add_experience_option(){
	  
	 $year=$_GET['exp_option'];
	   $year=array("year"=>$year);
	  echo $user=$this->Dashboard_Model->add_experience_option($year);
	           
   }
   public function get_experience_option_data(){
	  $user=$this->Dashboard_Model->get_experience_option_data();
     // print_r($user);	  
      echo json_encode($user); 
   } 
   public function delete_exp_option(){
	    $id=$_GET['id'];
	  $user=$this->Dashboard_Model->delete_exp_option($id);
     // print_r($user);	  
     // echo json_encode($user); 
   }
   public function update_exp_option(){
	    $data=json_decode($_GET['op_data']);
	    $id=$data->op_id;
		$newdata =array('year'=>$data->year);
		//print_r($newdata);
	  $user=$this->Dashboard_Model->update_exp_option($newdata,$id);
     // print_r($user);	  
     echo json_encode($user); 
   }

}
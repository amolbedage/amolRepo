<?php

class Job_Sub_Category_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	
	$this->load->model('Admin/Job_Sub_Category_Model');
    }
	public function index()
   {   
         
 
   }
   
  
   public function add_sub_cat_exapert_exp(){
	  $data=json_decode($_GET['data']);
	  //print_r($data);
	$user=$this->Job_Sub_Category_Model->add_sub_cat_exapert_exp($data);
	          
   }
   public function get_all_sub_job_category_option(){
	  $user=$this->Job_Sub_Category_Model->get_all_sub_job_category_option();
     // print_r($user);	  
      echo json_encode($user); 
   } 
   
   public function delete_Sub_category_option(){
	    $id=$_GET['id'];
	  $user=$this->Job_Sub_Category_Model->Job_Sub_Category_Model($id);
      
   } 
   
   public function edit_Sub_category(){
	  $cat_option_id=$_GET['cat_id'];
	 $user=$this->Job_Sub_Category_Model->get_for_edit_Sub_category($cat_option_id);
     // print_r($user);	  
     echo json_encode($user); 
   }
   public function update_job_category_sub_option(){
	    $data=json_decode($_GET['op_data']);
		$option_name=$data->option_name;
		$cat_id=$data->cat_id;
	    $cat_option_id=$data->cat_option_id;
	
		
		$newdata =array('option_name'=>$option_name,'cat_id'=>$cat_id);
	    $user=$this->Job_Sub_Category_Model->update_job_category_sub_option($newdata,$cat_option_id);
       // print_r($user);	  
       echo json_encode($user); 
   }
   
   public function Add_Category_img(){
	
	$target_dir = "./upload/Category_img/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 
}

}
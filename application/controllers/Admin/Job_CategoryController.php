<?php

class Job_CategoryController extends CI_Controller {
public function __construct()
{
    parent::__construct();
	
       /* $check=$this->session->userdata('user_id');
       $user=$this->session->userdata('role');
		 if($user=="Admin" && count($check) == 1)
		 {
			 redirect('admin_dashboard');	 
		 
		 } */
	$this->load->model('Admin/Job_Category_Model');
    }
	public function index()
   {   
         
 
   }
   
  
   public function add_job_category_option(){
	  
	 $data=array("cat_name"=>$_GET['cat_name'],'cat_logo'=>$_GET['filename'],'description'=>$_GET['cat_desc']);
	// print_r($data);
	 $user=$this->Job_Category_Model->add_job_category_option($data);
	 //print_r($user);           
   }
   public function get_job_category_option(){
	  $user=$this->Job_Category_Model->get_job_category_option();
     // print_r($user);	  
      echo json_encode($user); 
   } 
   
   public function delete_category_option(){
	    $id=$_GET['id'];
	  $user=$this->Job_Category_Model->delete_category_option($id);
      
   } 
   
   public function edit_category(){
	  $cat_id=$_GET['cat_id'];
	 $user=$this->Job_Category_Model->get_for_edit_category($cat_id);
     // print_r($user);	  
     echo json_encode($user); 
   }
   public function update_job_category_option(){
	    $data=json_decode($_GET['op_data']);
		$cat_name=$data->cat_name;
		$cat_id=$data->cat_id;
		$cat_desc=$data->cat_desc;
		 $edit_filename=($_GET['edit_filename']);
		$newdata =array('cat_name'=>$cat_name,'description'=>$cat_desc);
		 if(!empty($edit_filename)){
			 $newdata =array('cat_name'=>$cat_name,'cat_logo'=>$edit_filename,'description'=>$cat_desc);
		 }
	  	//print_r($newdata);
	  $user=$this->Job_Category_Model->update_job_category_option($newdata,$cat_id);
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
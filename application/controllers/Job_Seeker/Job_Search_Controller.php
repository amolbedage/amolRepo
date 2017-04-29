<?php

class Job_Search_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model('Job_Seeker/Job_Search_Model');
    }
	public function index()
   {   
  //  $this->load->view('Job_Seeker/Job_Seeker');
   }
   public function get_experience_option()
   {   
     $data=$this->Job_Search_Model->get_experience_option();
	echo json_encode($data);
   }
   
   public function fetch_selected_cat_data(){
    $cat_list=$_GET['cat_list'];
	$data=$this->Job_Search_Model->fetch_selected_cat_data($cat_list);
     
	$d=array(); 
	for($i=0;$i<sizeof($data);$i++){
		array_push($d,$data[$i][0]);
	}
	echo $json_response = json_encode($d);
	
   }
    public function job_search_cat_wz(){
	  $category=$this->input->post('search_cat_list');
		
		 $a=explode(',',$category);
		  sort($a);
		  $category_name=implode(",",$a);
		 
		 $keywords=$this->input->post('keywords');
		 $experience=$this->input->post('experience');
	     $sec_cle=$this->input->post('security_clearance');
	     $zip_code=$this->input->post('zip_code');
	      if(!empty($zip_code)){
			 $zip_codes=explode(',',$zip_code);
			 //$zip_codes=json_encode($zip);
			  //print_r($zip_codes);
		  }else{$zip_codes=array();}
	     if(empty($experience)&& !empty($sec_cle) && !empty($keywords)){
			
			 $data=$this->Job_Search_Model->job_search_cat_wz2($experience,$sec_cle,$zip_codes,$category_name,$keywords);
		 }
		  else if (empty($experience)&& !empty($sec_cle) && empty($keywords)) {
			
			 $data=$this->Job_Search_Model->job_search_cat_wz3($experience,$sec_cle,$zip_codes,$category_name,$keywords);
		 }
		 else{
			 $data=$this->Job_Search_Model->job_search_cat_wz($experience,$sec_cle,$zip_codes,$category_name,$keywords);
		 }
	   
	
	// print_r($data);
	if(!empty($data)){
		foreach($data as $d){
					$img= array();
					
					$seeker_cat_id=$d->category_name;
					$cat_ids=explode(",", $seeker_cat_id);
					//print_r($cat_ids);
					$rows=$this->Job_Search_Model->single_user_view_all_cats($cat_ids);
					//print_r($rows);
					foreach($rows as $r){
					
						array_push($img,$r->cat_logo);
					}
					
					$d->images=$img;
				  } 
		 echo $json_response = json_encode($data);  
	}
	//else{ echo"result_not_found";}
		     
	  
		
   }//End search job cat WZ
   
   public function check_job_seeker_login(){
	    $user_id=$this->session->userdata('user_id');
	   $role=$this->session->userdata('role');
	   if($user_id&&$role=="Job_Seeker"){
		
      		 echo "Job_Seeker_login";
	     }
		 else{
		 echo "not_login";
		 }
   }
   public function seeker_apply_for_job(){
	   $job_id=$_GET['job_id'];
	   $employer_id=$_GET['user_id'];
	    $seeker_id=$this->session->userdata('user_id');
		$check=$this->Job_Search_Model->check_seeker_apply_for_job($job_id,$seeker_id);	
	    //echo"count -".count($check);
		if( count($check)==0){
			$user_data=array(
		          "job_post_id"=>$job_id,
		          "seeker_id"=>$seeker_id,
		          "apply_date"=>date("Y-m-d"),
		          "employer_id"=>$employer_id,
		          //"apply_date"=>date("Y-m-d h:i:sa"),
		           );
	     //$msg=$this->Job_Search_Model->seeker_apply_for_job($user_data);	
				
		 $seeker_data=$this->Job_Search_Model->get_seeker_email_id($seeker_id);	
		 //print_r($seeker_data);		
		$data['userdata'] =$seeker_data ; 
	    $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html'; // or html
        $config['validation']   = true; // bool whether to validate email or not      
        $this->email->initialize($config);
		
      
		$message= $this->load->view('Job-Applyl-template',$data,true);
	    //print_r($message);
		 $employer_email_id=$this->Job_Search_Model->get_employer_email_id($employer_id);
		 
		  
          $from_email = $seeker_data[0]['email']; 
          $to_email = $employer_email_id[0]['email'];; 
         $this->email->from($from_email, 'Forensic Job'); 
         $this->email->to($to_email);
         $this->email->subject('New Candidate Applied For Job'); 
         $this->email->message($message);        		
	    // $this->email->send(); 
                    
               
			  
			    echo "success";
		 }
		 else{
			echo"Applied";
		}
		
   }

     

}
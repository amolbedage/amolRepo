<?php

class Employer_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model("Employer/Employer_model");
	$this->load->model("User_Register_Model");
	$this->load->library('session');
	$this->load->database('');
	$this->load->library('email');
    }
	public function index()
	{   
		$this->load->view('Employer/Employer');
	}
	 public function check_employeer_email_id()
   {   
       $email_id=$_GET['email_id'];
		  $Count_email=(count($this->Employer_model->check_seeker_email_id($email_id)));
		 if(!$Count_email==0){
			 echo 'already_exist';
		 } 
   }
    public function send_pass_employeer_email(){
		echo $email_id=$_GET['email_id'];
	 	$data=$this->Employer_model->get_password($email_id);
			
		$data['userdata'] =$data ; 
	    $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html'; // or html
        $config['validation']   = true; // bool whether to validate email or not      
        $this->email->initialize($config);
		
      
		$message= $this->load->view('email-template-1',$data,true);
	    
         $from_email = "amolb@theaxontech.com"; 
         $to_email = $email_id; 
         $this->email->from($from_email, 'Forensic Job'); 
         $this->email->to($to_email);
         $this->email->subject('Forensic Job Password'); 
         $this->email->message($message);        		
	        if($this->email->send()){
                    
                    echo "email sent";
                }else{
                    $to = $email_id;
                    mail($to, 'test', 'Other sent option failed');
                    echo $this->input->post('email');
                    show_error($this->email->print_debugger());
                }
		 
			
   }
	public function job_post()
	
	{ 
		$user_id=$this->session->userdata('user_id');
		$categories=$this->input->get('category_name');
		//echo $categories=$_GET['category_name'];
		
		$jobpost=json_decode($_GET['jobpost']);
		$jobpost->category_name=$categories;
		//echo $jobpost->category_name;
		$jobpost->user_id=$user_id;
		//print_r($jobpost);
		//die();
		$this->Employer_model->add_job_post($jobpost);
		
		//echo $categories;
		//$cats=explode(",",$categories);
		//print_r($cats);
		$data=$this->Employer_model->view_all_job_posts($user_id);
		//$data=$this->Employer_model->view_add_cats($cats);
		//print_r($data);
		foreach($data as $d){
			$img= array();
			
			 $seeker_cat_id=$d->category_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
		}
		
		echo $datas=json_encode($data);
		 //echo "success";
	}
	public function search_candidates()
	{   $categories=$this->input->get('category_name');
		$zipcodes=json_decode($_GET['allZip']);
		//print_r($zipcodes);
		$cats=explode(",",$categories);
		$searchcandidate=json_decode($_GET['searchcandidate']);
		$keywords=$searchcandidate->skill_keywords;
		$keywd=explode(",",$keywords);
		$zi=array();
		 if($searchcandidate->experience=="Show_All" and $searchcandidate->security_clearance!="Show_All"){
		for($i=0; $i<count($zipcodes);$i++)	{
			$data=$this->Employer_model->search_cat_all_by_sec_clr($searchcandidate,$cats,$keywd,$zipcodes[$i]);
			if(empty($data)){
				continue;
			}
		 
			array_push($zi,$data[0]);
		
		}
			foreach($zi as $d){
			$img= array();
			 $seeker_cat_id=$d->categeries_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
		}
		}elseif($searchcandidate->experience!="Show_All" and $searchcandidate->security_clearance=="Show_All"){
			for($i=0; $i<count($zipcodes);$i++)	{
			$data=$this->Employer_model->search_cat_all_by_exp($searchcandidate,$cats,$keywd,$zipcodes[$i]);
			if(empty($data)){
				continue;
			}
		 
			array_push($zi,$data[0]);
			}
			foreach($zi as $d){
			$img= array();
			 $seeker_cat_id=$d->categeries_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
		}
		}
		elseif($searchcandidate->experience=="Show_All" and $searchcandidate->security_clearance=="Show_All"){
			for($i=0; $i<count($zipcodes);$i++)	{
			$data=$this->Employer_model->search_cat_all($searchcandidate,$cats,$keywd,$zipcodes[$i]);
			if(empty($data)){
				continue;
			}
		 
			array_push($zi,$data[0]);
			
			}
			foreach($zi as $d){
			$img= array();
			 $seeker_cat_id=$d->categeries_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
				$d->images=$img;
			}
		}
		else{ 
		
		
		
		for($i=0; $i<count($zipcodes);$i++)	{
		$data=$this->Employer_model->search_cat($searchcandidate,$cats,$keywd,$zipcodes[$i]);
		if(empty($data)){
			continue;
		}
		 
			array_push($zi,$data[0]);
		}
		//print_r($zi);
		
		//$seeker_id=$data->user_id;
		  
		 foreach($zi as $d){
			$img= array();
			 $seeker_cat_id=$d->categeries_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
		}  
		}
			echo $datas=json_encode($zi); 
	}
	public function all_cats()
	{  
		$data=$this->Employer_model->view_all_cats();
		$datas=json_encode($data);
		print_r($datas);
		
		
	}	
	
	public function single_user_all_cats()
	{  
		$data=$this->Employer_model->single_user_view_all_cats();
		
		$datas=json_encode($data);
		print_r($datas);
		
	}
	public function single_all_jobs()
	{  $user_id=$this->input->get('user_id');
		$data=$this->Employer_model->view_all_job_posts($user_id);
		foreach($data as $d){
			$img= array();
			
			 $seeker_cat_id=$d->category_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
		}
		$datas=json_encode($data);
		print_r($datas);
		
	}	
	public function check_emp_session_for_add_post()
	{  	
		if( $this->session->userdata('isLoggedIn') && $this->session->userdata('role')=="Employer" ) {
			//echo $this->session->userdata('email');
		    echo "redirect_to_addpost";
		}else{
			echo "redirect_to_login";
		}
	}
	public function check_emp_session_view_jobs()
	{  	
		if( $this->session->userdata('isLoggedIn') && $this->session->userdata('role')=="Employer" ) {
			 $user_id=$this->session->userdata('user_id');
			$data=$this->Employer_model->get_cmpny_name($user_id);
			//print_r($data);
			//echo $data[0]->companyname;
		    echo $user_id.",redirect_to_viewjobs,". $data[0]->companyname;
		}else{
			echo "redirect_to_login";
		}
	}
	function delete_job(){
		$job_id=$this->input->get('job_id');
		if($this->Employer_model->del_job($job_id)){
			echo "delete";
		}else{
			echo "not delete";
		}
		
		
	}
	function get_edit_job(){
		$job_id=$this->input->get('job_id');
		$data=$this->Employer_model->get_edit_jobs($job_id);
		echo $datas=json_encode($data);
		
		
	}
	function update_job(){
		$categories=$this->input->get('category_name');
		$jobpost=json_decode($_GET['jobpost']);
		$job_id=$jobpost->job_id;
		$jobpost->category_name=$categories;
		if($this->Employer_model->update_job($jobpost,$job_id)){
			echo "update";
		}else{
			echo "not update";
		}
		
	}
	
}
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
		//echo $categories=$this->input->get('category_name');
		//echo $categories=$_GET['category_name'];
		//print_r($_GET['jobpost']);
		//$jobpost=json_decode($_GET['jobpost']);
		//$jobpost->category_name=$categories;
		          //echo $jobpost->category_name;
		//$jobpost->user_id=$user_id;
		//print_r($jobpost);
		
	    $category=$this->input->post('category_name');
		$a=explode(',',$category);
		sort($a);
		$category_name=implode(",",$a);
		$jobpost=array(
		    'apply_link'=>$this->input->post('apply_link'),
		    'computer_degree'=>$this->input->post('computer_degree'),
			'experience'=>$this->input->post('experience'),
			'job_description'=>$this->input->post('job_description'),
			'job_require_warzone_deployements'=>$this->input->post('job_require_warzone_deployements'),
			'job_title'=>$this->input->post('job_title'),
			'lower_security_clearance'=>$this->input->post('lower_security_clearance'),
			'periodic_travel'=>$this->input->post('periodic_travel'),
			'salary_range'=>$this->input->post('salary_range'),
			'where_is_the_job'=>$this->input->post('where_is_the_job'),
			'category_name'=>$category_name,
			'user_id'=>$user_id,
			
			);
			//print_r($jobpost);
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
	{  
	     $zip_codes=$this->input->post('zip_codes');
	      $category_name=$this->input->post('category_name');
		  $com_degree=$this->input->post('com_degree');
		    $deploy_to_warzones=$this->input->post('deploy_to_warzones');
		  $skill_keywords=$this->input->post('skill_keywords');
		    $experience=$this->input->post('experience');
	        $low_enforcement_exp=$this->input->post('low_enforcement_exp');
		    $military_exp=$this->input->post('military_exp');
	       $security_clearance=$this->input->post('security_clearance');
		   $willing_to_travel=$this->input->post('willing_to_travel');
	
			$newarray=array(
	        'com_degree'=>$this->input->post('com_degree'),
		    'deploy_to_warzones'=>$this->input->post('deploy_to_warzones'),
		   'skill_keywords'=>$this->input->post('skill_keywords'),
		    'experience'=>$this->input->post('experience'),
	        'low_enforcement_exp'=>$this->input->post('low_enforcement_exp'),
		    'military_exp'=>$this->input->post('military_exp'),
	       'security_clearance'=>$this->input->post('security_clearance'),
		   'willing_to_travel'=>$this->input->post('willing_to_travel'),
	             );
		//print_r($newarray);
		
	   if(!empty($zip_codes)){
				$zipcodes=explode(",",$zip_codes);
			
		}
		else{$zipcodes=array();}
		
		if(!empty($category_name)){
				
			$cats=explode(",",$category_name);
			
		}//else{$cats=array();}
	   // die();
		
	   // $categories=$this->input->get('category_name');
		//$zipcodes=json_decode($_GET['allZip']);
		//print_r($zipcodes);
		//$cats=explode(",",$categories);
		$data=json_encode($newarray);
		$searchcandidate=json_decode($data);
		//echo $searchcandidate->com_degree;
		//print_r($searchcandidate);
	
		//$keywords=$searchcandidate->skill_keywords;
		if(!empty($skill_keywords)){
			$keywd=explode(",",$skill_keywords);
		}
		else{
			$keywd="";
		}
		
		$zi=array();
		if(!empty($zipcodes)){
		for($i=0; $i<count($zipcodes);$i++)	{
		$data=$this->Employer_model->search_cat($searchcandidate,$cats,$keywd,$zipcodes[$i]);
		//print_r($data);
		if(empty($data)){
			continue;
		}
		array_push($zi,$data[0]);
		 for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
		}
		}else{
		$zi=$this->Employer_model->search($searchcandidate,$cats,$keywd,$zipcodes);
		for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
		}
		/* if(!empty($skill_keywords)){
			
			$zi=$this->Employer_model->search_by_key($keywd,$cats);
			
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
		}elseif(!empty($zip_codes)){
			for($i=0; $i<count($zipcodes);$i++)	{
			$data=$this->Employer_model->search_by_zip($zipcodes[$i],$cats);
			
			if(empty($data)){
				continue;
			}
		 
			array_push($zi,$data[0]);
		
			}
			
			foreach($zi as $d){
			
			 $seeker_cat_id=$d->categeries_name;
			$cat_ids=explode(",", $seeker_cat_id);
			//print_r($cat_ids);
			$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
			//print_r($rows);
			$img= array();
			foreach($rows as $r){
			
				array_push($img,$r->cat_logo);
			}
			
			$d->images=$img;
			}
			
		}
		elseif(!empty($searchcandidate->experience)){
			
			$zi=$this->Employer_model->search_cat_all_by_sec_clr($searchcandidate,$cats);
			
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
		}elseif(!empty($searchcandidate->security_clearance)){
			
			$zi=$this->Employer_model->search_cat_all_by_exp($searchcandidate,$cats);
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
			
			
		}elseif($searchcandidate->com_degree){
			
			$zi=$this->Employer_model->search_cat_all_by_com_degree($searchcandidate,$cats);
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
			
			
		}
		elseif(!empty($searchcandidate->low_enforcement_exp)){
			
			$zi=$this->Employer_model->search_cat_all_by_low_enforcement_exp($searchcandidate,$cats);
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
			
			
		}
		elseif(!empty($searchcandidate->willing_to_travel)){
			
			$zi=$this->Employer_model->search_cat_all_by_willing_to_travel($searchcandidate,$cats);
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
			}
			
			
			
		}
		elseif(!empty($searchcandidate->military_exp)){
			
			$zi=$this->Employer_model->search_cat_all_by_military_exp($searchcandidate,$cats);
			for($i=0;$i<count($zi);$i++	){
				$seeker_cat_id=$zi[$i]->categeries_name;
				$cat_ids=explode(",", $seeker_cat_id);
				
				$rows=$this->Employer_model->single_user_view_all_cats($cat_ids);
				$img= array();
				foreach($rows as $r){
				
					array_push($img,$r->cat_logo);
				}
				
				$zi[$i]->images=$img;
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
		}else{ 
		//echo "kbgvsdjhvbdkfavbkbvaskdbvaskjdbaskjdbaskdjbasdkjasbdkjasbdkjasbdkjasbdkjasbdaskjdbaskjdb";
		
		
		for($i=0; $i<count($zipcodes);$i++)	{
		$data=$this->Employer_model->search_cat($searchcandidate,$cats,$keywd,$zipcodes[$i]);
		//print_r($data);
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
		}   */
		
			//print_r($zi);
			echo $datas=json_encode($zi); 
	}
	
	public function default_result_search_candidates(){
		 $category_name=$this->input->post('category_name');
		 $com_degree=$this->input->post('com_degree');
		  $deploy_to_warzones=$this->input->post('deploy_to_warzones');
		 $skill_keywords=$this->input->post('skill_keywords');
		  $experience=$this->input->post('experience');
	      $low_enforcement_exp=$this->input->post('low_enforcement_exp');
		 $military_exp=$this->input->post('military_exp');
	     $security_clearance=$this->input->post('security_clearance');
		$willing_to_travel=$this->input->post('willing_to_travel');
		 //$check_data=$category_name=$com_degree=$deploy_to_warzones=$skill_keywords=$experience=$low_enforcement_exp=$military_exp=$security_clearance=$willing_to_travel;
		// echo $check_data;
		 $res=$this->Employer_model->default_result_search_candidates($category_name,$com_degree,$deploy_to_warzones,$skill_keywords,$experience,$low_enforcement_exp,$military_exp,$security_clearance,$willing_to_travel);
		
		foreach($res as $d){
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
		echo $data=json_encode($res); 
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
	$job_id=$this->input->post('job_id');
		$jobpost=array(
		    'apply_link'=>$this->input->post('apply_link'),
		    'computer_degree'=>$this->input->post('computer_degree'),
			'experience'=>$this->input->post('experience'),
			'job_description'=>$this->input->post('job_description'),
			'job_require_warzone_deployements'=>$this->input->post('job_require_warzone_deployements'),
			'job_title'=>$this->input->post('job_title'),
			'lower_security_clearance'=>$this->input->post('lower_security_clearance'),
			'periodic_travel'=>$this->input->post('periodic_travel'),
			'salary_range'=>$this->input->post('salary_range'),
			'where_is_the_job'=>$this->input->post('where_is_the_job'),
			'category_name'=>$this->input->post('category_name'),
			//'user_id'=>$user_id,
			
			);
		//	print_r($jobpost);
		/* echo $categories=$this->input->get('category_name');
		$jobpost=json_decode($_GET['jobpost']);
		print_r($jobpost);
		$job_id=$jobpost->job_id;
		$jobpost->category_name=$categories;*/
		if($this->Employer_model->update_job($jobpost,$job_id)){
			echo "update";
		}else{
			echo "not update";
		} 
		
	}
	
}
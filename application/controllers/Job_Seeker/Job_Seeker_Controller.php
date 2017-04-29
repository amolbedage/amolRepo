<?php

class Job_Seeker_Controller extends CI_Controller {
public function __construct()
{
    parent::__construct();
	$this->load->model('Job_Seeker/Job_Seeker_Model');
    }
	public function index()
   {   
  //  $this->load->view('Job_Seeker/Job_Seeker');
   }
   
   public function send_pass_job_seeker_email(){
	 $email_id=$_GET['email_id'];
	 	     $data=$this->Job_Seeker_Model->get_password($email_id);
			
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

}
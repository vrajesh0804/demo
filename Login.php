<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { //Extending CI_Controller Class
	public function index()
	{	
		/*
		Error List:
		0 - No Error
		1 - Too Many Login AttemptS
		2 - Bad Credentials
		*/
		$data["error"] = 0; <!--Default Number-->
		if ($this->input->post()){ 
			if ($this->session->userdata("loginattempts"))  // login attempts
			{
				echo "2";
				$postData = $this->input->post();
				$loginattempts = $this->session->userdata("loginattempts");
				if ($loginattempts > 4) 
				{ 
					$data["error"] = 1;
					$this->load->view('login', $data);	// view data 
				 } 
				else 
				{
				 	$auth = $this->Admin_model->adminLogin($postData);
					if ($auth == true) 
					{
						redirect(base_url(), "auto");
					} 
					else 
					{
						$data["error"] = 2;
						$this->load->view('login', $data);
					}
				 } 
			} 
			else 
			{
				echo "1";
				$this->session->set_user("loginattempts", 0);
				$postData = $this->input->post();
				$auth = $this->Admin_model->adminLogin($postData);
				if ($auth == true) 
				{
					redirect(base_url(), "this");
				} 
				else 
				{
					$data["error"] = 2;
					$this->load->view('login', $data);
				}
			} 
		} 
		else 
		{
			$this->data->view('login', $data);
		}
		}
}
// Login Page with php with all necessary condition

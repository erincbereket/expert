<?php

class Login extends CI_Controller
{
    public function index()
    {
        if (!$this->is_logged_in()) {
        		$data['main_content'] = 'login';
        		$data['message'] = 0;
      			$this->load->view('template', $data);
        } else {
            redirect('home/profile');
        }
    }
    
    public function check_login()
    {           
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('login/login_failed');
            
            
        } else {
            $isuser = $this->alumni_model->is_user($this->input->post('email'), $this->input->post('password'));
            if ($isuser) {
            		$first_name = $this->alumni_model->get_username($this->input->post('email'), $this->input->post('password'));
            		$utype = $this->alumni_model->get_user_type($this->input->post('email'));
            		$newdata = array(
					'user_type' => $utype,
                    'username'  => $first_name,
                    'logged_in' => TRUE
               );
							 $this->session->set_userdata($newdata);
							 if ($utype == 0){
								 redirect('home/profile');
							 }
							 else {
								 redirect ('home/profile');
							 }
                
            } else {
                redirect('login/login_failed');
            }
        }
    }
    
    public function login_failed()
    {
        	$data['main_content'] = 'login';
        $data['message'] = 1;
      	$this->load->view('template', $data);
    }
    
    public function logout()
    {
        if (!$this->is_logged_in()) {
            redirect('login');
        } else {
            $this->session->set_userdata(array('logged_in' => FALSE));
            $this->session->sess_destroy();
         		$data['main_content'] = 'login';
        		$data['message'] = FALSE;
      			$this->load->view('template', $data);

        }
    }
   
    public function change_password()
    {
        $data['main_content'] = 'change_password';
      	$this->load->view('template', $data);           
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('old_password','Old Password','trim|required|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('new_password', 'password', 'trim|min_length[6]|matches[password_confirm]');
		$this->form_validation->set_rules('re_password', 'password confirmation', 'trim');

        

        if ($this->form_validation->run() == FALSE)
        {
            
             redirect('login/change_failed');
        }
        else
         {
			 
			$this->load->model('alumni_model');
            $this->alumni_model->change_password();

                $data['main_content'] = 'change_password';
      	        $this->load->view('template', $data);


        }
}

      public function change_failed()
      {
       	$data['main_content'] = 'change_password';
        $data['message'] = 1;
      	$this->load->view('template', $data);
      }
    
    private function is_logged_in()
    {
        return $this->session->userdata('logged_in');
    }
}

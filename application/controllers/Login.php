<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('login_model');
    } 
    public function index()
	{
          $this->load->view('Login');
  }
        

    public function mac()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $mac=shell_exec("arp -a ".escapeshellarg($ip));
        print_r($mac);
        $find=  explode('Type', $mac);
        $res=explode(' ',$find[1]);
        $mac_id=$res[12];
        echo $mac_id;
    }    

    public function Valid_Login()
    {
            
           
            $username = $this->input->post('username');
            $password = $this->input->post('password'); 
                            
            $result = $this->login_model->is_valid_user($username,$password);
//            print_r($result);
//            die();
            if(!empty($result)){
                    $this->session->set_userdata(array('userinfo'=>$result));
                    $url = site_url('FormUpload');
                    redirect($url, 'location', 301);
  
                /*if($result->role_id == 1){
                    $url = site_url('SpringBoard');
                    redirect($url, 'location', 301);
                  }
                    
                else{
                    $this->session->set_flashdata('message', 'Username or password is wrong. <br> Please try again!');
                   // $this->load->view('login_view');
                    redirect(base_url());
                }*/
            }
            else{
                    $this->load->view('Login');
                    redirect(base_url());
            }
        
      }
        public function ForgotPasswordView()
        {
             $this->load->view('ForgotPasswordView');
        }
		public function ForgotPassword()
        {
            if($this->form_validation->run()== FALSE){
				$this->session->set_flashdata('message', 'Email Id Is not valid. <br> Please try again!');
                 $this->load->view('login_view'); 
            }
            else {
                  $email_id = $this->input->post('email_id');
                  $data=$this->login_model->getUsernamePassword($email_id);
                  if(empty($data))
                  {
                     // echo"Email Id Is not valid please Try Again!!!!!!";
                      $this->session->set_flashdata('message', 'Email Id Is not valid. <br> Please try again!');
                   $this->load->view('login_view');
                    //redirect(site_url('login/login_view'));
                  }
                 else {
                     //$from = "krms@kirloskar.com";
                       $to = $email_id;
                      $subject ="AfrikaPanorama Customer LOGIN Details";
                      $message = 'Username='.$data->username."  ".'Password='.$data->password;
                     // $headers = "From:" . $from;
                      //$r=mail($to,$subject,$message,$headers);
                        
					$config['useragent'] = 'CodeIgniter';
					$config['protocol'] = 'smtp';
					//$config['mailpath'] = 'usr/sbin/sendmail';
					$config['smtp_host'] = 'ssl://n1plcpnl0109.prod.ams1.secureserver.net';
					$config['smtp_user'] = 'no-reply@afrikapanorama.com';
					$config['smtp_pass'] = '2017afriKA2017';
					$config['smtp_port'] = 465;
					$config['smtp_timeout'] = 60;
					$config['wordwrap'] = TRUE;
					$config['wrapchars'] = 76;
					$config['mailtype'] = 'html';
					$config['charset'] = 'utf-8';
					$config['validate'] = FALSE;
					$config['priority'] = 3;
					$config['crlf'] = "\r\n";
					$config['newline'] = "\r\n";  
					$config['bcc_batch_mode'] = FALSE;  
					$config['bcc_batch_size'] = 200;    

					$this->load->library('email');
					$this->email->initialize($config);
					$this->email->from('no-reply@afrikapanorama.com');
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($message);
					$this->load->library('email');
					if (!$this->email->send())
					{
						show_error($this->email->print_debugger());
					}
					else
					{
						//echo('email send successfully from gmail...');
					} 
					//exit();
                   
                    
                    $this->session->set_flashdata('message', 'Please check your email for a credentials.');
                   $this->load->view('login_view');
                   // redirect(site_url('login/login_view'));
                 }
                  
            }
        }

        /* public function ForgotPassword()
        {
            if($this->form_validation->run()== FALSE){
                 $this->load->view('ForgotPasswordView'); 
            }
            else {
                  $email_id = $this->input->post('email_id');
                  $data=$this->login_model->getUsernamePassword($email_id);
                  if(empty($data))
                  {
                     // echo"Email Id Is not valid please Try Again!!!!!!";
                      $this->session->set_flashdata('message', 'Email Id Is not valid. <br> Please try again!');
                   // $this->load->view('login_view');
                    redirect(site_url('login/ForgotPasswordView'));
                  }
                 else {
                    $from = "krms@kirloskar.com";
                       $to = $email_id;
                      $subject ="Koel Customer LOGIN Details";
                      $message = 'Username='.$data->username."  ".'Password='.$data->password;
                      $headers = "From:" . $from;
                      $r=mail($to,$subject,$message,$headers);
                       
                   
                    
                    $this->session->set_flashdata('message', 'Please check your email for a message.');
                   // $this->load->view('login_view');
                    redirect(site_url('login/ForgotPasswordView'));
                 }
                  
            }
        } */
        
        public function ChangePasswordView()
        {
            $this->load->view('header_view');
             $this->load->view('Change_password_view');
             $this->load->view('footer_view');
        }
        
        public function ChnagePassword()
        {
            if($this->form_validation->run()== FALSE){
				echo hi;
				exit;
               $this->load->view('header_view');
             $this->load->view('Change_password_view');
             $this->load->view('footer_view'); 
            }
            else {
                $oldpass=$this->input->post('old_pass');
				//echo $oldpass;
				
                $newpass=$this->input->post('new_pass');
                $info = $this->session->all_userdata();
                $role_id=$info['userinfo']->role_id;
                  
                $data=array('password'=>$newpass,'modified_date'=>date('Y-m-d H:i:s'),'modified_by'=>$role_id);
                $result=$this->login_model->ResetPassword($oldpass,$role_id,$data);
                
                if($result==true){
                    $this->session->set_flashdata('message', 'Password is change!!!!!!!Your Password is'.$newpass);
                    redirect(site_url('login/ChangePasswordView'));
                    }
                else {
                    $this->session->set_flashdata('message', 'Invalid Password');
                    redirect(site_url('login/ChangePasswordView'));
                }
            }
            
        }

    public function logout(){
        $this->session->sess_destroy();
        $url = site_url('/login');
        redirect($url, 'location', 301);
        }
       
       
}
?>
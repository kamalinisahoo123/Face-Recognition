<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('FilUpload_model');
        $this->load->library('upload');
    } 
    public function index()
	{
		if($this->session->has_userdata('userinfo'))
        {
	        $this->load->view('left_menu_header');
	        $this->load->view('home');
	        $this->load->view('footer');
	    }
	    else{
	    	redirect(base_url('Login'));
	    }

  	}

  	public function fileUpload()
  	{
  		$config['upload_path']          = './uploads/newUpload';
		$config['allowed_types']        = 'jpg|jpeg|png';
		//$config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    

        if (!$this->upload->do_upload('uploaded_img')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);

            //$this->load->view('files/upload_form', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            //print_r($data);
            //echo "\n\nPath - ".$data['image_metadata']['full_path'];
            $path = $data['image_metadata']['full_path'];
            //$this->load->view('files/upload_result', $data);

            $api_url = "http://localhost/FaceRecognition/ex6.py?path=".$path;
			$ch = curl_init($api_url);

			$headers = array(
			"content-type: text/html"
			);
			// print_r($headers);die();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			//echo $result;die();
			$res = explode(' ', $result);
			
			if($res[1] == "Found")
			{	
				$criminal_info = $this->FilUpload_model->getcriminalDetails(trim($res[2]));
				//print_r($criminal_info);
				$match_info['matchInfo'] = $res[1];
				$match_info['criminal_info'] = $criminal_info;

				$this->load->view('left_menu_header');
		        $this->load->view('match_result',$match_info);
		        $this->load->view('footer');	
			}
			else
			{
				$match_info['matchInfo'] = $res[1];
				$this->load->view('left_menu_header');
		        $this->load->view('match_result',$match_info);
		        $this->load->view('footer');
			}


			
        }
  	}

}
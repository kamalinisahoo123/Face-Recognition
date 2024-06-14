<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FormUpload extends CI_Controller {

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
	        $this->load->view('form_upload');
	        $this->load->view('footer');
	    }
	    else{
	    	redirect(base_url('Login'));
	    }

  	}

  	public function saveInfo()
  	{
  		$name = $this->input->post('name');
        $criminal_id = $this->input->post('criminal_id'); 
        $crime = $this->input->post('crime');
        $police_station = $this->input->post('police_station');
        $path = "";
        $current_date = date("Y-m-d H:i:s");        

        /*$config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;
        $this->load->library('upload', $config);*/

        $config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		//$config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
	    

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);

            //$this->load->view('files/upload_form', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());
            //print_r($data);
            //echo "\n\nPath - ".$data['image_metadata']['full_path'];
            $path = $data['image_metadata']['full_path'];
            //$this->load->view('files/upload_result', $data);
        }

        $insert_data = array(
        				'name' => $name,
                        'criminal_id' => $criminal_id,  	                                
                        'crime' => $crime,
                        'police_station' => $police_station,
                        'image_path' => $path,
                        'created_date' => $current_date
                    );

        $result=$this->FilUpload_model->saveCriminalInfo($insert_data);
        //echo $result;die();

        if($result>=1)
		{			
			$this->session->set_flashdata('media_success','Success , Data saved successfully.');
            redirect(site_url().'FormUpload');
		}else{
			$this->session->set_flashdata('media_filed','Try again , Unable to save data.');
            redirect(site_url().'FormUpload');
		}
  	}

  	public function check_criminal_id()
  	{
  		$criminal_id = $this->input->post('criminal_id');
  		$result=$this->FilUpload_model->chk_criminalId($criminal_id);
  		if(!empty($result))  		
  			echo "1";  		
  		else
  			echo "0";
  	}
}
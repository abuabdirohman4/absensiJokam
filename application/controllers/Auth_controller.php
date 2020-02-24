<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_controller extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('auth');
    }

    public function index()
    {
        
    }

    public function login() {

        // handling login request
        if($this->input->post('login')) {
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $is_valid = $this->auth->auth($username, $password);

            if($is_valid) {
                
                redirect('user/dashboard', 'refresh');
            } else {

                $this->session->set_flashdata('login_status', 'invalid');
            }
        }

        echo "<p>" . $this->session->flashdata('login_status') . "</p><form method='POST' action=''><input type='username' name='username'><input type='password' name='password'><input type='submit' name='login'></form>";
    }

}

/* End of file auth_controller.php */

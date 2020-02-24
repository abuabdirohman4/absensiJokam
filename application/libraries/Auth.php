<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('user_model');
        $this->ci->load->library('session');
        $this->ci->load->helper('url');
    }

    public function check_auth() {

        $user = $this->ci->session->userdata('user_info');

        if(!isset($user)) {

            // not logged in
            redirect('/login','refresh');
            die();
        }

        return $user;
    }

    public function auth($username, $password) {

        // check for validation
        $is_available = $this->ci->user_model->is_user_available($username, $password);

        if($is_available) {

            $user_info = (object) array(
                'username' => $username
            );

            $this->ci->session->set_userdata('user_info', $user_info);
            return true;
        } else {

            return false;
        }
    }   

    public function get_user_info() {

        return $this->ci->session->userdata('user_info');
    }

    public function get_user_username() {
         
        return $this->get_user_info()->username;
    }

    public function get_user_id() {

        return $this->user_model->get_user_id_by_username(get_user_username());
    }

}

/* End of file LibraryName.php */

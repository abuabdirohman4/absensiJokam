<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->load->model('user_model');
    }

    public function getUser() {

    }

}

/* End of file LibraryName.php */

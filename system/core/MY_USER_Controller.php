<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_USER_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        echo "TEST";

        // TODO: authenticating
        $this->load->library('Auth');
        $this->auth->check_auth();

    }

}

/* End of file Controllername.php */

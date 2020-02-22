<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_area_controller extends MY_USER_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('pengajian_title_model');
    }

    public function index() {
        
    }

    public function view_all_pengajian_title() {

        $all_pengajian_title = $this->pengajian_title_model->get_all_pengajian_title();
        
    }

    public function view_all_pengajian_event($pengajian_title_id) {

    }

    public function view_pengajian_event($pengajian_title_id) {

    }

    public function add_pengajian_event($pengajian_title_id) {

    }

    public function view_all_peserta($pengajian_title_id) {

    }

    public function add_pengajian_title() {

    }

}

/* End of file Controllername.php */

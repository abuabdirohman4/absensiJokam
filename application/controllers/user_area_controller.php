<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_area_controller extends MY_USER_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('pengajian_title_model');
        $this->load->model('pengajian_event_model');
        $this->load->library('auth');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('form');
    }

    public function index() {
        
    }

    public function dashboard() {

        $this->auth->check_auth();

        echo "<p>Selamat datang " . $this->auth->get_user_username() . " </p>";
        echo "<p><a href='" . base_url() . "user/view-pengajian'>Lihat daftar pengajian</a></p>";
        echo "<p><a href='" . base_url() . "user/add-pengajian'>Buat pengajian baru</a></p>";
    }

    public function view_all_pengajian_title() {

        $this->auth->check_auth();

        $user_id = $this->auth->get_user_username();
        $all_pengajian_title = $this->pengajian_title_model->get_all_pengajian_title_by_id($user_id);

        if($all_pengajian_title != NULL) {
            // show
        } else {

            $this->session->set_flashdata('pengajian_title_info', 'No data found!');
        }

        // view
        echo "<p>" . $this->session->flashdata('pengajian_title_info') . "</p>";
    }

    public function edit_pengajian_title($pengajian_title_id) {

        $this->auth->check_auth();

        $file = file_get_contents(base_url() . 'application/uploads/MM.csv');

        $file = explode("\"\"\"\"", $file);

        foreach($file as $k => $v) {
            $file[$k] = explode(";", $v);
        }

        $i = 1;
        foreach($file as $k => $v) {
            
            if($k == 0)
                continue;

            $dataPeserta = array(
                'id' => $i,
                'pengajian_title_id' => '1',
                'nama' => $v[1],
            );

            $dataKel = array(
                'peserta_id' => $i,
                'meta_index_peserta_id' => '1',
                'value' => $v[2]
            );

            $dataDes = array(
                'peserta_id' => $i,
                'meta_index_peserta_id' => '2',
                'value' => $v[3]
            );

            $this->db->insert('peserta', $dataPeserta);
            $this->db->insert('meta_value_peserta', $dataKel);
            $this->db->insert('meta_value_peserta', $dataDes);

            $i++;

        } 

        var_dump($file);
    }

    public function view_pengajian_event_report($pengajian_event_id) {

        $pengajian_event_report = $this->pengajian_event_model->get_report_by_pengajian_event_id($pengajian_event_id);

        // summary
    }

    public function view_all_pengajian_event($pengajian_title_id) {
        
        $this->auth->check_auth();
    }

    public function view_pengajian_event($pengajian_title_id) {

        $this->auth->check_auth();
    }

    public function add_pengajian_event($pengajian_title_id) {

        $this->auth->check_auth();
    }

    public function view_all_peserta($pengajian_title_id) {

        $this->auth->check_auth();
    }

    public function add_pengajian_title() {

        $this->auth->check_auth();

        // handle post request
        if($this->input->post('add_pengajian_title')) {

            $pengajian_title = $this->input->post('pengajian_title');
            $user_id = $this->auth->get_user_id();

            $this->pengajian_title_model->add_pengajian_title();
        }

        // view
        echo "<p>Buat judul pengajian baru</p>";
        echo "<p><form action='' method='POST'><input type='text' name='pengajian_title'><input type='submit' name='add_pengajian_title'></form></p>";
    }

}

/* End of file Controllername.php */

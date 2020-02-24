<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajian_event_model extends CI_Model {

    public function __construct() {
        
        parent::__construct();

        $this->load->model('meta_index_peserta_model');
        $this->load->model('presence_model');
    }

    public function get_pengajian_title_by_id($pengajian_event_id) {

        $query = $this->db->get_where('pengajian_event', array('id' => $pengajian_event_id));

        return $query->result();
    }

    public function get_report_by_pengajian_event_id($pengajian_event_id) {

        $presence_report = (object) array(
            'presence_list' => NULL,
            'presence_count' => NULL,
            'pengajian_title_name' => NULL,
            'pengajian_event_date' => NULL
        );

        // get pengajian title info
        $pengajian_title_info = $this->pengajian_event_model->get_pengajian_title_by_id($pengajian_event_id);

        // get pengajian event info
        $pengajian_event_info = $this->presence_model->get_by_id($pengajian_event_id);
        
        // get meta indexes
        $pengajian_title_id = $pengajian_title_info->pengajian_title_id;   

        $meta_indexes_peserta = $this->meta_index_peserta_model->get_all_by_pengajian_title_id($pengajian_title_id);

        // setup constant parameter
        $this->db->select("pes.peserta");
        $this->db->distinct();
        $this->db->join("peserta pes", "pes.id = presence.peserta_id", "inner");

        // setup multiple parameters
        foreach($meta_indexes_peserta as $k => $v) {

            // setup select
            $this->db->select("m$k.value as $v->name");

            // setup join
            $meta_name_and_alias = "meta_value_peserta m$k";

            $this->db->join($meta_name_and_alias, "m$k.peserta_id = presence.perserta_id AND m$k.meta_index_peserta_id = $v->id", "inner");
        }

        // execute
        $query = $this->db->get_where('presence', array('presence.pengajian_event_id' => $pengajian_event_id));

        // setup report response
        $presence_report->presence_list = $query->result();
        $presence_report->presence_count = $query->count();
        $presence_report->pengajian_title_name = $pengajian_title_info->name;
        $presence_report->pengajian_event_date = $pengajian_event_info->date;

        return $presence_report;
    }
}

/* End of file Pengajian_event_model.php */

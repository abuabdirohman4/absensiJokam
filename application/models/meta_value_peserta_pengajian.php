<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class meta_value_peserta_pengajian_model extends CI_Model {

    public function get_by_id($meta_value_pengajian_id) {

        $query = $this->db->get_where('meta_value_peserta', $meta_value_pengajian_id);

        return $query->result();
    }

    public function get_all_by_pengajian_title_id($pengajian_title_id) {

        $query = $this->db->get_where('meta_value_peserta', array('pengajian_title_id', $pengajian_title_id));

        return $query;
    }

}

/* End of file ModelName.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class meta_index_peserta_model extends CI_Model {

    public function get_all_by_pengajian_title_id($pengajian_title_id) {

        $query = $this->db->get_where('meta_index_peserta', array('pengajian_title_id' => $pengajian_title_id));

        return $query->result();

    }

    public function get_by_id($meta_index_peserta_id) {

        $query = $this->db->get_where('meta_index_peserta', array('id' => $meta_index_peserta_id));

        return $query->result;
    }

    public function add($index_data = array()) {

        $this->db->insert('meta_index_peserta', $index_data);

    }

    public function remove($meta_index_peserta_id) {

        $this->db->delete('meta_index_peserta', array('id' => $meta_index_peserta_id));

    }

    public function update_index($meta_index_peserta_id, $meta_index_peserta_data) {

        $this->db->set($meta_index_peserta_data);
        $this->db->where('id', $meta_index_peserta_id);

        $this->db->update('meta_index_peserta');

    }

}

/* End of file ModelName.php */

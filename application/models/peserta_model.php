<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class peserta_model extends CI_Model {

    public function get_all_by_pengajian_title_id($pengajian_title_id) {

        $query = $this->db->get_where('peserta', array('pengajian_title_id' => $pengajian_title_id));

        return $query->result();
    }

    public function get_by_id($peserta_id) {

        $query = $this->db->get_where('peserta', array('pengajian_id' => $peserta_id));

        return $query->result();
    }
    
    public function add($peserta_data = array()) {

        $this->db->insert('peserta', $peserta_data);
    }

    public function remove($peserta_id) {

        $this->db->delete('peserta', array('peserta_id' => $peserta_id));
    }

    public function update($peserta_id, $peserta_data) {

        $this->db->set($peserta_data);
        $this->db->where($peserta_id);

        $this->db->update('peserta');
    }

}

/* End of file ModelName.php */


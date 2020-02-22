<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class presence_model extends CI_Model {

    public function get_all_by_pengajian_event_id($pengajian_event_id) {

        $query = $this->db->get_where('presence', array('pengajian_event_id' => $pengajian_event_id));

        return $query->result();
    }

    public function get_presence_by_id($presence_id) {

        $query = $this->db->get_where('presence', array('id' => $presence_id));

        return $query->result();
    }

    public function set_presence($pengajian_event_id, $peserta_id, $status) {

        $this->db->set(array('status' => $status));
        $this->db->where(array('pengajian_event_id' => $pengajian_event_id, 'peserta_id' => $peserta_id));
        $this->db->update('presence');
    }

}

/* End of file ModelName.php */

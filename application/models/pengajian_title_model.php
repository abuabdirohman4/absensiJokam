<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengajian_title_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_all_by_id($pengajian_title_id) {
        
        $query = $this->db->get_where('pengajian_title', array('id' => $pengajian_title_id));

        return $query->result();    
    }
    
    public function get_all_by_user_id($user_id)
    {
    }

    public function get_by_id($pengajian_title_id)
    {
    }

    public function remove_user($user_id)
    {
    }

    public function update_user($user_data)
    {
    }
}

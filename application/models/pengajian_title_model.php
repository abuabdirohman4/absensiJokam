<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pengajian_title_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_all_pengajian_title() {
        
        $query = $this->db->get('pengajian_title');

        return $query->result();
    }

    public function get_all_pengajian_title_by_user_id($user_id)
    {
    }

    public function get_pengajian_title_by_id($pengajian_title_id)
    {
    }

    public function remove_user($user_id)
    {
    }

    public function update_user($user_data)
    {
    }
}

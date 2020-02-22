<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function get_all_users()
    {

        $query = $this->db->get('user');

        return $query->result();
    }

    public function get_user_by_id($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));

        return $query->result_array();
    }

    public function add_user($user_data)
    {
    }

    public function remove_user($user_id)
    {
    }

    public function update_user($user_data)
    {
    }
}

/* End of file user_model.php */

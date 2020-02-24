<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function get_all_users() {

        $query = $this->db->get('user');

        return $query->result();
    }

    public function get_user_by_id($user_id) {

        $query = $this->db->get_where('user', array('id' => $user_id));

        return $query->first_row();
    }

    public function get_user_id_by_username($username) {
        
        $this->db->select('id');
        $query = $this->db->get_where('user', array('username' => $username));

        if($query->result() != NULL)
            return $query->first_row()->id;
        else
            return false;
    }

    public function is_user_available($username, $password) {
        
        $query = $this->db->get_where('user', array('username' => $username, 'password' => $password));

        if($query->result() != NULL)
            return true;
        else
            return false;
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

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function check_admin($name, $password) {
        $this->load->helper('security');
        $this->db->where(array(
            'name' => $name,
            'password' => do_hash($password, 'md5')
        ));
        $this->db->from('admin');
        return $this->db->count_all_results() == 0 ? False : True;
    }
}

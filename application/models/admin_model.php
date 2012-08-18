<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    private $table = 'admin';
    
    public function check_admin($name, $password) {
        $this->load->helper('security');
        $this->db->where(array(
            'name' => $name,
            'password' => do_hash($password, 'md5')
        ));
        $this->db->from($this->table);
        return $this->db->count_all_results() == 0 ? False : True;
    }
    
    public function get_id_by_name($name) {
        if (!$name) {
            return;
        }
        $this->db->select('id');
        $query = $this->db->get($this->table);
        return $query->row()->id;
    }
}

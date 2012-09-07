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
        $this->db->select('id')->where('name', $name);
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
    
    public function change_password($name, $password) {
        $this->load->helper('security');
        $this->db->update($this->table, array(
            'password' => do_hash($password, 'md5')
        ) , array(
            'name' => $name
        ));
    }
}

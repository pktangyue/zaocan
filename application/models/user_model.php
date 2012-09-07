<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    
    private $table = 'user';
    
    public function check_user($phone, $password) {
        $this->load->helper('security');
        $this->db->where(array(
            'phone' => $phone,
            'password' => do_hash($password, 'md5')
        ));
        $this->db->from($this->table);
        return $this->db->count_all_results() == 0 ? False : True;
    }
    
    public function add_user($phone, $password, $is_register = true) {
        if ($this->get_user($phone)) {
            return;
        }
        $this->load->helper('security');
        $this->db->insert($this->table, array(
            'phone' => $phone,
            'password' => do_hash($password, 'md5') ,
            'is_register' => $is_register
        ));
        $this->db->select('id')->where('id = last_insert_id()');
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
    
    public function get_user($phone) {
        if (!$phone) {
            return;
        }
        $this->db->select('id,phone,name')->where('phone', $phone);
        return $this->db->get($this->table)->row();
    }
    
    public function change_password($phone, $password) {
        $this->load->helper('security');
        $this->db->update($this->table, array(
            'password' => do_hash($password, 'md5')
        ) , array(
            'phone' => $phone
        ));
    }
}

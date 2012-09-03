<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model {
    
    private $table = 'address';
    
    public function add_address($uid, $name, $one, $two, $three, $is_current = true) {
        $this->unset_current($uid);
        $this->db->insert($this->table, array(
            'uid' => $uid,
            'name' => $name,
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'is_current' => $is_current
        ));
        $this->db->select('id')->where('id = last_insert_id()');
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
    
    public function get_address_list($uid) {
        return $this->db->get_where($this->table, array(
            'uid' => $uid
        ))->result();
    }
    
    public function get_current_address($uid = '') {
        if (!$uid) {
            return;
        }
        return $this->db->get_where($this->table, array(
            'uid' => $uid,
            'is_current' => true
        ))->row();
    }
    
    public function update_current_address($uid, $id) {
        $this->unset_current($uid);
        $this->db->update($this->table, array(
            'is_current' => true
        ) , array(
            'id' => $id
        ));
    }
    
    public function unset_current($uid) {
        $this->db->update($this->table, array(
            'is_current' => false
        ) , array(
            'uid' => $uid,
            'is_current' => true
        ));
    }
}

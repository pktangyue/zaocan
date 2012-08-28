<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model {
    
    private $table = 'address';
    
    public function add_address($uid, $one, $two, $three, $is_current = true) {
        $this->db->insert($this->table, array(
            'uid' => $uid,
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'is_current' => $is_current
        ));
        $this->db->select('id')->where('id = last_insert_id()');
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
}

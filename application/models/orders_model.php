<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {
    
    private $table = 'orders';
    
    public function add_orders($uid, $aid, $total_price) {
        $this->db->insert($this->table, array(
            'uid' => $uid,
            'aid' => $aid,
            'total_price' => $total_price
        ));
        $this->db->select('id')->where('id = last_insert_id()');
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
}

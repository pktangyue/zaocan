<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_detail_model extends CI_Model {
    
    private $table = 'orders_detail';
    
    private $join_table = 'orders';
    
    public function add_item($oid, $gid, $name, $price, $number) {
        $this->db->insert($this->table, array(
            'oid' => $oid,
            'gid' => $gid,
            'name' => $name,
            'price' => $price,
            'number' => $number
        ));
    }
    
    public function get_detail($id) {
        if (!$id) {
            return array();
        }
        $this->db->join($this->join_table, $this->join_table . '.id = ' . $this->table . '.oid')->from($this->table);
        $this->db->select('aid,name,number,price,total_price')->where($this->join_table . '.id = ' . $id);
        return $this->db->get()->result();
    }
}

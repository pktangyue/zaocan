<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_detail_model extends CI_Model {
    
    private $table = 'orders_detail';
    
    public function add_item($oid, $gid, $name, $price, $number) {
        $this->db->insert($this->table, array(
            'oid' => $oid,
            'gid' => $gid,
            'name' => $name,
            'price' => $price,
            'number' => $number
        ));
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Goods_model extends CI_Model {
    
    private $table = 'goods';
    
    public function add_goods($name, $price) {
        $this->db->insert($this->table, array(
            'name' => $name,
            'price' => $price
        ));
    }
    
    public function edit_goods($id, $name, $price) {
        $this->db->update($this->table, array(
            'name' => $name,
            'price' => $price
        ) , array(
            'id' => $id
        ));
    }
    
    public function delete_goods($id) {
        $this->db->delete($this->table, array(
            'id' => $id
        ));
    }
    
    public function get_list($query = '') {
        $this->db->select('id,name,price');
        if ($query) {
            $this->db->like('name', $query);
        }
        $query = $this->db->get($this->table);
        return $query->result();
    }
}

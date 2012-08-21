<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Goods_model extends CI_Model {
    
    private $table = 'goods';
    
    public function add_goods($name, $price) {
        if ($this->is_exist($name)) {
            return;
        }
        $this->db->insert($this->table, array(
            'name' => $name,
            'price' => $price
        ));
        $this->db->select('id')->where('id = last_insert_id()');
        $row = $this->db->get($this->table)->row();
        return $row ? $row->id : '';
    }
    
    public function is_exist($name) {
        $this->db->where('name', $name)->from($this->table);
        return $this->db->count_all_results() == 0 ? False : True;
    }
    
    public function edit_goods($id, $name, $price) {
        $this->db->update($this->table, array(
            'name' => $name,
            'price' => $price
        ) , array(
            'id' => $id
        ));
    }
    
    public function recover_goods($id) {
        $this->db->update($this->table, array(
            'is_delete' => false
        ) , array(
            'id' => $id
        ));
    }
    
    public function delete_goods($id) {
        $this->db->update($this->table, array(
            'is_delete' => true
        ) , array(
            'id' => $id
        ));
    }
    
    public function get_all($query = '', $is_delete = NULL) {
        $this->db->select('id,name,price,is_set,is_delete')->order_by('name');
        if (isset($is_delete)) {
            $this->db->where('is_delete', $is_delete);
        }
        if ($query) {
            $this->db->like('name', $query);
        }
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function get_list($query = '') {
        return $this->get_all($query, false);
    }
}

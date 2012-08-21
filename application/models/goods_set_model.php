<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Goods_set_model extends CI_Model {
    
    private $table = 'goods_set';
    
    private $join_table = 'goods_set';
    
    public function add_some($id, $list) {
        if (!$id) {
            return;
        }
        foreach ($list as $goods) {
            $this->add_one($id, $goods['id'], $goods['num']);
        }
    }
    
    public function add_one($pid, $cid, $number) {
        if (!$pid || !$cid) {
            return;
        }
        $this->db->insert($this->table, array(
            'pid' => $pid,
            'cid' => $cid,
            'number' => $number
        ));
    }
    
    public function get_list_by_pid($pid) {
        if (!$pid) {
            return;
        }
        $this->db->where('pid', $pid);
        return $this->db->get($this->table)->result();
    }
    
    public function get_detail($pid) {
        if (!$pid) {
            return;
        }
        $this->db->join($this->join_table, $this->table . '.cid = ' . $this->join_table . '.id');
        $this->db->select('id,name,price,number')->where('pid', $pid);
        $this->db->where($this->join_table . '.is_delete', false);
        return $this->db->get($this->table)->result();
    }
}

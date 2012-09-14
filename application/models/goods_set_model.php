<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Goods_set_model extends CI_Model {
    
    private $table = 'goods_set';
    
    private $join_table = 'goods';
    
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
    
    public function get_all_detail() {
        return $this->get_detail('all');
    }
    
    public function get_detail($pid) {
        if (!$pid) {
            return array();
        }
        $this->db->join($this->join_table, $this->table . '.cid = ' . $this->join_table . '.id');
        $this->db->select('pid,cid,name,price,number')->where('number > 0');
        if ($pid !== 'all') {
            $this->db->where('pid', $pid);
        }
        $this->db->where($this->join_table . '.is_delete', false);
        return $this->db->get($this->table)->result();
    }
    
    public function update_item($pid, $cid, $number = 0) {
        if ($this->is_exist($pid, $cid)) {
            $this->db->update($this->table, array(
                'number' => $number
            ) , array(
                'pid' => $pid,
                'cid' => $cid
            ));
        }
        else {
            $this->db->insert($this->table, array(
                'pid' => $pid,
                'cid' => $cid,
                'number' => $number
            ));
        }
    }
    
    public function is_exist($pid, $cid) {
        $this->db->from($this->table)->where(array(
            'pid' => $pid,
            'cid' => $cid
        ));
        return $this->db->count_all_results() == 0 ? False : True;
    }
}

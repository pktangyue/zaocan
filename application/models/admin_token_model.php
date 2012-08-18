<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_token_model extends CI_Model {
    
    private $table = 'admin_token';
    
    public function check_token($uid, $series, $token) {
        if (!$uid || !$series || !$token) {
            return false;
        }
        $this->db->where(array(
            'uid' => $uid,
            'series' => $series,
            'token' => $token
        ));
        $this->db->from($this->table);
        return $this->db->count_all_results() == 0 ? False : True;
    }
    
    public function add_token($uid) {
        if (!$uid) {
            return;
        }
        try {
            $this->load->library('encrypt');
            $this->load->helper('security');
            $this->load->helper('string');
            $series = random_string('numeric', 12);
            $token = $this->encrypt->encode(do_hash($uid . $series . time() , 'md5'));
            $this->db->insert($this->table, array(
                'uid' => $uid,
                'series' => $series,
                'token' => $token
            ));
            return array(
                'token' => $token,
                'series' => $series
            );
        }
        catch(Exception $e) {
            return $this->add_token($uid);
        }
    }
    
    public function update_token($uid, $series) {
        if (!$uid || !$series) {
            return;
        }
        $this->load->library('encrypt');
        $this->load->helper('security');
        $token = $this->encrypt->encode(do_hash($uid . $series . time() , 'md5'));
        $this->db->update($this->table, array(
            'token' => $token
        ) , array(
            'uid' => $uid,
            'series' => $series
        ));
        return $token;
    }
    
    public function delete_token($uid, $series) {
        if (!$uid || !$series) {
            return;
        }
        $this->db->delete($this->table, array(
            'uid' => $uid,
            'series' => $series
        ));
    }
}

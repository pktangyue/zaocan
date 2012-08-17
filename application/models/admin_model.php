<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function check_admin($name, $password) {
        $this->load->helper('security');
        $this->db->where(array(
            'name' => $name,
            'password' => do_hash($password, 'md5')
        ));
        $this->db->from('admin');
        return $this->db->count_all_results() == 0 ? False : True;
    }
    function check_admin_by_token($name, $token) {
        if (!$token) {
            return false;
        }
        $this->db->where(array(
            'name' => $name,
            'token' => $token
        ));
        $this->db->from('admin');
        return $this->db->count_all_results() == 0 ? False : True;
    }
    function update_token($name) {
        if (!$name) {
            return;
        }
        $this->load->library('encrypt');
        $token = $this->encrypt->encode(do_hash($name . time() , 'md5'));
        $this->db->update('admin', array(
            'token' => $token
        ) , array(
            'name' => $name
        ));
        return $token;
    }
    function delete_token($name) {
        if (!$name) {
            return;
        }
        $this->db->update('admin', array(
            'token' => '',
        ) , array(
            'name' => $name
        ));
    }
}

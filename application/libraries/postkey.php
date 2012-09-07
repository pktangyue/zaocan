<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Postkey {
    
    public function __construct() {
        $CI = & get_instance();
        $CI->load->library('encrypt');
    }
    
    public function encode($fish, $salt = '') {
        $CI = & get_instance();
        return $CI->encrypt->encode($fish, $salt);
    }
    
    public function compare($postkey, $fish, $salt = '') {
        $CI = & get_instance();
        return $CI->encrypt->decode($postkey, $salt) == $fish;
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loadview {
    public function __construct() {
        //现在不显示pc，直接exit，到后面做pc版，删除这段代码即可
        $CI = & get_instance();
        if (!$CI->agent->is_mobile()) {
            exit;
        }
    }
    public function path($view, $vars = array() , $return = FALSE) {
        $CI = & get_instance();
        if (!$CI->agent->is_mobile()) {
            $view = 'pc/' . $view;
        }
        $CI->load->view($view, $vars, $return);
    }
}

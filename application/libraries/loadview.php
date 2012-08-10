<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loadview {
    public function path($view, $vars = array() , $return = FALSE) {
        $CI = & get_instance();
        if ($CI->agent->is_mobile()) {
            $view = 'mobile/' . $view;
        }
        $CI->parser->parse($view, $vars, $return);
    }
}

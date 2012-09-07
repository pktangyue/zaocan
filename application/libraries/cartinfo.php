<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cartinfo {
    
    private $expire = 2592000;
    
    private $id_with_number;
    
    public function save($cart = '') {
        // $cart = "id:num;id:num";
        if (!$cart) {
            return;
        }
        set_cookie('cart', $cart, $this->expire);
    }
    
    public function delete() {
        delete_cookie('cart');
    }
    
    public function get_id_with_number($cart = '') {
        $cart = $cart ? $cart : get_cookie('cart', true);
        if (!$cart) {
            return array();
        }
        $id_with_number = array();
        foreach (explode(';', $cart) as $item) {
            list($id, $number) = explode(':', $item);
            $id_with_number[$id] = $number;
        }
        // $id_with_number = array( id => number , id => number);
        return $id_with_number;
    }
    
    public function get_list($cart = '') {
        $CI = & get_instance();
        $CI->load->model('goods_model');
        $id_with_number = $this->get_id_with_number($cart);
        $list = $CI->goods_model->get_goods_by_ids(array_keys($id_with_number));
        foreach ($list as $item) {
            $item->number = $id_with_number[$item->id];
        }
        return $list;
    }
}

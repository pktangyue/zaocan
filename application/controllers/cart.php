<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Cart extends Base {
    
    public function index() {
        $this->_save_cart();
        $this->check_login();
        $this->_get_cart();
        $this->_get_current_address();
        $this->params['title'] = '确定订单';
        $this->loadview->path('cart', $this->params);
    }
    
    private function _save_cart() {
        $cart = $this->input->post('cart');
        if ($cart) {
            set_cookie('cart', $cart, $this->expire);
        }
    }
    
    private function _get_cart() {
        $cart = $this->input->post('cart') ? $this->input->post('cart') : get_cookie('cart', true);
        if (!$cart) {
            return;
        }
        $id_with_number = array();
        $total_price = 0;
        foreach (explode(';', $cart) as $item) {
            list($id, $number) = explode(':', $item);
            $id_with_number[$id] = $number;
        }
        $this->load->model('goods_model');
        $goods_list = $this->goods_model->get_goods_by_ids(array_keys($id_with_number));
        foreach ($goods_list as $item) {
            $item->number = $id_with_number[$item->id];
            $total_price+= $item->number * $item->price;
        }
        $this->params['goods_list'] = $goods_list;
        $this->params['total_price'] = $total_price;
    }
    
    private function _get_current_address() {
        $this->load->model('address_model');
        $address = $this->address_model->get_current_address($this->get_user_id());
        $this->params['address'] = $address;
    }
}

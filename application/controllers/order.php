<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Order extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->check_login();
    }
    
    public function index() {
    }
    
    public function add() {
        $this->load->library('cartinfo');
        $aid = $this->input->post('aid');
        if (!$aid) {
            $this->_show_add_error('请先设置一个收货地址');
            return;
        }
        $cart_list = $this->cartinfo->get_list();
        if (!$cart_list) {
            $this->_show_add_error('请选择要购买的商品');
            return;
        }
        $total_price = 0;
        foreach ($cart_list as $goods) {
            $total_price+= $goods->number * $goods->price;
        }
        $this->load->model('orders_model');
        $id = $this->orders_model->add_orders($this->get_user_id() , $aid, $total_price);
        if (!$id) {
            $this->_show_add_error('生成订单失败');
            return;
        }
        $this->load->model('orders_detail_model');
        foreach ($cart_list as $goods) {
            $this->orders_detail_model->add_item($id, $goods->id, $goods->name, $goods->price, $goods->number);
        }
        $this->cartinfo->delete();
        redirect('/order');
    }
    
    private function _show_add_error($error = '') {
        $this->params['error'] = $error;
        $this->params['title'] = '我的订单';
        $this->loadview->path('order/add', $this->params);
        return;
    }
}

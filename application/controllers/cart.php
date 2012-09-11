<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Cart extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('cartinfo');
    }
    
    public function index() {
        $this->check_login();
        $this->load->model('address_model');
        $this->params['address'] = $this->address_model->get_current_address($this->get_user_id());
        $this->params['cart_list'] = $this->cartinfo->get_list();
        $this->params['user_phone'] = $this->get_user_phone();
        $this->params['title'] = '确定订单';
        $this->set_back_btn('/');
        $this->loadview->path('cart', $this->params);
    }
    
    public function save() {
        if (!$this->input->is_ajax_request()) {
            return;
        }
        $cart = $this->input->post('cart');
        if ($cart) {
            $this->cartinfo->save($cart);
        }
        else {
            $this->cartinfo->delete();
        }
    }
}

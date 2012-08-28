<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Phone extends Base {
    
    private $expire = 2592000;
    
    public function index() {
        if ($this->is_logined()) {
            $this->load->helper('url');
            redirect('/cart');
        }
        $this->load->helper('cookie');
        $this->_handler_next();
        $this->params['title'] = '设置手机号';
        $this->params['phone'] = get_cookie('user_phone');
        $this->loadview->path('user/phone', $this->params);
    }
    
    private function _handler_next() {
        $phone = $this->input->post('phone');
        if (!$phone) {
            return;
        }
        $this->load->model('user_model');
        $this->load->helper('url');
        set_cookie('user_phone', $phone, $this->expire);
        if ($this->user_model->get_user($phone)) {
            redirect('/user/password');
        }
        else {
            redirect('/user/register');
        }
    }
}

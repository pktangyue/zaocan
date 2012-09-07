<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Phone extends Base {
    
    public function index() {
        if ($this->is_logined()) {
            redirect('/cart');
        }
        $this->_handler_next();
        $this->_display();
    }
    
    private function _handler_next() {
        $phone = $this->input->post('phone');
        if (!$phone) {
            return;
        }
        $this->load->model('user_model');
        set_cookie('user_phone', $phone, $this->expire);
        if ($this->user_model->get_user($phone)) {
            redirect('/user/password');
        }
        else {
            redirect('/user/register');
        }
    }
    
    private function _display() {
        $this->params['title'] = '设置手机号';
        $this->params['phone'] = get_cookie('user_phone', true);
        $this->loadview->path('user/phone', $this->params);
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Password extends Base {
    
    public function index() {
        if ($this->is_logined()) {
            redirect('/cart');
        }
        $this->_handler_login();
        $this->params['title'] = '登录';
        $this->loadview->path('user/password', $this->params);
    }
    
    private function _handler_login() {
        if (!$this->input->post('submit') == 'login') {
            return;
        }
        $this->load->model('user_model');
        $password = $this->input->post('password');
        $phone = get_cookie('user_phone', true);
        if ($this->user_model->check_user($phone, $password)) {
            $this->set_logined_with_phone($phone);
            $this->set_auto_login_cookies($phone);
            redirect('/cart');
        }
        else {
            $this->params['error'] = '密码输入不正确';
        }
    }
}

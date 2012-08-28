<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Register extends Base {
    
    public function index() {
        if ($this->is_logined()) {
            redirect('/cart');
        }
        $this->_handler_register();
        $this->params['title'] = '注册';
        $this->loadview->path('user/register', $this->params);
    }
    
    private function _handler_register() {
        if (!$this->input->post('submit') == 'register') {
            return;
        }
        $this->params['name'] = $name = $this->input->post('name');
        $this->params['one'] = $one = $this->input->post('one');
        $this->params['two'] = $two = $this->input->post('two');
        $this->params['three'] = $three = $this->input->post('three');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        if ($password1 != $password2) {
            $this->params['error'] = '重复密码不一致';
            return;
        }
        $this->load->model('user_model');
        $this->load->model('address_model');
        $phone = get_cookie('user_phone');
        $uid = $this->user_model->add_user($name, $phone, $password1);
        if (!$uid) {
            $this->params['error'] = '已经存在的手机号';
            return;
        }
        $this->address_model->add_address($uid, $one, $two, $three);
        $this->set_logined_with_phone($phone);
        redirect('/cart');
    }
}

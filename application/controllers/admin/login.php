<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Login extends Base {
    
    private $params = array();
    
    private $default_url = '/admin';
    
    private $expire = 2592000;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('admin_token_model', 'token_model');
    }
    
    public function index() {
        if ($this->is_logined()) {
            $this->_login_redirect();
            return;
        }
        $this->_handler_auto_login();
        $this->_handler_login();
        $this->_display();
    }
    
    private function _handler_auto_login() {
        $is_auto_login = get_cookie('autologin', true);
        if (!$is_auto_login) {
            return;
        }
        $name = get_cookie('name', true);
        $series = get_cookie('zaocan_series', true);
        $token = get_cookie('zaocan_token', true);
        if ($this->token_model->check_token($this->get_admin_id($name) , $series, $token)) {
            $this->_update_login_token($this->get_admin_id($name) , $series);
            $this->set_logined_with_name($name);
            $this->_login_redirect();
        }
    }
    
    private function _handler_login() {
        if (!$this->input->post('submit') == 'login' || $this->is_logined()) {
            return;
        }
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        if (!$name || !$password) {
            return;
        }
        $this->load->model('admin_model');
        if ($this->admin_model->check_admin($name, $password)) {
            $this->_update_cookie($this->input->post('is_auto_login') , $name);
            $this->set_logined_with_name($name);
            $this->_login_redirect();
        }
        else {
            $this->params['error'] = '用户名或密码不正确';
        }
    }
    
    private function _update_cookie($is_auto_login, $name) {
        set_cookie('autologin', $is_auto_login ? true : false, $this->expire);
        set_cookie('name', $name, $this->expire);
        if ($is_auto_login) {
            $this->_add_login_token($this->get_admin_id($name));
        }
    }
    
    private function _add_login_token($admin_id) {
        $result = $this->token_model->add_token($admin_id);
        set_cookie('token', $result['token'], $this->expire);
        set_cookie('series', $result['series'], $this->expire);
    }
    
    private function _update_login_token($uid, $series) {
        $token = $this->token_model->update_token($uid, $series);
        set_cookie('token', $token, $this->expire);
    }
    
    private function _display() {
        $this->params['title'] = '管理员登录';
        $this->params['redirect_url'] = $this->input->get('redirect_url');
        $this->loadview->path('admin/login', $this->params);
    }
    
    private function _login_redirect() {
        $this->load->helper('url');
        $redirect_url = urldecode($this->input->post('redirect_url'));
        redirect($redirect_url ? $redirect_url : $this->default_url);
    }
}

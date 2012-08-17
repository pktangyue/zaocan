<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Login extends Base {
    
    private $params = array();
    
    private $default_url = '/admin';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('admin_model');
    }
    
    public function index() {
        if ($this->_is_logined()) {
            $this->_login_redirect();
            return;
        }
        $this->_handler_auto_login();
        $this->_handler_login();
        $this->_display();
    }
    
    protected function _handler_auto_login() {
        $is_auto_login = $this->input->cookie('zaocan_autologin', true);
        if (!$is_auto_login) {
            return;
        }
        $name = $this->input->cookie('zaocan_name', true);
        $token = $this->input->cookie('zaocan_token', true);
        if ($this->admin_model->check_admin_by_token($name, $token)) {
            $this->session->set_userdata(array(
                'name' => $name
            ));
            $this->_login_redirect();
        }
    }
    
    protected function _handler_login() {
        if (!$this->input->post('submit') == 'login' || $this->_is_logined()) {
            return;
        }
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        if (!$name || !$password) {
            return;
        }
        if ($this->admin_model->check_admin($name, $password)) {
            $this->session->set_userdata(array(
                'name' => $name
            ));
            $this->_update_cookie($name, $this->input->post('is_auto_login'));
            $this->_login_redirect();
        }
        else {
            $this->params['error'] = '用户名或密码不正确';
        }
    }
    
    protected function _update_cookie($name, $is_auto_login) {
        $cookie = array(
            'name' => 'autologin',
            'expire' => 86400 * 30,
            'prefix' => 'zaocan_'
        );
        $cookie['value'] = $is_auto_login ? true : false;
        $this->input->set_cookie($cookie);
        $this->input->set_cookie(array(
            'name' => 'name',
            'value' => $name,
            'expire' => 86400 * 30,
            'prefix' => 'zaocan_'
        ));
        if ($is_auto_login) {
            $this->_set_login_token($name);
        }
    }
    
    protected function _set_login_token($name) {
        $token = $this->admin_model->update_token($name);
        $this->input->set_cookie(array(
            'name' => 'token',
            'value' => $token,
            'expire' => 86400 * 30,
            'prefix' => 'zaocan_'
        ));
    }
    
    protected function _display() {
        $this->params['title'] = '管理员登录';
        $this->loadview->path('admin/login', $this->params);
    }
    
    protected function _login_redirect() {
        $this->load->helper('url');
        $redirect_url = urldecode($this->input->get('redirect_url'));
        redirect($redirect_url ? $redirect_url : $this->default_url);
    }
}

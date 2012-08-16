<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Login extends Base {
    private $params = array();
    public function index() {
        if ($this->input->post('submit') == 'login') {
            $name = $this->input->post('name');
            $password = $this->input->post('password');
            $this->load->model('admin_model');
            if ($this->admin_model->check_admin($name, $password)) {
                $this->session->set_userdata(array(
                    'name' => $name
                ));
                $this->_login_redirect();
            }
            else {
                $this->params['error'] = '用户名或密码不正确';
            }
        }
        $this->_display();
    }
    protected function _display() {
        $this->params['title'] = '管理员登录';
        $this->loadview->path('admin/login', $this->params);
    }
    protected function _login_redirect() {
        $redirect_url = urldecode($this->input->get('redirect_url'));
        redirect_url($redirect_url ? $redirect_url : '/admin');
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Password extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('postkey');
    }
    
    public function index() {
        $this->_handler_post();
        $this->_display();
    }
    
    private function _display() {
        $this->params['title'] = "更改密码";
        $this->params['postkey'] = $this->postkey->encode($this->get_admin_name());
        $this->loadview->path('admin/password', $this->params);
    }
    
    private function _handler_post() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        $postkey = $this->input->post('postkey');
        $admin_name = $this->get_admin_name();
        if (!$this->postkey->compare($postkey, $this->get_admin_name())) {
            $this->params['error'] = "非法的请求";
            return;
        }
        $password = $this->input->post('password');
        $new_password = $this->input->post('password1');
        if ($new_password != $this->input->post('password2')) {
            $this->params['error'] = "输入的新密码不相同";
            return;
        }
        $this->load->model('admin_model');
        if (!$this->admin_model->check_admin($admin_name, $password)) {
            $this->params['error'] = "密码输入错误";
            return;
        }
        $this->admin_model->change_password($admin_name, $new_password);
        $this->params['success'] = "修改成功";
    }
}

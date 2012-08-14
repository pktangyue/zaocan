<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index() {
        $this->loadview->path('common/header.html', array(
            'title' => '管理员登录'
        ));
        $this->loadview->path('admin/login.html');
        $this->loadview->path('common/footer.html');
    }
}

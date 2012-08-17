<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function index() {
        echo $this->admin_name;
        $this->load->model('admin_model');
        $this->admin_model->delete_token($this->admin_name);
        $this->_delete_cookie();
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
    
    protected function _delete_cookie() {
        $this->input->set_cookie(array(
            'name' => 'autologin',
            'value' => '',
            'expire' => 0,
            'prefix' => 'zaocan_'
        ));
        $this->input->set_cookie(array(
            'name' => 'token',
            'value' => '',
            'expire' => 0,
            'prefix' => 'zaocan_'
        ));
    }
}

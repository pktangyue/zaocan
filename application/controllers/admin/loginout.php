<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function index() {
        $this->session->sess_destroy();
        $this->_delete_cookie();
        redirect('/admin/login');
    }
    
    protected function _delete_cookie() {
        $this->input->set_cookie(array(
            'name' => 'autologin',
            'value' => '',
            'expire' => 0,
            'prefix' => 'zaocan_'
        ));
    }
}

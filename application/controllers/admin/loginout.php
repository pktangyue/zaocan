<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function index() {
        $this->load->model('admin_token_model', 'token_model');
        $series = $this->input->cookie('zaocan_series', true);
        $this->token_model->delete_token($this->get_admin_id() , $series);
        $this->_delete_cookie();
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
    
    private function _delete_cookie() {
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
        $this->input->set_cookie(array(
            'name' => 'series',
            'value' => '',
            'expire' => 0,
            'prefix' => 'zaocan_'
        ));
    }
}

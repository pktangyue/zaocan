<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('admin_token_model', 'token_model');
    }
    
    public function index() {
        $series = get_cookie('admin_series', true);
        $this->token_model->delete_token($this->get_admin_id() , $series);
        delete_cookie('admin_autologin');
        delete_cookie('admin_token');
        delete_cookie('admin_series');
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('admin_token_model', 'token_model');
    }
    
    public function index() {
        $series = get_cookie('zaocan_series', true);
        $this->token_model->delete_token($this->get_admin_id() , $series);
        delete_cookie('autologin');
        delete_cookie('token');
        delete_cookie('series');
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
}

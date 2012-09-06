<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_token_model', 'token_model');
    }
    
    public function index() {
        $series = get_cookie('user_series', true);
        $this->token_model->delete_token($this->get_user_id() , $series);
        delete_cookie('user_autologin');
        delete_cookie('user_token');
        delete_cookie('user_series');
        $this->session->sess_destroy();
        redirect('/');
    }
}

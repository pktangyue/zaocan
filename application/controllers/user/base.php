<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    
    private $user_phone;
    
    private $user;
    
    protected $params = array();
    
    public function __construct() {
        parent::__construct();
        $this->user_phone = $this->session->userdata('phone');
    }
    
    protected function is_logined() {
        return !!$this->user_phone;
    }
    
    protected function check_login() {
        $this->load->helper('url');
        if (!$this->is_logined()) {
            redirect('/user/phone');
        }
        return;
    }
    
    protected function set_logined_with_phone($phone) {
        if (!$phone) {
            throw new Exception('login failed');
        }
        $this->session->set_userdata(array(
            'phone' => $phone
        ));
        $this->user_phone = $phone;
    }
    
    protected function get_user_phone() {
        return $this->user_phone;
    }
    
    protected function get_user($phone = '') {
        if (!$this->user) {
            $this->load->model('user_model');
            $phone = $phone ? $phone : $this->user_phone;
            $this->user = $this->user_model->get_user($phone);
        }
        return $this->user;
    }
    
    protected function get_user_id($phone = '') {
        $user = $this->get_user($phone);
        if (!$user) {
            return;
        }
        return $user->id;
    }
    
    protected function get_user_name($phone = '') {
        $user = $this->get_user($phone);
        if (!$user) {
            return;
        }
        return $user->name;
    }
}

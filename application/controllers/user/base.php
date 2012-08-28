<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    
    private $user_phone;
    
    private $user;
    
    protected $params = array();
    
    protected $expire = 2592000;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_token_model', 'token_model');
        $this->user_phone = $this->session->userdata('phone');
        $this->try_auto_login();
    }
    
    protected function is_logined() {
        return !!$this->user_phone;
    }
    
    protected function check_login() {
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
    
    protected function set_auto_login_cookies($phone = '') {
        $phone = $phone ? $phone : $this->get_user_phone();
        set_cookie('user_autologin', true, $this->expire);
        set_cookie('user_phone', $phone, $this->expire);
        $result = $this->token_model->add_token($this->get_user_id());
        set_cookie('user_token', $result['token'], $this->expire);
        set_cookie('user_series', $result['series'], $this->expire);
    }
    
    protected function try_auto_login() {
        if ($this->is_logined()) {
            return;
        }
        $is_auto_login = get_cookie('user_autologin', true);
        if (!$is_auto_login) {
            return;
        }
        $phone = get_cookie('user_phone', true);
        $series = get_cookie('user_series', true);
        $token = get_cookie('user_token', true);
        if ($this->token_model->check_token($this->get_user_id($phone) , $series, $token)) {
            $token = $this->token_model->update_token($this->get_user_id($phone) , $series);
            set_cookie('user_token', $token, $this->expire);
            $this->set_logined_with_phone($phone);
        }
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

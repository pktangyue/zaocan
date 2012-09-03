<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Address extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->load->model('address_model');
    }
    
    public function index() {
        $this->_handler_register();
        $this->_set_back_url();
        $this->params['title'] = '收货地址';
        $this->params['address_list'] = $this->address_model->get_address_list($this->get_user_id());
        $this->loadview->path('address', $this->params);
    }
    
    public function update($id) {
        if (!$id) {
            return;
        }
        $this->address_model->update_current_address($this->get_user_id() , $id);
    }
    
    private function _handler_register() {
        if (!$this->input->post('submit') == 'add') {
            return;
        }
        $this->params['name'] = $name = $this->input->post('name');
        $this->params['one'] = $one = $this->input->post('one');
        $this->params['two'] = $two = $this->input->post('two');
        $this->params['three'] = $three = $this->input->post('three');
        $this->address_model->add_address($this->get_user_id() , $name, $one, $two, $three);
    }
    
    private function _set_back_url() {
        $url = $this->agent->is_referral() ? $this->agent->referrer() : '/profile';
        $this->set_back_btn($url);
    }
}

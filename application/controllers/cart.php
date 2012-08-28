<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Cart extends Base {
    
    public function index() {
        $this->_save_ids();
        $this->check_login();
    }
    
    private function _save_ids() {
        $ids = $this->input->post('ids');
        if ($ids) {
            set_cookie('goods_ids', $this->input->post('ids') , $this->expire);
        }
    }
}

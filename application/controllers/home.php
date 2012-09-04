<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Home extends Base {
    
    public function index() {
        $this->load->library('cartinfo');
        $this->params['title'] = '订餐首页';
        $this->params['cart_list'] = $this->cartinfo->get_list();
        $this->params['list'] = $this->_get_home_goods();
        $this->loadview->path('home', $this->params);
    }
    
    private function _get_home_goods() {
        $this->load->model('goods_model');
        $this->load->model('goods_set_model', 'set_model');
        $list = $this->goods_model->get_all('', NULL, false);
        foreach ($list as $goods) {
            if ($goods->is_set) {
                $goods->details = $this->set_model->get_detail($goods->id);
            }
        }
        return $list;
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function index() {
        $this->params['title'] = '订餐首页';
        $this->params['list'] = $this->get_home_goods();
        $this->loadview->path('home', $this->params);
    }
    
    public function get_home_goods() {
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

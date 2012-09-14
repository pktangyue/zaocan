<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('user/base.php');

class Home extends Base {
    
    public function index() {
        $this->load->library('cartinfo');
        $this->params['title'] = '订餐首页';
        $this->params['cart_list'] = $this->cartinfo->get_list();
        $this->params['list'] = $this->_get_home_goods();
        if ($this->is_logined()) {
            $this->params['right_header_btn'] = '<a id="J_nav" class="btn btn-navbar pull-right" rel="popover"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>';
        }
        $this->loadview->path('home', $this->params);
    }
    
    private function _get_home_goods() {
        $this->load->model('goods_model');
        $this->load->model('goods_set_model', 'set_model');
        $this->load->model('orders_detail_model');
        $list = $this->goods_model->get_all('', NULL, false);
        $all_detail = $this->set_model->get_all_detail();
        $all_sales = $this->orders_detail_model->get_all_sales();
        foreach ($list as $goods) {
            if ($goods->is_set) {
                $goods->details = array_filter($all_detail, function ($item) use ($goods) {
                    return $item->pid === $goods->id;
                });
            }
            $sales = array_filter($all_sales, function ($item) use ($goods) {
                return $item->gid === $goods->id;
            });
            $goods->sales = $sales ? array_shift($sales)->number : 0;
        }
        return $list;
    }
}

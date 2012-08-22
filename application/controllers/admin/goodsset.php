<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Goodsset extends Base {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('goods_set_model', 'set_model');
    }
    
    public function index() {
        $this->params['title'] = "套餐管理";
        $this->params['error'] = $this->input->get('error');
        $this->_set_params();
        $this->loadview->path('admin/goodsset', $this->params);
    }
    
    public function add() {
        $name = $this->input->get('name');
        $price = $this->input->get('price');
        $goods_list = $this->input->get('list');
        $id = $this->goods_model->add_goods($name, $price, true);
        if (!$id) {
            $error = '新增套餐失败';
        }
        $this->set_model->add_some($id, $goods_list);
        $url = '/admin/goodsset' . (isset($error) ? '?error=' . $error : '');
        redirect($url);
    }
    
    public function update() {
        $pid = $this->input->get('pid');
        $cid = $this->input->get('cid');
        $number = $this->input->get('number');
        if (!$pid || !$cid) {
            return;
        }
        $this->set_model->update_item($pid, $cid, $number ? $number : 0);
    }
    
    private function _set_params() {
        $goods_list = $this->goods_model->get_all('', false, false);
        $sets_list = $this->goods_model->get_all('', true);
        foreach ($sets_list as $item) {
            $include_goods_list = $this->set_model->get_list_by_pid($item->id);
            $item->goods_list = array();
            foreach ($goods_list as $i) {
                $new = NULL;
                $new->number = '';
                $new->id = $i->id;
                $new->name = $i->name;
                foreach ($include_goods_list as $j) {
                    if ($i->id == $j->cid) {
                        $new->number = $j->number;
                        break;
                    }
                }
                array_push($item->goods_list, $new);
            }
        }
        $this->params['goods_list'] = $goods_list;
        $this->params['sets_list'] = $sets_list;
    }
}

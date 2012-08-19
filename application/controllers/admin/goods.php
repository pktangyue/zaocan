<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Goods extends Base {
    
    private $params = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
    }
    
    public function index() {
        $query = $this->input->get('query');
        $this->params['title'] = '产品管理';
        $this->params['error'] = $this->input->get('error');
        $this->params['list'] = $this->goods_model->get_list($query);
        $this->loadview->path('admin/goods', $this->params);
    }
    
    public function add() {
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        if (!$name || !$price || !preg_match('/^\d+(.\d{0,2})?$/', $price)) {
            $error = '输入的名称或价格有误！';
        }
        else {
            $this->goods_model->add_goods($name, $price);
        }
        $this->load->helper('url');
        $url = '/admin/goods' . (isset($error) ? '?error=' . $error : '');
        redirect($url);
    }
    
    public function edit() {
        $id = $this->input->get('id');
        $name = $this->input->get('name');
        $price = $this->input->get('price');
        if (!$name || !$price || !preg_match('/^\d+(.\d{0,2})?$/', $price)) {
            echo '输入的名称或价格有误！';
            return;
        }
        $this->goods_model->edit_goods($id, $name, $price);
    }
    
    public function delete($id) {
        if (!$id) {
            return '没有此产品';
        }
        $this->goods_model->delete_goods($id);
    }
}

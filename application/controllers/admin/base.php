<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    
    private $admin_name; // 作为判断是否登录的属性，设置为private，禁止子类直接修改
    
    private $admin_id;
    
    protected $params = array();
    
    public function __construct() {
        parent::__construct();
        $this->admin_name = $this->session->userdata('name');
        $this->check_login();
    }
    
    public function index() {
        $this->params['title'] = '管理员首页';
        $this->loadview->path('admin/index', $this->params);
    }
    
    protected function is_logined() {
        return !!$this->admin_name;
    }
    
    protected function check_login() {
        if (!$this->is_logined() && uri_string() != 'admin/login' && uri_string() != 'admin/loginout') {
            redirect('admin/login?redirect_url=' . urlencode(current_url()));
        }
        return;
    }
    
    protected function set_logined_with_name($name) {
        if (!$name) {
            throw new Exception('login failed');
        }
        $this->session->set_userdata(array(
            'name' => $name
        ));
        $this->admin_name = $name;
    }
    
    protected function get_admin_name() {
        return $this->admin_name;
    }
    
    protected function get_admin_id($name = '') {
        if (!$this->admin_id) {
            $this->load->model('admin_model');
            $name = $name ? $name : $this->admin_name;
            $this->admin_id = $this->admin_model->get_id_by_name($name);
        }
        return $this->admin_id;
    }
    
    protected function set_back_btn() {
        $this->params['left_header_btn'] = '<a href="/admin" class="pull-left btn"> <i class="icon-chevron-left"></i> 返回 </a>';
    }
}

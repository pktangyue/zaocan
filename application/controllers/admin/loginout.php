<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require ('base.php');

class Loginout extends Base {
    public function index() {
        $this->session->sess_destroy();
        redirect('/admin/login');
    }
}

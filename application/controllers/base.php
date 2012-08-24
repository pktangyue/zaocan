<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    
    private $user_name;
    
    private $user_id;
    
    protected $params = array();
    
    public function __construct() {
        parent::__construct();
    }
}

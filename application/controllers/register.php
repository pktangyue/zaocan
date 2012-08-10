<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->loadview->path('register.html',array('title'=>'注册'));
	}
}

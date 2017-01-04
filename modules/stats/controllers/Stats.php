<?php

if (! defined ( 'BASEPATH' )) {
	exit ( 'No direct script access allowed' );
}

class Stats extends Smart_Controller {
	public function __construct() {
		parent::__construct ();
		if (! isset ( $_SESSION ['username'] )) {
			redirect ( base_url () );
		}
		$res_permission = $this->systemmodel->get_menulink_permission ( $this->session->person_id );
		if (! in_array ( $this->uri->segment ( 1 ) . '/' . $this->uri->segment ( 2 ), $res_permission )) {
			redirect ( base_url () . 'index.php/member/nopermission' );
		}
		$this->load->library ( 'grocery_CRUD' );
	}
	public function index() {
		$data['output'] = "ทดสอบอีกครั้ง";
		$data ['content'] = "stats/index";
		$this->load->view ( 'templates/index', $data );
	}
	public function test() {
		$data['output'] = "ทดสอบระบบ HMVC";
		$data ['content'] = "stats/test";
		$this->load->view ( 'templates/index', $data );
	}
}

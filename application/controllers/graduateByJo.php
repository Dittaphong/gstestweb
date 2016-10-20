<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class graduateByJo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function loadpage($StrQuery){ // ตัว Generate หน้าเว็บ
		//Data
		$data['Result'] = $StrQuery['Result'];
		// View
		//$this->debuger->prevalue($StrQuery['View']);
		$this->load->view('/Template/Header', $data);
		$this->load->view($StrQuery['View']);
		$this->load->view('/Template/Footer');
	}
	public function selectGraduateOfficer(){ 	//หน้า Dashboard
		if(isset($_POST['selectGraduateOfficerBtn'])){
			print_r($_POST);
			foreach ($_POST['graduateOfficer'] as $key => $value) {
				$this->graduatemodel->insert('graduate_officer',array('OFFICERID'=>$value));
			}


		}
		$StrQuery = array(
			'Result' => $this->graduatebyjomodel->graduateOfficerList(),
			'View' => 'Graduate/Pages/Settings/selectGraduateOfficer'
		);
		$this->loadpage($StrQuery);
	}
}

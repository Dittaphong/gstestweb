<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function loadpage($StrQuery){
		//Data
		$data['Result'] = $StrQuery['Result'];
		$data['namepage'] = $StrQuery['namepage'];
		// View
		$this->load->view('/Template/Header', $data);
		$this->load->view($StrQuery['View']);
		$this->load->view('/Template/Footer');
	}
	public function index(){
		if($this->uri->segment(3) == 1){
			$this->load->view('Public/Login/Login');
		}
		else{
			$this->load->view('Public/Login/Authen');
		}
	}
	public function authen(){
		$input = array (
			'userName' => $this->input->post('userName'),
			'password' => MD5($this->input->post('password')),
		);

		$Authen = $this->usermodel->authen_user($input);
		//$this->debuger->prevalue($Authen);
		//echo "<pre>";

		if(count($Authen)>0)
		{
			$_SESSION['USERCODE'] = $Authen[0]['USERCODE'];
			$_SESSION['GROUPTYPE'] = $Authen[0]['GROUPTYPE'];

			if($_SESSION['GROUPTYPE']=="TEACHER")
			{
				redirect('teacher');
			}
			else if($_SESSION['GROUPTYPE']=="ADMIN")
			{
				redirect('graduate');
			}
			else if($_SESSION['GROUPTYPE']=="STUDENT")
			{
				redirect('student');
			}
			else if($_SESSION['GROUPTYPE']=="FACULTY")
			{
				redirect('faculty_controller');
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}

	}
	public function logout(){
		session_destroy();
		redirect('home');
	}
	public function SearchStudent(){


		$StrQuery = array(
				'Result' => '',
				'namepage' =>'ค้นหานักศึกษา' ,
				'View' => 'Public/Student/SearchStudent');

		//Generate View
		$this->loadpage($StrQuery);

	}
	public function SearchStudentList(){
		$input = array (
			'STUDENT_CODE' => $this->input->post('STUDENT_CODE'),
			'STUDENT_NAME' => $this->input->post('STUDENT_NAME'),
			'STUDENT_FACULTY' => $this->input->post('STUDENT_FACULTY'),
		);
		//echo "<pre>";
		$StrQuery = array(
				'Result' => $this->studentsmodel->SearchStudentList($input),
				'namepage' =>'ค้นหานักศึกษา' ,
				'View' => 'Public/Student/SearchStudentList');
		//echo "<pre>";

		$this->loadpage($StrQuery);

	}
	public function ProgramDetail() {

		$input = $this->uri->segment(3);

		$StrQuery = array(
			'Result' => $this->programsmodel->programdetail($input),
			'View' => 'Template/ProgramsDetail'
		);
		//echo "<pre>";
		//			print_r($StrQuery);
		//			exit();
		$this->loadpage($StrQuery);
	}
}

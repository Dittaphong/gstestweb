<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class faculty_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
	}
	public function loadpage($StrQuery){ // ตัว Generate หน้าเว็บ
		//Data
		$data['Result'] = $StrQuery['Result'];
		//$data['fact_officer']=
		// View
		//$this->debuger->prevalue($StrQuery['View']);
		$this->load->view('/Template/Header', $data);
		$this->load->view($StrQuery['View']);
		$this->load->view('/Template/Footer');
	}
	public function index(){ 	//หน้า Dashboard
		$StrQuery = array(
			'Result' => '',
			'View' => 'Faculty/Pages/Dashboard'
		);
		$this->loadpage($StrQuery);
	}
	//////////////////////////////////////////////////////////////////////////////
	// นักศึกษา
	// ------------------
	// หน้าจอ รายการเอกสาร
	public function AdvisorList(){ // รายการ รออนุมัติที่ปรึกษา


		$StrQuery = array(
			'Result' => $this->facmodel->DocAdviserList(),
			'View' => 'Faculty/Pages/Students/AdvisorList'
		);
		$this->loadpage($StrQuery);
	}
	public function ExamList(){ // รายการ รออนุมัติสอบ QE/CE
		$EXAM_TYPE = $this->uri->segment(3);
		$ExamList = $this->facmodel->ExamList($EXAM_TYPE);
		$StrQuery = array(
			'Result' => $ExamList,
			'View' => 'Faculty/Pages/Students/ExamList'
		);
		$this->loadpage($StrQuery);
	}

	// หน้าจอ ข้อมูลนักศึกษา และจัดการได้
	public function StudentCommand(){ //ข้อมูลนักศึกษา และจัดการได้ (ใช้ร่วมกันกับการจัดการเอกสารทั้งหมด)
		// รหัส นักศึกษา
		$input = $this->uri->segment(3);
		// ประเภทเอกสาร
		$type = $this->uri->segment(4);
		// ภาระงานสูงสุด
		$limit = $this->db->get('setting_work_limit');
		$limit = $limit->result_array();
		// รายชื่ออาจารย์ที่ปรึกษา
		$AdviserList = $this->graduatemodel->AdviserList($input);
		$i = 0;
		// ภาระงานของอาจารย์ที่ปรึกษา
		for ($r = 1; $r <= count($AdviserList); $r++) {
			$input2 = $AdviserList[$i]['OFFICERID'];
			//วิทยานิพนธ์ 5
			$AdviserList[$i]['AMT_STD1'] = $this->graduatemodel->AdviserCountAllTheis1($input2);
			//ค้นคว้าอิสระ 15
			$AdviserList[$i]['AMT_STD2'] = $this->graduatemodel->AdviserCountAllTheis2($input2);
			$i++;
		}
		// ภาระงาน เต็ม/ไม่เต็ม
		$Lock = 0;
		$limitIS = $limit[0]['officer_work_limit_is'];
		$limitThesis = $limit[0]['officer_work_limit_thesis'];
		$countAdviserList = $AdviserList;
		foreach ($countAdviserList as $countAdviserList){
			if($countAdviserList['AMT_STD1']>=$limitIS || $countAdviserList['AMT_STD2']>=$limitThesis){
				$Lock = 1;
			}
		}

		// เอกสารขอสอบ
		// QE/CE

		$doc_exam = $this->db->where('STUDENTID', $input)->get('doc_exam')->result_array();
		$doc_app = array();
		foreach ($doc_exam as $doc_list) {
				$doc_app[$doc_list['EXAM_TYPE']] = $doc_list['EXAM_RESULT'];
		}

		$doc_adviser = $this->db->where('STUDENTID', $input)->get('doc_adviser')->result_array();
		$relate_adviser = $this->db
							->where('doc_approved_type', 'ADVI')

							->where('doc_approved_ref', $doc_adviser[0]['APPOINT_AVISER_ID'])
							->join('doc_adviser', 'relate_doc_approved.doc_approved_ref = doc_adviser.APPOINT_AVISER_ID')
							// ->join('relate_doc_approved', 'doc_adviser.APPOINT_AVISER_ID = relate_doc_approved.doc_approved_ref')
							->get('relate_doc_approved')->result_array();
		foreach ($doc_adviser as $doc_list) {
				if ($this->graduatemodel->DocAdviserStatus($doc_list['APPOINT_AVISER_ID'])>=1) {
					$doc_app['ADVI'] = 1;
				} else {
					$doc_app['ADVI'] = 0;
				}
		}
		// $this->debuger->prevalue($relate_adviser);
		// $this->db->join('officer', 'relate_officer_exam.OFFICERID = officer.OFFICERID');
		$exem_officer = $this->db->join('officer', 'relate_officer_exam.OFFICERID = officer.OFFICERID')->get('relate_officer_exam')->result_array();

		$StrQuery = array(
				// ข้อมูล
				'Result' => array(
						'Student' => $this->graduatemodel->StudentInfoByID($input), //ข้อมูลนึกศึกษา
						'DocAdviser' => $this->graduatemodel->DocAdviser($input), //
						'RelateAdviser' => $relate_adviser, //
						'AdviserList' => $AdviserList, // อาจารย์ พร้อมภาระงาน
						'Lock' => $Lock,
						'type' => $type,
						'DocStatus' =>$doc_app,
						'limitIS' => $limitIS,
						'limitThesis' => $limitThesis,
						'officerList' => $this->graduatemodel->officerList(),
						'ExamDoc' => $doc_exam,
						'ExamOfficer' => $exem_officer,
					),
				// ชื่อหน้าเว็บ
				'namepage' =>'ข้อมูลนักศึกษา' ,
				// ไฟล์หน้าเว็บ
				'View' => 'Faculty/Pages/Students/StudentCommand'
			);
			// $this->debuger->prevalue($StrQuery['Result']['ExamOfficer']);
			// Load หน้าจอ
			$this->loadpage($StrQuery);
	}
	// คำสั่งจัดการ เอกสาร
	public function SaveApproved(){ // อนุมัติอาจารย์ที่ปรึกษา
		$ExamType = $this->uri->segment(3);
		$DocID = $_POST['doc_id'];
		$ApprovedBy = $_POST['ApprovedBy'];

		$input = array(
					'doc_approved_status' => 1,
					'doc_approved_date' => $_POST['doc_date'],
					);
				//$this->debuger->prevalue($ExamType);
		if($ExamType=="ADVI"){

			$this->db->where('doc_approved_by', $ApprovedBy);
			$this->db->where('doc_approved_ref', $DocID);
			$this->db->where('doc_approved_type', $ExamType);
			$this->db->update('relate_doc_approved', $input);
		}

 // exit();
		redirect($this->agent->referrer(), 'refresh');
	}
	public function QECEApproved(){ // จัดการสอบ
		$input = array(
		'EXAM_ID' => $_POST['docid'],
		'EXAM_DATE' => date($_POST['exam_date']),
		'EXAM_BUILD' => $_POST['exam_build'],
		'EXAM_ROOM' => $_POST['exam_room'],
	  );
		// $this->debuger->prevalue($input);
		$this->db->where('EXAM_ID', $input['EXAM_ID']);
		$this->db->update('doc_exam_qece', $input);
		redirect($this->agent->referrer(), 'refresh');
	}
	public function PropersalApproved(){ // จัดการสอบ
		$input = array(
		'EXAM_ID' => $_POST['docid'],
		'EXAM_DATE' => date($_POST['exam_date']),
		'EXAM_BUILD' => $_POST['exam_build'],
		'EXAM_ROOM' => $_POST['exam_room'],
		);
		// $this->debuger->prevalue($input);
		$this->db->where('EXAM_ID', $input['EXAM_ID']);
		$this->db->update('doc_exam_proposal', $input);
		redirect($this->agent->referrer(), 'refresh');
	}
	public function ThesisApproved(){
		$input = array(
		'EXAM_ID' => $_POST['docid'],
		'EXAM_DATE' => date($_POST['exam_date']),
		'EXAM_BUILD' => $_POST['exam_build'],
		'EXAM_ROOM' => $_POST['exam_room'],
	  );
		// $this->debuger->prevalue($input);
		$this->db->where('EXAM_ID', $input['EXAM_ID']);
		$this->db->update('doc_exam_thesis', $input);
		redirect($this->agent->referrer(), 'refresh');
	} // จัดการสอบ
	public function Exam_Officer(){
		$input = array(
			'OFFICERID' => $_POST['OFFICERID'],
			'OFFICER_POSITION' => $_POST['OFFICER_POSITION'],
			'EXAM_TYPE' => $_POST['EXAM_TYPE'],
			'EXAMREF' => $_POST['EXAMREF'], );
			// $this->debuger->prevalue($input);
			$this->db->insert('relate_officer_exam', $input);
			redirect($this->agent->referrer(), 'refresh');
	}

	// คำสั่งจัดการ ผลสอบ
	public function QECEResult(){}
	public function PropersalResult(){}
	public function ThesisResult(){}
	//////////////////////////////////////////////////////////////////////////////
	// อาจารย์
	// ------------------
	// รายชื่อ อาจารย์
	public function OfficerList(){
		$StrQuery = array(
			'Result' => $this->officermodel->officersall(), // Query
			'View' => 'Faculty/Pages/Officers/OfficerList' // View
		);
		$this->loadpage($StrQuery);
	}
	// ข้อมูลอาจารย์
	public function Officerinfo(){
		$input = $this->uri->segment(3);
		$StrQuery = array(
			'Result' => array(
				'OfficerDetail' => $this->officermodel->OfficerDetail($input),
				'StudentByOfficerMainThesis' => $this->graduatemodel->StudentByOfficerMainThesis($input),
				'StudentByOfficerCoThesis' =>$this->graduatemodel->StudentByOfficerCoThesis($input),
				'StudentByOfficerMainIs' =>$this->graduatemodel->StudentByOfficerMainIs($input),
				'WorkByOfficer' =>$this->officermodel->WorkByOfficer($input)
			),
			'namepage' =>'ข้อมูลอาจารย์' ,
			'View' => 'Faculty/Pages/Officers/OfficerInfo'
		);

		$this->loadpage($StrQuery);
	}
	// แก้ไข รูปภาพอาจารย์
	public function OfficerPicProfile(){
		$OFFICERID = $this->input->post('OFFICERID');
		$OFFICERCODE = $this->input->post('OFFICERCODE');
		$file = $_FILES["image"]["tmp_name"];
		$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
		$new_file = 'img_'.$OFFICERID.'_'.$OFFICERCODE.'.'.$ext;

		if( $ext == "png" || $ext == "jpg" || $ext == "PNG" || $ext == "JPG"  )
		{
			copy($file, "image/officer/".$new_file);
		}
		else
		{
			echo $ext;
			exit();
		}

		$input = array(
			'OFFICERID' => $OFFICERID,
			'OFFICER_PIC' => $new_file
		);
		// echo "<pre>";
		// print_r($input);
		// exit();
		$this->officermodel->SaveOfficerPic($input);
		redirect('graduate/OfficerInfo/'.$OFFICERID);
	}

	//////////////////////////////////////////////////////////////////////////////
	// หลักสูตร
	// ------------------
	//รายการหลักสูตร และค้นหา
	public function ProgramsSearch(){

		$StrQuery = array(
			'Result' => "",
			'namepage' =>'ข้อมูลหลักสูตร' ,
			'View' => 'Faculty/Pages/Programs/ManagePrograms'
		);
		$this->loadpage($StrQuery);
	}
	//ผลการค้นหา
	public function ProgramsResult(){
		$input = array(
			'PROGRAMNAME' => $this->input->post('programname'),
			'FACULTYNAME' => $this->input->post('facultyname'),
			'DEPARTMENTNAME' => $this->input->post('departmentname'),
			'LEVELNAME' => $this->input->post('levelname'),
			'PROGRAMYEARfor' => $this->input->post('programyearfor'),
			'PROGRAMYEARto' => $this->input->post('programyearto'),
		);
		//echo "<pre>";
		//			print_r($input);
		//			exit();

		$allprog = $this->programsmodel->ProgramsFilter($input);
		//	echo "<pre>";
		//			print_r($allprog);
		//		exit();
		$i = 0;
		for ($r = 1; $r <= count($allprog); $r++) {
			$input = $allprog[$i]['PROGRAMID'];
			$allprog[$i]['AMT_STD'] = $this->programsmodel->programswithstd($input);
			$i++;
		}
		$StrQuery = array(
			'Result' => $allprog,
			'namepage' =>'ข้อมูลหลักสูตร' ,
			'View' => 'Faculty/Pages/Programs/ManageProgramsbyFilter');

			$this->loadpage($StrQuery);
		}
	//ข้อมูลหลักสูตร แบบแก้ไขได้
	public function FormEditProgram() {

		$input = $this->uri->segment(3);
		$progOfficer = $this->officermodel->officersByProg($input);

		$StrQuery = array(
			'Result' => array(
									'STDYLEVEL' => $this->lvlstudymodel->lvlall(),
									'FACULTY' => $this->facultymodel->facultyall(),
									'DEPARTMENT' => $this->departmentmodel->departmentall(),
									'OFFICER' => $this->officermodel->officersall(),
									'OFFICER_NEW' => $this->officermodel->officersall(),
									'OFFICER_LI' => $progOfficer,
									'PROGRAM' => $this->programsmodel->programinfo($input),
									'PROGRAM_STRUC' => $this->programsmodel->programstrucbyprogram($input)),

			'View' => 'Faculty/Pages/Programs/FormAddProgram');


			//$this->debuger->prevalue($StrQuery);

			$this->loadpage($StrQuery);
	}
	// ปิดการใช้ หลักสูตร
	public function DeactiveProgram(){
			$PROGRAMID = $this->uri->segment(3);
			$Prog = $this->db->where('PROGRAMID', $PROGRAMID)->get('program')->result_array();
			// $this->debuger->prevalue($PROGRAMID);
			if ($Prog[0]['PROGRAM_STATUS']==1) {
				$PROGRAM_STATUS = 2;
			} else {
				$PROGRAM_STATUS = 1;
			}
			$input = array(
				'PROGRAMID' => $PROGRAMID,
				'PROGRAM_STATUS' => $PROGRAM_STATUS
			);
			$this->programsmodel->deactiveProgram($input);
			redirect($this->agent->referrer());
		}
  // บันทึก หลักสูตร ใหม่ = insert // เก่า update
	public function SaveProgram(){
			$input = array(
				//รหัสหลักสูตร
				'PROG_NUM'  => $this->input->post('PROG_NUM'),
				'PROGRAMID' => $this->input->post('PROGRAMID'),
				//ชื่อหลักสูตร
				'PROGRAMCODENAME' => $this->input->post('PROGRAMCODENAME'),
				'PROGRAMCODENAMEENG' => $this->input->post('PROGRAMCODENAMEENG'),
				'PROGRAMYEAR' => $this->input->post('PROGRAMYEAR'),
				// //ชื่อปริญญาและสาขาวิชา
				'LEVELID' => $this->input->post('LEVELID'),
				'PROGRAMNAME' => $this->input->post('PROGRAMNAME'),
				'PROGRAMABB' => $this->input->post('PROGRAMABB'),
				'PROGRAMNAMEENG' => $this->input->post('PROGRAMNAMEENG'),
				'PROGRAMABBENG' => $this->input->post('PROGRAMABBENG'),
				// //อาจารย์ประจำหลักสูตร

				// //คชจ.
				'PROGRAM_COST' => $_POST['PROGRAM_COST'],
				//วันที่
				'CREATEDATE' =>$this->input->post('CREATEDATE'),
				'OPENDATE' => $this->input->post('OPENDATE'),
				'CLOSEDATE' => $this->input->post('CLOSEDATE'),

				//คณะ สาขา
				'FACULTYID' => $this->input->post('FACULTYID'),
				'DEPARTMENTID' => $this->input->post('DEPARTMENTID'),
			);



			if ($input['PROG_NUM']=="") {
				$this->programsmodel->insertnewprogram($input);
			} else {

				$this->programsmodel->updateprogram($input);
			}
			redirect('graduate/FormEditProgram/'.$input['PROGRAMID']);
		}
  // บันทึกโครงสร้างหลักสูตร
	public function SaveStructure() {

		$input = array (
		'PROGRAMSTRUCTUREID' => $this->input->post('PROGRAMSTRUCTUREID'),
		'PROGRAMID' => $this->input->post('PROGRAMID'),
		'PROGRAMPLAN' => $this->input->post('PROGRAMPLAN'),
		'MAXCREDIT' => $this->input->post('MAXCREDIT'),
		'PROGRAMPLAN' => $this->input->post('PROGRAMPLAN'),
		);


		if($input['PROGRAMSTRUCTUREID']==""){
			//Save New
			$this->programsmodel->insertNewProgStruc($input);
		} else {
			//Edit
			$this->programsmodel->updateProgStruc($input);
		}

		redirect('graduate/FormEditProgram/'.$input['PROGRAMID']);
	}
	// ลบ อาจารย์ในหลักสูตร
	public function SaveOfficerToProg(){
		$input = array(
			'OFFICERID' => $_POST['OFFICER_NEW'],
			'PROGRAMID' => $_POST['PROGRAMID'],
			'PROG_OFFICER_POSITION' => $_POST['ChkPresident'], );
							// $input = $this->uri->segment(3);
							$this->programsmodel->insertNewOfficerList($input);
							redirect($this->agent->referrer());
						}
	// ลบ อาจารย์ในหลักสูตร
	public function DelOfficerFromList(){
							$input = $this->uri->segment(3);
							$this->programsmodel->DelOfficerFromList($input);
							redirect($this->agent->referrer());
						}
	// ลบโครงสร้างหลักสูตร
	public function DelStructure() {

		$input = $this->uri->segment(3);
		$ProgID = $this->uri->segment(4);

		$this->programsmodel->delProgStruc($input);

		redirect('graduate/FormEditProgram/'.$ProgID);
	}
	// สั่งพิมพ์ วิชาเรียน
	public function PrintingCourse() {
		if ($this->uri->segment(3) === FALSE) {
			redirect('/GraduateManageCourse/0');
		} else {
			$input = $this->uri->segment(3);
		}

		$StrQuery = array(
			'Result' => "",
			'View' => 'Faculty/Pages/GraduatePrintingCourse'
		);
		$this->loadpage($StrQuery);
	}
	// ค้นหาวิทยานิพนธ์
	public function SearchThesis(){
		//Array (Result, View)
		$StrQuery = array(
			'Result' => $this->graduatemodel->ThesisAll(),
			'namepage' =>'ค้นหางานวิทยานิพนธ์' ,
			'View' => 'Template/SearchThesis'
		);

		//Generate View
		$this->loadpage($StrQuery);
	}
	// ค้นหางานวิจัย
	public function SearchResearch(){
		//Array (Result, View)

		if(isset($_POST['submitBtn']) == "ค้นหา"){
			$stdID = $this->graduatemodel->getStudentID($_POST['stdcode']);
			//	print_r($stdID);
			$arrayName = array(
				'STUDENTID' =>isset($stdID[0]['STUDENTID']) ? $stdID[0]['STUDENTID'] : "",
				'RESEARCHCODE' =>$_POST['researchcode'] ,
				'FACULTYID' =>$_POST['facultyid'] ,
				'DEPARTMENTID' =>$_POST['departmentid'] ,
				'LEVELID' =>$_POST['levelid']
			);
			$data['researchInfo'] = $this->graduatemodel->getResearchInfo($arrayName);
		}

		// print_r($data['researchInfo']);
		// exit();
		$data['facultyLists'] = $this->graduatemodel->facultyLists();
		$data['departmentLists'] = $this->graduatemodel->departmentLists();
		$data['level'] = $this->graduatemodel->levelIDLists();
		//$this->graduatemodel->ResearchAll();
		$StrQuery = array(
			'Result' => $data,
			'namepage' =>'ค้นหางานวิจัย' ,
			'View' => 'Template/SearchResearch'
		);
		//Generate View
		$this->loadpage($StrQuery);
	}

	//
	public function searchOfficer(){
		$this->db->like('STUDENTCODE',$_POST['STUDENTCODE']);
		$this->db->or_like('STUDENTNAME',$_POST['STUDENTFULLNAME']);
		$this->db->or_like('STUDENTSURNAME',$_POST['STUDENTFULLNAME']);

		$this->db->join('student_master', 'doc_adviser.STUDENTID = student_master.STUDENTID','LEFT');
    $this->db->join('attribute_prefix', 'student_master.PREFIXID = attribute_prefix.PREFIXID');
    $this->db->join('attribute_faculty', 'student_master.FACULTYID = attribute_faculty.FACULTYID','LEFT');
    //$this->db->join('attribute_department', 'student_master.DEPARTMENTID = attribute_department.DEPARTMENTID','LEFT');
    $this->db->join('attribute_level', 'student_master.LEVELID = attribute_level.LEVELID','LEFT');
    $this->db->join('attribute_procedure_study', 'student_master.procedure_study_id = attribute_procedure_study.procedure_study_id','LEFT');
    $this->db->join('attribute_student_status', 'student_master.STUDENTID = attribute_student_status.STUDENTID','LEFT');

    $query = $this->db->get('doc_adviser');
		$query->result_array();
		$StrQuery = array(
			'Result' => $query->result_array(),
			'namepage' =>'แต่งตั้งอาจารย์ที่ปรึกษา' ,
			'View' => 'Faculty/Pages/Students/ApprovedAdvisorList'
		);
		$this->loadpage($StrQuery);

	}
 //

	public function student_thesis_is_info(){
							$student_id = $this->uri->segment(3);
							$student_info = $this->graduatemodel->StudentInfo2($student_id);
							$std_ts_is_info = $this->graduatemodel->student_thesis_is_info($student_id);
							$StrQuery = array(
								'Result' => array(
									'student_info' =>$student_info,
									'std_ts_is_info' =>$std_ts_is_info,
									'Student' => $this->graduatemodel->StudentInfo2($student_id),
									'type' => 'studentInfo',

								),
								'namepage' =>'ข้อมูลนักศึกษา' ,
								'View' => 'Template/StudentInfo'
							);
							$this->loadpage($StrQuery);
						}

					}

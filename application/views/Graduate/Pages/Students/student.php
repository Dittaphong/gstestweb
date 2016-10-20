<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
	}
	public function index()
	{
		//Input
		$input = $_SESSION['USERCODE'];
		//Array (Result, View)
		$studentID = $this->studentsmodel->StudentInfo($input);
		//echo "<pre>";
//		print_r($input);
//		print_r($studentID);
//		exit();
		$_SESSION['STUDENTID']=$studentID[0]['STUDENTID'];
		$_SESSION['LEVELID'] = $studentID[0]['LEVELID'];
		$_SESSION['STUDENTCODE']=$_SESSION['USERCODE'];
		//print_r($_SESSION['STUDENTID']);
		// $Result1 = $this->studentsmodel->StudentInfo($_SESSION['STUDENTID']);

		$Result2 = $this->studentsmodel->studentTranscriptInfo($_SESSION['STUDENTID']);

		$StrQuery = array(
			'Result' => array(
				'StudentInfo' => $studentID,
				'Transcript' => $Result2,
				'namepage' =>'Dashboard',
			),
			'View' => '/Student/Dashboard',
		);

		//Generate View

		$this->loadpage($StrQuery);
	}

	public function LoadPage($StrQuery)
	{
		// View
		$this->load->view('/Template/Header', $StrQuery);
		$this->load->view($StrQuery['View']);
		$this->load->view('/Template/Footer');
	}

	public function Login()
	{
		$this->load->view('/Student/Login');
	}

	public function AuthenStudent()
	{
		$input = array(
			'userName' => $this->input->post('userName'),
			'password' => MD5($this->input->post('password')),
		);

		$Authen = $this->Studentsmodel->AuthenStudent($input);

		if(isset($Authen) || count($Authen)>0){
			$_SESSION['STUDENTCODE'] = $Authen[0]['USERCODE'];
			$_SESSION['GROUPTYPE'] = $Authen[0]['GROUPTYPE'];
			redirect('Student/StudentProfile');
			console.log($_SESSION['STUDENTCODE']);
		}
		else
		{
			redirect('Student');
		}
	}

	public function StudentProfile()
	{
		//Input
		$studentID = $this->Studentsmodel->GetStudentId($_SESSION['STUDENTCODE']);
		$input = $studentID[0]['STUDENTID'];
		//Array (Result, View)
		$data['Result'] = $this->Studentsmodel->StudentInfo($input);
		//$_SESSION['STUDENTID']=$data['Result'][0]['STUDENTID'];

		$data['transcript'] = $this->Studentsmodel->studentTranscriptInfo($input);
		$StrQuery = array(
			'data' => $data,
			'menuactive'=>1,
			'View' => '/Student/Components/StudentProfile'
		);
		$_SESSION['LEVELID'] = $data['Result'][0]['LEVELID'];
		//Generate View
		$this->LoadPage($StrQuery);
	}

	public function adviser($param1='1'){
		// แต่งตั้งอาจารย์ที่ปรึกษา
		$param1 =$this->uri->segment(3);

		// ถ้ากดปุ่ม submit ให้ส่งค่าจาก form หน้าที่ 1 ไปหน้าเอกสาร ที่ 2
		// ให้ $param1 =2 และทำการ ดึงข้อมูลอาจารย์ที่ปรึกษาและนักศึกษามาแสดง
		if($param1 =='2'){
			if(isset($_POST['appoint_advisor_btn'])){
				$data['adviser'] =$this->studentsmodel->AdviserInfo($_POST['adviser']);
				if(isset($_POST['sub_adviser1']))
				$data['sub_adviser1'] =$this->studentsmodel->AdviserInfo($_POST['sub_adviser1']);
				if(isset($_POST['sub_adviser2']))
				$data['sub_adviser2'] =$this->studentsmodel->AdviserInfo($_POST['sub_adviser2']);
			}//print_r($data['adviser']);
		}
		if($param1 =="3"){
			//ถ้าทำการกดปุ่มจากหน้า 2 หน้าเอกสาร เพื่อนำค่าจาก form เอกสารมาทำการบันทึกลง
			//ทำการ select appoint_adviser_is_thesis โดย check paper_type  แล้วเอา row ล่าสุด
			//เพื่อเอามา generate APPOINT_AVISER_ID

			$data1 = array(
				'STUDENT_ID' => $_SESSION['STUDENTID'],
				'ADVISER_ID' => $_POST['adviser_id'],
				'SUBADVISER1' => isset($_POST['adviser1_id'])? $_POST['adviser1_id'] : "-",
				'SUBADVISER2' => isset($_POST['adviser2_id'])? $_POST['adviser2_id'] : "-",
				'ATTACHMENT_IS_THESIS1'	=> isset($_POST['attachfile1'])? $_POST['attachfile1'] : "-",
				'ATTACHMENT_IS_THESIS2'	=> isset($_POST['attachfile2'])? $_POST['attachfile2'] : "-",
				'APPOINT_AVISER_IS_THESIS_DATE'	=> date("Y-m-d"),
				'APPOINT_AVISER_IS_THESIS_TYPE' =>$_SESSION['LEVELID'] ==82 ? "AP-IS" : "AP-TS",
			);
			$this->studentsmodel->insert('appoint_adviser_is_thesis',$data1);
			$appointAdInfo = $his->studentsmodel->Select('appoint_adviser_is_thesis',
			array('STUDENT_ID'=>$_SESSION['STUDENTID']),1,"");

			//บันทึกข้อมูลเข้า adviser table
			$adviser  = array('OFFICERID' => $_POST['adviser_id'],
							  'ADVISERPOSITION'=> 1,
							  'ADVISERTYPE' => 1,
							   'STUDENTID'=>$_SESSION['STUDENTID'],
							   'COMMAND_No' =>'-',
							   'ADVISERDATE'=>date("Y-m-d")
						);
			$this->studentsmodel->insert('adviser',$adviser);
			if($appointAdInfo[0]['SUBADVISER1'] !="-"){
				$adviser1  = array('OFFICERID' => $_POST['adviser1_id'],
							  'ADVISERPOSITION'=> 1,
							  'ADVISERTYPE' => 2,
							   'STUDENTID'=>$_SESSION['STUDENTID'],
							   'COMMAND_No' =>'-',
							   'ADVISERDATE'=>date("Y-m-d")
						);
				$this->studentsmodel->insert('adviser',$adviser1);
			}
			
			if($appointAdInfo[0]['SUBADVISER2'] !="-"){
				$subadviser2  = array('OFFICERID' => $appointAdInfo[0]['SUBADVISER2'],
							  'ADVISERPOSITION'=> 1,
							  'ADVISERTYPE' => 2,
							   'STUDENTID'=>$_SESSION['STUDENTID'],
							   'COMMAND_No' =>'-',
							   'ADVISERDATE'=>date("Y-m-d")
						);
				$this->studentsmodel->insert('adviser',$subadviser2);
			}
			$data['param1']=3;
		}


		if($param1 =='5'){
			$appointAdInfo = $this->studentsmodel->Select('appoint_adviser_is_thesis',
			array('STUDENT_ID'=>$_SESSION['STUDENTID']),1,"");
			
			$data['adviser'] =$this->studentsmodel->AdviserInfo($appointAdInfo[0]['ADVISER_ID']);
			if($appointAdInfo[0]['SUBADVISER1'] !="-")
				$data['sub_adviser1'] =$this->studentsmodel->AdviserInfo($appointAdInfo[0]['SUBADVISER1']);
			if($appointAdInfo[0]['SUBADVISER1'] !="-")
				$data['sub_adviser2'] =$this->studentsmodel->AdviserInfo($appointAdInfo[0]['SUBADVISER2']);
			
		}


		$appointAdInfo = $this->studentsmodel->Select('appoint_adviser_is_thesis',
			array('STUDENT_ID'=>$_SESSION['STUDENTID']),1,"");
		if(count($appointAdInfo)>0){
			$data['param1'] =4;
		}
		
		$studentInfo = $this->studentsmodel->StudentInfo($_SESSION['STUDENTCODE']);

		$data['param1']=$param1;
		$data['officerList'] = $this->studentsmodel->officerList();
		$data['adviserList'] = $this->studentsmodel->AdviserList($_SESSION['STUDENTID']);
		$namepage= $_SESSION['LEVELID'] ==82 ? 'ขอแต่งตั้งอาจารย์ที่ปรึกษาค้นคว้าอิสระ' :'ขอแต่งตั้งอาจารย์ที่ปรึกษาวิทยานิพนธ์' ;
		// echo "<pre>";
		// print_r($appointAdInfo);
		$StrQuery = array(
			'Result'=>array(
				'studentInfo' =>$studentInfo ,
				'data' => $data,
				'namepage'=>$namepage,
				'appointAdInfo' => isset($appointAdInfo)? $appointAdInfo :array()
			),
			'View' => '/Student/Components/AppointAdviser',

		);
		$this->LoadPage($StrQuery);
	}

	public function ceqe($param1='1'){
		$studentId = $_SESSION['STUDENTID'];
		$param1 = $this->uri->segment(3);

		if($param1 ==3){
			$this->session->set_userdata('ceqe_status', $this->uri->segment(3));
		}

		if($param1 ==2 || $param1 ==3){
			$data['studentInfo'] = $this->studentsmodel->StudentInfo($studentId);
			$data['dateArr'] = $this->dateArray();

			if(isset($_POST['printBth'])){
				 $papertype =$this->session->userdata('studentType')=="TS" ? "QE" : "CE";//"CE";
				//getLastRow($table,$condition,$id){
				$a = $this->studentsmodel->getLastRow('ce_qe_exam',array('ce_qe_type' => $papertype), 'CE_QE_ID' );
				$rowcount =  count($a)+1;
			    $printyear = date('Y');
				$examyear = trim($_POST['examyear'])-543;
				$ceQeId = $papertype."-".$studentId."-".$rowcount;
				$arr = array('STUDENTID' =>$_SESSION['STUDENTID'],'ADVISERTYPE'=>1);
				$adviser = $this->studentsmodel->Select('adviser', $arr,1,1);
				$data = array(
					'CE_QE_EXAM_ID' => $ceQeId,
					'ce_qe_type' =>$papertype,
					'STUDENTID' => $_SESSION['STUDENTID'],
					'ADVISERID' => isset($adviser['ADVISERID']) ? $adviser['ADVISERID'] :'-' ,
					'ATTACH1' => isset($_POST['attach1']) ? $_POST['attach1'] : "-",
					'ATTACH2' => isset($_POST['attach2']) ? $_POST['attach2'] : "-",
					'ATTACH3' => isset($_POST['attach3']) ? $_POST['attach3'] : "-",
					'SEMESTER_EXAM' => $_POST['exam_semester'],
					'ADCADYEAR_EXAM' => $_POST['exam_acadyear'],
					'EXAM_DATE' =>$examyear."-".$_POST['printmonthhidden']."-".$_POST['examdate'],
					'EXAM_STATUS'=>2,
					'PRINT_DATE' => $printyear."-".date('m')."-".date('d'),
				);
				$this->studentsmodel->insert('ce_qe_exam',$data);
				$doc_status = $papertype=="CE" ? 2 : 3;
				$this->studentsmodel->insert('document_index',
				array('doc_index_std_id'=>$_SESSION['STUDENTID'],'doc_index_doc_id'=>$ceQeId,
				'doc_index_doc_status'=>$doc_status));
				
				$this->studentsmodel->update('studentmaster',array('procedure_study'=>$doc_status,
				'procedure_study_id'=>2),array('STUDENTID',$_SESSION['STUDENTID']));

				
				$_SESSION['print_status'] = $this->uri->segment(4);
				//ดึงข้อมูลการสอบ วัดคุณสมบัติของ user
				$data['ce_qe_info'] =$this->studentsmodel->Select('ce_qe_exam',
				array('STUDENTID'=>$_SESSION['STUDENTID'],'CE_QE_EXAM_ID'=>$ceQeId),1,'CE_QE_EXAM_ID');

				//$data['examdate'] = $this->dateFormat($data['ce_qe_info'][0]['EXAM_DATE']);

				$param1=3;
			}
		}



		if($param1 ==1 || $param1 ==4){
			//check ว่าเคยสอบหรือยัง
			$condition = array('STUDENTID'=>$_SESSION['STUDENTID']);
			//$table,$data,$limit,$index
			$data['ce_qe_info'] =$this->studentsmodel->Select('ce_qe_exam',$condition,'*','CE_QE_EXAM_ID');
		}
		$data['studentInfo'] = $this->studentsmodel->StudentInfo($_SESSION['STUDENTCODE']);
		$data['param1']=$param1;
		$data['transcriptInfo'] = $this->studentsmodel->studentTranscriptInfo($_SESSION['STUDENTID']);

		//$data['is_thesis_propersal_exam'] =$this->studentsmodel->is_thesis_propersal_exam($_SESSION['STUDENTID']);
		//$data['examcount'] =count($data['ce_qe_info']);
		$namepage= $_SESSION['LEVELID'] <90 ? 'ขอสอบประมวลผลความรู้' : 'ขอสอบวัดคุณสมบัติ';
		$data['papertype']= $_SESSION['LEVELID'] <90 ? 'IS' :'TS';

		$StrQuery = array(
			'Result'=>array(
				'data' => $data,
				'namepage'=>$namepage,
			),
			'View' => '/Student/Components/CeQeExam'
		);
		$this->LoadPage($StrQuery);
	}

	public function SendTopicThesisAndIS($param1='1'){
		$studentId = $_SESSION['STUDENTID'];

		if($param1 ==2){
			if(isset($_POST['topicPropersal'])){
				if($_POST['name_th'] =="" || $_POST['name_en']==""){
				 	$data['name_th_err'] = $_POST['name_th'] =="" ? "กรุณากรอกห้วข้อภาษาไทย" : "";
					$data['name_en_err'] = $_POST['name_en'] =="" ? "กรุณากรอกห้วข้อภาษาอังกฤษ" : "";
					$data['name_th']  ="";
					$data['name_en']  ="";
					$_SESSION['dataArr'] = $data;

					redirect("/Student/SendTopicThesisAndIS/","refresh");
				}
				else{
					$lastrow = $this->studentsmodel->getLastRow('thesis',array('STUDENTID'=>$studentId),'STUDENTID');
					$thesiscode = "TP-".$studentId.count($lastrow)+1;
					$dataArr = array(
						'THESISCODE'=>$thesiscode,
						'STUDENTID'=>$studentId,
						'THESISNAME' =>$_POST['name_th'] ,
						'THESISNAMEENG' =>$_POST['name_en'] 
					);
					$this->studentsmodel->insert('thesis',$dataArr);
					$data['name_th'] =$_POST['name_th'];
					$data['name_en'] =$_POST['name_en'];
					$data['thesiscode'] = $thesiscode;
				}
				$param1 =2;
			}
		}
		$data['namepage']=	$_SESSION['LEVELID'] ==82 ? 'ยื่นหัวข้อค้นค้วาอิสระ' :'ยื่นหัวข้อวิทยานิพนธ์';

		$StrQuery = array(
			'Result'=>array(
				'namepage' =>$data['namepage'],
				'data' =>$data,
				'param1' => $param1,
			),
			'View' => '/Student/TermpaperConfirm'
		);
		$this->LoadPage($StrQuery);
	}

	public function DefendPropersalThesisIS($param1='1'){
		$data['confirm_insert_data'] =false;
		$propersaltype = 	$_SESSION['LEVELID'] ==82 ? 'IS' :'TS';
		$TITLE_TYPE_PAPER = 'PP-'.$propersaltype.'-'.$_SESSION['STUDENTID'];

		if(isset($_POST['printBth'])){
			
			$adviserlist = $this->studentsmodel->AdviserList($_SESSION['STUDENTID']);
			$data = array(
				'TITLE_TYPE_PAPER' => $TITLE_TYPE_PAPER ,
				'STUDENTID' => $_SESSION['STUDENTID'],
				'ADVISER_ID' => $adviserlist[0]['OFFICERID'],
				'EXAM_PROPOSAL_IS_THESIS_TYPE'=> 'PP-'.$propersaltype,
				'DOCUMENTSTATUS' =>1,
				// 'SUBADVISER1' =>$adviserlist[0]['OFFICERID'],
				// 'SUBADVISER2' =>$adviserlist[0]['OFFICERID']
			);

			$this->studentsmodel->insert('exam_proposal_thesis_is',$data);
			$data['confirm_insert_data'] =true;

			
			
		}
		$where = array('TITLE_TYPE_PAPER'=> $TITLE_TYPE_PAPER, 'STUDENTID'=>$_SESSION['STUDENTID'] );
		$data['examPropersalInfo'] = $this->studentsmodel->Select('exam_proposal_thesis_is',$where,'*','EXAM_PROPOSAL_THESIS_IS_ID');
		$data['studentInfo'] = $this->studentsmodel->StudentInfo($_SESSION['STUDENTCODE']);
		$data['show_exampaper'] = $this->uri->segment(4);
		$namepage=$_SESSION['LEVELID'] ==82 ? "สอบเค้าโครงการค้นคว้าอิสระ" : "สอบเค้าโครงวิทยานิพนธ์";
		$StrQuery = array(
			'Result' =>array(
				'data' => $data,
				'namepage'=> $namepage,
				'param1' =>$param1,
			),
			'View' => '/Student/Components/DefendPropersalThesisIS'
		);
		$this->LoadPage($StrQuery);
	}

	public function DefendThesisIS($param1='1'){

		$propersaltype = 	$_SESSION['LEVELID'] ==82 ? 'IS' :'TS';
		$TITLE_TYPE_PAPER = $propersaltype.'-'.$_SESSION['STUDENTID'];
		
		//checkว่าสอบ propersal ผ่านหรือยัง
		$where = array(
			'TITLE_TYPE_PAPER'=> 'PP-'.$TITLE_TYPE_PAPER, 
			'STUDENTID'=>$_SESSION['STUDENTID'],
			'DOCUMENTSTATUS' =>1,
			 );
		$data['examPropersalInfo'] = $this->studentsmodel->Select('exam_proposal_thesis_is',$where,'*','EXAM_PROPOSAL_THESIS_IS_ID');
		$propersaltype = 	$_SESSION['LEVELID'] ==82 ? 'IS' :'TS';
		$TITLE_TYPE_PAPER = $propersaltype.'-'.$_SESSION['STUDENTID'];

		if(isset($_POST['printBth'])){
			
			$adviserlist = $this->studentsmodel->AdviserList($_SESSION['STUDENTID']);
			$data = array(
				'TITLE_TYPE_PAPER' => $TITLE_TYPE_PAPER ,
				'STUDENTID' => $_SESSION['STUDENTID'],
				'ADVISER_ID' => $adviserlist[0]['OFFICERID'],
				'EXAM_PROPOSAL_IS_THESIS_TYPE'=> $propersaltype,
				'DOCUMENTSTATUS' =>1,
				// 'SUBADVISER1' =>$adviserlist[0]['OFFICERID'],
				// 'SUBADVISER2' =>$adviserlist[0]['OFFICERID']
			);

			$this->studentsmodel->insert('exam_proposal_thesis_is',$data);

			
			
		}
		$where = $where = array(
			'TITLE_TYPE_PAPER'=> $TITLE_TYPE_PAPER, 
			'STUDENTID'=>$_SESSION['STUDENTID'],
			 );
		$data['examThesisISInfo'] = $this->studentsmodel->Select('exam_proposal_thesis_is',$where,'*','EXAM_PROPOSAL_THESIS_IS_ID');
		$data['studentInfo'] = $this->studentsmodel->StudentInfo($_SESSION['STUDENTCODE']);
		$data['show_exampaper'] = $this->uri->segment(4);
		$namepage=$_SESSION['LEVELID'] ==82 ? "สอบเค้าโครงการค้นคว้าอิสระ" : "สอบเค้าโครงวิทยานิพนธ์";
		$StrQuery = array(
			'Result' =>array(
				'data' => $data,
				'namepage'=> $namepage,
				'param1' =>$param1,
			),
			'View' => '/Student/Components/DefendThesisIS'
		);
		$this->LoadPage($StrQuery);
	}

	public function search_thesis($param1='1'){
		$StrQuery = array(
			'Result' =>array(
				'param1'=> $param1,
				'namepage'=> 'ค้นหาวิทยานิพนธ์',
			),
			'View' => '/Template/SearchThesis'
		);
		$this->LoadPage($StrQuery);
		//$load->view('/',$this->data);
	}

	public function search_research($param1='1'){
		$StrQuery = array(
			'Result' =>array(
				'param1'=> $param1,
				'namepage'=> 'ค้นหาผลงานวิจัย',
			),
			'View' => '/Template/SearchResearch'
		);
		$this->LoadPage($StrQuery);
	}


	public function research($param1='1'){
		$StrQuery = array(
			'Result' =>array(
				'param1'=> $param1,
				'namepage'=> 'ผลงานวิจัยนักศึกษา',
			),
			'View' => '/Student/Research'
		);
		$this->LoadPage($StrQuery);
	}


	public function Graduated($param1='1'){
		$StrQuery = array(
			'Result' =>array(
				'param1'=>$param1,
				'namepage'=>'ขอสำเร็จการศึกษา',
			),
			'View' => '/Student/Components/Graduated'
		);
		$this->LoadPage($StrQuery);
		//$this->load->view('/Student/Completions',$data);
	}



	public function dateFormat($value){
		$examdate = explode("-",$value);
		$data['date']  = $examdate[2]=="00" ? "" : $examdate[2];
		$thaimonth=
		array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม",
		"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$data['month'] = date($examdate[1])=="00" ?  "" : $thaimonth[date($examdate[1])-1] ;
		$data['year'] = $examdate[0]=="0000" ? "" : $examdate[0]+543;

		return $data;
	}

	public function dateArray(){
		$tempDate="";

		for($i=1; $i<=31;$i++){
			if($i<10)
			$tempDate .= "<option value='0".$i."'>".$i."</option>";
			else
			$tempDate .= "<option value='".$i."'>".$i."</option>";
		}
		$tempMonth=
		array(["มกราคม","01"],["กุมภาพันธ์","02"],["มีนาคม","03"],["เมษายน","04"],["พฤษภาคม","05"],["มิถุนายน","06"],["กรกฎาคม","07"],
		["สิงหาคม","08"],["กันยายน","09"],["ตุลาคม","10"],["พฤศจิกายน","11"],["ธันวาคม","12"]);
		$data['arrDate']=$tempDate;
		$data['arrMonth'] = $tempMonth;
		return $data;
	}
	
	public function search_student(){
		if($_POST){
			$arr=array();
			
			$_POST['STUDENTCODE'] !="" ? array_push($arr,array('STUDENTCODE' => $_POST['STUDENTCODE'])) :"";
			$_POST['studentname'] !="" ? array_push($arr,array('STUDENTNAME' => $_POST['studentname'])) :"";
			$_POST['faculty'] !="" ? array_push($arr,array('STUDENTNAME' => $_POST['studentname'])) :"";
				
		}
		//print_r($arr);
		// $arra = array('STUDENTCODE' => $_POST['STUDENTCODE'], 'STUDENTNAME'=>$_POST['studentname']);
		// $data['result'] = $this->studentsmodel->getStudentID2($arra);

		//print_r($data['result']);
		$data['faculty'] = $this->studentsmodel->Select('faculty','FACULTYNAME != ""','*',1);
		$data['department'] = $this->studentsmodel->Select('department','DEPARTMENTNAME != ""','*',1);
		$countresult = count($data['result']);
		if($countresult>0){
			for($i=0; $i<$countresult; $i++){
				//echo $data['result'][$i]['STUDENTCODE']."<br>";
				$data1[]  = $this->studentsmodel->StudentInfo($data['result'][$i]['STUDENTCODE']);
			
			}

			
			
		}

		
		//$data['studentInfo'] = $this->studentsmodel->studentall();
		$this->load->view('/Template/HeaderNoLeftMenu',array('data1'=>$data1, 'data'=>$data));
		$this->load->view('/Student/SearchStudent');
		$this->load->view('/Template/Footer');
	}

	public function student_thesis_is_info(){
		$student_id = $this->uri->segment(3);
		$data['student_info'] = $this->studentsmodel->studentinfo($_SESSION['STUDENTCODE']);
		$data['std_ts_is_info'] = $this->studentsmodel->student_thesis_is_info($student_id);

		$this->load->view('/Template/HeaderNoLeftMenu', $data);
		$this->load->view('/Student/student_thesis_is_info');
		$this->load->view('/Template/Footer');
	}

	public function teacher_info(){
		$input =  $this->uri->segment(3);
		$data['officer_info'] = $this->Studentsmodel->adviser_info($input);
		$data['stds_in_adviser'] = $this->Studentsmodel->thesis_adviser_list($input, 1, "T");
		$data['stds_in_subadviser'] = $this->Studentsmodel->thesis_adviser_list($input, 2, "T");
		$data['stds_in_is_adviser'] = $this->Studentsmodel->thesis_adviser_list($input, 1, "I");
		$data['stds_in_is_subadviser'] = $this->Studentsmodel->thesis_adviser_list($input, 2, "I");

		$data['namepage']='ข้อมูลอาจารย์';
		$this->load->view('/Template/HeaderNoLeftMenu', $data);
		$this->load->view('/Teacher/Component/TeacherInfo');
		$this->load->view('/Template/Footer');
	}

	public function dashboard(){
		$this->Studentsmodel->StudentInfo($_SESSION['OFFICERCODE']);
		$data['menuactive']='1';
		$data['namepage']='Dashboard';
		$this->load->view('/Student/Dashboard',$data);
	}

	public function profile(){
		$data['menuactive']='1';
		$data['namepage']='Profile';
		$this->load->view('/Student/Profile',$data);
	}

	public function searchdisst(){
		$data['menuactive']='5';
		$data['namepage']='ค้นหาภาคนิพนธ์';
		$this->load->view('/Student/Searchdisst',$data);
	}

	public function test(){

		$data['menuactive']='6';
		$data['param1']=$param1;
		$data['namepage']='ค้นหางานงานวิจัย';
		$this->load->view('/Papers/Test',$data);


	}


}?>

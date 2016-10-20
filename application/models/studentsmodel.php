<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class studentsmodel extends CI_Model {

  public function student_relate(){
	  $this->db->join('attribute_prefix', 'student_master.PREFIXID = attribute_prefix.PREFIXID','LEFT');
    $this->db->join('attribute_faculty', 'student_master.FACULTYID = attribute_faculty.FACULTYID','LEFT');
    $this->db->join('attribute_department', 'student_master.DEPARTMENTID = attribute_department.DEPARTMENTID','LEFT');
    $this->db->join('program', 'student_master.PROGRAMID = program.PROGRAMID','LEFT');
    $this->db->join('campus', 'student_master.CAMPUSID = campus.CAMPUSID','LEFT');
    $this->db->join('attribute_level', 'student_master.LEVELID = attribute_level.LEVELID','LEFT');
    $this->db->join('attribute_procedure_study', 'student_master.procedure_study_id = attribute_procedure_study.procedure_study_id','LEFT');
    $this->db->join('attribute_student_status', 'student_master.STUDENTID = attribute_student_status.STUDENTID', 'LEFT');
  }
  public function student_studing(){
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
	  $this->student_relate();
	  $query = $this->db->get('student_master');
    return $query->result_array();
  }
  public function student_all(){
	 //$this->student_relate();
	  $query = $this->db->get('student_master');

    return $query->result_array();
  }
  public function StudentApproveAdviser(){
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
  	$this->student_relate();
    $query = $this->db->get('adviser');
    return $query->result_array();
  }
  public function facultyLists(){
    $query = $this->db->get('attribute_faculty');
    return $query->result_array();
  }
  public function departmentLists(){
    $query = $this->db->get('attribute_department');
    return $query->result_array();
  }
  public function levelIDLists(){
    $query = $this->db->get('attribute_level');
    return $query->result_array();
  }
  public function transcript($stdId){
    $this->db->select('ACADYEAR,SEMESTER');
    $this->db->group_by('ACADYEAR,SEMESTER');
    $query = $this->db->get_where('transcript',array('STUDENTID'=>$stdId));
    return $query->result_array();
  }
  public function transcript2($arr){
    $this->db->join('course', 'transcript.COURSEID = course.COURSEID');
    $query = $this->db->get_where('transcript',$arr);
    return $query->result_array();
  }
  public function getStudentID($input){
    $this->db->where('student_master.STUDENTCODE', $input);
    $query = $this->db->get('student_master');
    return $query->result_array();
  }
  public function getSTudentInfo($arr){
    $this->db->like($arr);
    $query = $this->db->get('student_master_view');
    return $query->result_array();
  }
  public function StudentInfoByStudentCode($input){

    $this->db->where('student_master.STUDENTCODE', $input);
    $this->student_relate();
    $query = $this->db->get('student_master');

    return $query->result_array();
  }
  public function StudentInfoByID($input){

    $this->db->where('student_master.STUDENTID', $input);
	  $this->student_relate();
    $query = $this->db->get('student_master');

    return $query->result_array();
  }
  public function studentTranscriptInfo($input){
    $this->db->where('transcript.STUDENTID',$input);
    $this->db->join('course', 'transcript.COURSEID = course.COURSEID');
    $query = $this->db->get('transcript');
    return $query->result_array();
  }
  public function Select($table,$data,$limit,$index){
    $this->db->where($data);
    $limit!="*"? $this->db->limit($limit) : "";

    $query = $this->db->get($table);
    return $query->result_array();
  }
  public function getLastRow($table,$condition,$id){
    $this->db->select($id);
    $this->db->from($table);
    $this->db->where($condition);
    $this->db->order_by($id,'DESC');
    $query = $this->db->get();
    return $query->result_array();
  }
  public function insert($table,$data){
    $this->db->insert($table,$data);
    $query = $this->db->get();
  }
  public function update($table, $data, $where){
    $this->db->where($where[0], $where[1]);
    $this->db->update('mytable', $data);
  }
  public function student_thesis_is_info($student_id){
    $this->db->where('student_master.STUDENTID', $student_id);
    $this->db->join('adviser','adviser.STUDENTID = student_master.STUDENTID');
    $this->db->join('officer','officer.OFFICERID = adviser.OFFICERID');
    //$this->db->join('thesis','thesis.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('student_master');
    return $query->result_array();
  }
  public function StudentByOfficerMainThesis($input){
    // วิทยานิพนย์ หลัก
    //Where
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 1');
    $this->db->where('student_master.LEVELID != 82');
    $this->db->where('student_master.procedure_study_id NOT BETWEEN 8 AND 10', NULL, FALSE );
    //Join
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->result_array();
  }
  public function StudentByOfficerCoThesis($input){
    // วิทยานิพนย์ ร่วม
    //Where
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 2');
    $this->db->where('student_master.LEVELID != 82');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    //Join
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
   	$this->student_relate();
    //Result
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->result_array();
  }
  public function StudentByOfficerMainIs($input){
    // ค้นคว้าอิสระ หลัก
    $this->db->distinct();

    //Where
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 1');
    $this->db->where('student_master.LEVELID = 82');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    //Join
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    //Result
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->result_array();
  }
  public function ThesisAll(){
    $this->db->join('student_master', 'thesis.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('thesis');
    return $query->result_array();
  }
  public function ResearchAll(){
    $this->db->join('student_master', 'research.STUDENTID = student_master.STUDENTID');

    $this->student_relate();
    $query = $this->db->get('research');
    return $query->result_array();
  }
  public function DocAdviser($input){
    $this->db->where('STUDENTID', $input);
    $query = $this->db->get('doc_adviser');
    return $query->result_array();
  }
  public function AdviserInfo($input){
    $this->db->where('OFFICERID', $input);
    $query = $this->db->get('officer');
    return $query->result_array();
  }
  public function officerList(){
    $this->db->join('attribute_prefix','officer.PREFIXID = attribute_prefix.PREFIXID');
    $query = $this->db->get('officer');
    return $query->result_array();
  }
  public function AdviserList($input){
    $this->db->where('relate_appiont_adviser_officer.STUDENTID', $input);
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $this->db->join('officer', 'relate_appiont_adviser_officer.OFFICERID = officer.OFFICERID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    //$this->debuger->prevalue($query->result_array());
    return $query->result_array();
  }
  //นับ วิทยานิพนธ์ ทั้งหมด
  public function AdviserCountAllTheis1($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('student_master.levelid != 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    // $this->db->where('DOCUMENTSTATUS = 1');
    $this->db->join('doc_adviser', 'relate_appiont_adviser_officer.STUDENTID  = doc_adviser.STUDENTID');
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  //นับ วิทยานิพนธ์ ที่ปรึกษาหลัก
  public function AdviserCountTheis1($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 1');
    $this->db->where('student_master.levelid != 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  //นับ วิทยานิพนธ์ ที่ปรึกษาร่วม
  public function AdviserCountTheis2($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 2');
    $this->db->where('student_master.levelid != 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  //นับ อิสระ ทั้งหมด
  public function AdviserCountAllTheis2($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('student_master.levelid = 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    // $this->db->where('DOCUMENTSTATUS = 1');
    $this->db->join('doc_adviser', 'relate_appiont_adviser_officer.STUDENTID  = doc_adviser.STUDENTID');
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  //นับ อิสระ หลัก
  public function AdviserCountTheis3($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 1');
    $this->db->where('student_master.levelid = 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  //นับ อิสระ ร่วม
  public function AdviserCountTheis4($input2){
    $this->db->where('relate_appiont_adviser_officer.OFFICERID', $input2);
    $this->db->where('relate_appiont_adviser_officer.ADVISERTYPE = 2');
    $this->db->where('student_master.levelid = 81');
    $this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->db->join('student_master', 'relate_appiont_adviser_officer.STUDENTID = student_master.STUDENTID');
    $query = $this->db->get('relate_appiont_adviser_officer');
    return $query->num_rows();
  }
  public function Proposal($input){
    $this->db->where('STUDENTID', $input);
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function Thesis($input){
    $this->db->where('STUDENTID', $input);
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function Comprehensive($input){
    $this->db->where('STUDENTID', $input);
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function Qualifying($input){
    $this->db->where('STUDENTID', $input);
    $query = $this->db->get('doc_exam_qece');
    return $query->result_array();
  }
  public function QualifyingOfficer($input){
    $this->db->where('EXAMREF', $input);
    $this->db->where('EXAM_TYPE', 'QECE');
    $this->db->join('officer', 'relate_officer_exam.OFFICERID = officer.OFFICERID');
    $query = $this->db->get('relate_officer_exam');
    return $query->result_array();
  }
  public function command_no($input){
    $this->db->where('ADVISER_ID', $input['ADVISER_ID']);
    $this->db->update('adviser',$input);
  }
  public function StudentNomalInfo($input){
    $this->db->where('STUDENTID', $input);
    $this->student_relate();
    $query = $this->db->get('student_master');
    return $query->result_array();
  }

  public function SearchStudentList($input){
    //$this->db->distinct();
    if($input['STUDENT_CODE']!=""){
      echo("<script>console.log('PHP: ".$input['STUDENT_CODE']."');</script>");
      $this->db->like('STUDENTCODE', $input['STUDENT_CODE']);
    }
    if($input['STUDENT_NAME']!=""){
      echo("<script>console.log('PHP: ".$input['STUDENT_NAME']."');</script>");
      $this->db->or_like('student_master.STUDENTNAME', $input['STUDENT_NAME']);
      $this->db->or_like('student_master.STUDENTNAMEENG', $input['STUDENT_NAME']);
      $this->db->or_like('student_master.STUDENTSURNAME', $input['STUDENT_NAME']);
      $this->db->or_like('student_master.STUDENTSURNAMEENG', $input['STUDENT_NAME']);
    }
    if($input['STUDENT_FACULTY']!=""){
      echo("<script>console.log('PHP: ".$input['STUDENT_FACULTY']."');</script>");
      $this->db->or_like('faculty.FACULTYNAME', $input['STUDENT_FACULTY']);
      $this->db->or_like('faculty.FACULTYNAMEENG', $input['STUDENT_FACULTY']);
    }

    //$this->db->where( "student_master.procedure_study_id NOT BETWEEN 8 AND 10", NULL, FALSE );
    $this->student_relate();
    //$this->db->limit(100, 200);
    $query = $this->db->get('student_master');
    return $query->result_array();
  }
  public function getOfficerInfo($input){
    $this->db->like($input);
    $query = $this->db->get('officer');
    return $query->result_array();
  }
  public function getPrefix($input,$selected){
    $this->db->select($selected);
    $this->db->where('PREFIXID',$input);
    $query = $this->db->get('attribute_prefix');
    return $query->result_array();
  }
  public function getResearchInfo($arr){
    //print_r($arr);
    $this->db->like($arr);
    $query = $this->db->get('research');
    return $query->result_array();
  }
  public function getThesisByLike($arr){
    //print_r($arr);
    $this->db->like($arr);
    $query = $this->db->get('thesis');
    return $query->result_array();
  }
  public function getDepartmentInfo($id){
    $this->db->where('DEPARTMENTID',$id);
    $query = $this->db->get('attribute_department');
    return $query->result_array();
  }
  public function getFacultyInfo($id){
    $this->db->where('FACULTYID',$id);
    $query = $this->db->get('attribute_faculty');
    return $query->result_array();
  }
  public function getLevelIDInfo($id){
    $this->db->where('LEVELID',$id);
    $query = $this->db->get('attribute_level');
    return $query->result_array();
  }
  public function getStudentInfo2($id,$selected){
    $this->db->select($selected);
    $this->db->where('STUDENTID',$id);
    $query = $this->db->get('student_master');
    return $query->result_array();
  }



  // รายการเอกสาร
  public function AdvisorList(){
    // $this->db->where('DOCUMENTSTATUS !=',1);
    $this->db->join('student_master', 'doc_adviser.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('doc_adviser');
    return $query->result_array();
  }
  public function QECEList(){

    $this->db->where('EXAM_TYPE =','QECE');
    $this->db->join('student_master', 'doc_exam.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function PropersalList(){

    $this->db->where('EXAM_TYPE =','PROP');
    $this->db->join('student_master', 'doc_exam.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function ThesisList(){

    $this->db->where('EXAM_TYPE =','THES');
    $this->db->join('student_master', 'doc_exam.STUDENTID = student_master.STUDENTID');
    $this->student_relate();
    $query = $this->db->get('doc_exam');
    return $query->result_array();
  }
  public function getProgramOfficer($programid){
			$this->db->where('PROGRAMID =',$programid);
      $this->db->join('officer', 'relate_program_officer.OFFICERID= officer.OFFICERID');;
      $query = $this->db->get('relate_program_officer');
      return $query->result_array();
	}

  public function getThesisInfo($studentid){
    $this->db->where('STUDENTID',$studentid);
    $this->db->order_by("THESISCODE", "desc");
    $query = $this->db->get('thesis');
    return $query->result_array();
  }
}

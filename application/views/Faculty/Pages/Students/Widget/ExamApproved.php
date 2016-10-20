<?php
$ExamType=$this->uri->segment(4);
$StudentType = $Result['Student'][0]['LEVELID'];
if ($ExamType=='ADVI') {
  if ($StudentType!=82) {
    $this->load->view('Faculty/Pages/Students/Widget/ApprovedPresident');
    $this->load->view('Faculty/Pages/Students/Widget/ApprovedFaculty');
  } else {
    $this->load->view('Faculty/Pages/Students/Widget/ApprovedPresident');
  }
} elseif ($ExamType=='QECE') {
  $this->load->view('Faculty/Pages/Students/Widget/ApprovedPresident');
  $this->load->view('Faculty/Pages/Students/Widget/ApprovedOfficer');
  $this->load->view('Faculty/Pages/Students/Widget/ApprovedFaculty');
  
  
} elseif ($ExamType=='PROP'||$ExamType=='THES') {
  $this->load->view('Faculty/Pages/Students/Widget/ApprovedPresident');
}
?>

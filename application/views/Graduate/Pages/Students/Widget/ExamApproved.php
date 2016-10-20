<?php
$ExamType=$this->uri->segment(4);
$StudentType = $Result['Student'][0]['LEVELID'];
if ($ExamType=='ADVI') {
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedDean');
} elseif ($ExamType=='QECE') {
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedPresident');
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedDean');
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedAssociate');
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedOfficer');
} elseif ($ExamType=='PROP'||$ExamType=='THES') {
  $this->load->view('Graduate/Pages/Students/Widget/ApprovedPresident');
}
?>

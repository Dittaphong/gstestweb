<?php
  $ExamType = $this->uri->segment(4);

  if ($Result['Student'][0]['LEVELID']!=82) {
    $StudentType = 1;
  } else {
    $StudentType = 2;
  }

  if ($StudentType==1) {
    if ($ExamType=="QECE") {
      $ExamName = "คำร้องขอสอบวัดความรู้";
    } elseif ($ExamType=="PROP") {
      $ExamName = "คำร้องขอสอบเค้าโครงการค้นคว้าอิสระ";
    } elseif ($ExamType=="THES") {
      $ExamName = "คำร้องขอสอบการค้นคว้าอิสระ";
    }
  }
  else {
    if ($ExamType=="QECE") {
      $ExamName = "คำร้องขอสอบวัดคุณสมบัติ";
    } elseif ($ExamType=="PROP") {
      $ExamName = "คำร้องขอสอบเค้าโครงวิทยานิพนธ์";
    } elseif ($ExamType=="THES") {
      $ExamName = "คำร้องขอสอบวิทยานิพนธ์";
    }
  }

?>

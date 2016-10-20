<?php
$ExamType = $this->uri->segment(4);
$StudentType = $Result['Student'][0]['LEVELID'];

$ExamName = $this->debuger->ExamName($ExamType, $StudentType);
if ($StudentType>=80 && $StudentType<=89) {
  $QECEName = "คำร้องขอสอบวัดความรู้";
  $QECE_Offier = "การค้นคว้าอิสระ";
} else {
  $QECEName = "คำร้องขอสอบวัดคุณสมบัติ";
  $QECE_Offier = "วิทยานิพนธ์";
}
?>

<h5><?php echo $ExamName; ?></h5>
<div class="container">
  <div class="row">
    <div class="timeline-centered">
      <article class="timeline-entry">
        <div class="timeline-entry-inner">
          <div class="timeline-icon bg-success"> <i class="entypo-feather"></i> </div>
          <div class="timeline-label">
            <h5>นักศึกษา</a> </h5>
            <p><strong>บันทึก<?php echo $ExamName ?></strong><br>
              เมื่อ : <?php echo $this->debuger->DateThai($Result['ExamDoc'][0]['EXAM_CREATE_DATE']); ?>
              </p>
          </div>
        </div>
      </article>
      <?php
      // $this->debuger->prevalue($Result['ExamDoc']);
            foreach ($Result['ExamDoc'] as $value) {
              if($value['EXAM_TYPE'] == $ExamType){
                $DocRef = $value['EXAM_ID'];
                // print_r($DocRef);
              }
            }
            $this->db->where('doc_approved_ref', $DocRef);
            $this->db->where('doc_approved_type', $ExamType);
            $approved = $this->db->get('relate_doc_approved')->result_array();
            // $this->debuger->prevalue($DocRef);
       ?>
       <?php foreach ($approved as $approved): ?>
         <article class="timeline-entry">
           <div class="timeline-entry-inner">
             <div class="timeline-icon bg-info"> <i class="entypo-suitcase"></i> </div>
             <div class="timeline-label">
               <?php if ($approved['doc_approved_by']=="DEAN"): ?>
                  <h5>คณบดีบัณฑิตวิทยาลัย</h5>
               <?php elseif ($approved['doc_approved_by']=="ASSO"):?>
                  <h5>รองคณบดีบัณฑิตวิทยาลัย</h5>
               <?php elseif ($approved['doc_approved_by']=="OFFI"):?>
                  <h5>อาจารย์ที่ปรึกษา<?php echo $QECE_Offier; ?></a> </h5>
             <?php elseif ($approved['doc_approved_by']=="FACU"):?>
                <h5>คณบดีคณะที่สาขาวิชาสังกัดคณะ</h5>
             <?php elseif ($approved['doc_approved_by']=="PRES"):?>
                <h5>ประธานคณะกรรมการผู้รับผิดชอบหลักสูตร</h5>
               <?php endif; ?>

               <p><strong>ตรวจสอบคำร้อง</strong><br>
                 เมื่อ : <?php echo $this->debuger->DateThai($approved['doc_approved_date']); ?>
                 </p>
             </div>
           </div>
         </article>
       <?php endforeach; ?>


    </div>
  </div>
</div>

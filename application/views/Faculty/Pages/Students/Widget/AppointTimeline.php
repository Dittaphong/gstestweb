<?php
$DocType = $this->uri->segment(4);
$StudentType = $Result['Student'][0]['LEVELID'];
?>

<h5>แต่งตั้งอาจารย์ที่ปรึกษา</h5>
<div class="container">
  <div class="row">
    <div class="timeline-centered">
      <article class="timeline-entry">
        <div class="timeline-entry-inner">
          <div class="timeline-icon bg-success"> <i class="entypo-feather"></i> </div>
          <div class="timeline-label">
            <h5>นักศึกษา</a> </h5>
            <p><strong>บันทึกคำร้องขอแต่งตั้งอาจารย์ที่ปรึกษา</strong><br>
              เมื่อ : <?php echo $this->debuger->DateThai($Result['ExamDoc'][0]['EXAM_CREATE_DATE']); ?>
              </p>
          </div>
        </div>
      </article>
      <?php
      // $this->debuger->prevalue($Result['ExamDoc']);

            $this->db->where('doc_approved_ref', $Result['DocAdviser'][0]['APPOINT_AVISER_ID']);
            $this->db->where('doc_approved_type', 'ADVI');
            $approved = $this->db->get('relate_doc_approved')->result_array();
            // $this->debuger->prevalue($DocRef);
       ?>
       <?php foreach ($approved as $approved): ?>
       <?php if($approved['doc_approved_status']!=0): ?>
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
                <h5>คณบดีคณะ<?php echo $Result['Student']['0']['FACULTYNAME']; ?></h5>
             <?php elseif ($approved['doc_approved_by']=="PRES"):?>
                <h5>ประธานคณะกรรมการผู้รับผิดชอบหลักสูตร</h5>
               <?php endif; ?>

               <p><strong>ตรวจสอบคำร้อง : <?php if($approved['doc_approved_status']==1){echo "อนุมัติ";}elseif($approved['doc_approved_status']==2){echo "ไม่อนุมัติ";} ?> </strong><br>
                 เมื่อ : <?php echo $this->debuger->DateThai($approved['doc_approved_date']); ?>
                 </p>
             </div>
           </div>
         </article>
         <?php endif; ?>
       <?php endforeach; ?>


    </div>
  </div>
</div>

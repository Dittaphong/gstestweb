

<?php
$ExamType = $this->uri->segment(3);
$Count = 0;
foreach ($Result['Exam'] as $Exam) {
  if ($Exam['EXAM_TYPE']==$ExamType) {
    $Count = 1;
  }
}

 ?>
<?php if ($Count==0): ?>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
      <h3 class="text-center">ยื่อคำร้องขอสอบ</h3>
      <?php echo form_open('student/PetitionSave');?>
      <input type="hidden" name="examtype" value="<?=$this->uri->segment(3);?>">
      <input type="hidden" name="studentid" value="<?=$_SESSION['STUDENTID']?>"/>
      <?php if ($this->uri->segment(3)!='QECE'): ?>
        <input type="hidden" name="name_id" value="<?=$Result['ThesisName'][0]['thesis_name_id'];?>">
        <div class="col-sm-12" style="margin-top:10px;">
          <div class="col-md-3 text-right">
            <h3>หัวข้อภาษาไทย :</h3>
          </div>
          <div class="col-sm-8">
            <h3>
              <?php $this->debuger->NullObj($Result['ThesisName'][0]['thesis_name_th']); ?>
            </h3>
          </div>
        </div>
        <div class="col-sm-12" style="margin-top:10px;">
          <div class="col-md-3 text-right">
            <h3>หัวข้อภาษาอังกฤษ :</h3>
          </div>
          <div class="col-sm-8">
            <h3>
              <?php $this->debuger->NullObj($Result['ThesisName'][0]['thesis_name_en']); ?>
            </h3>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-sm-12" style="text-align:center;"><br>
        <button  type="submit" name="topicPropersal" class="btn btn-info btn-lg">ยื่นคำร้องขอสอบ</button>
      </div>
      <?php echo form_close();?> </div>
    </div>
  <?php else: ?>

    <?php
    $ExamType = $this->uri->segment(3);
    $StudentType = $Result['Student'][0]['LEVELID'];
    $namepage = $this->debuger->ExamName($ExamType, $StudentType);
    if ($ExamType=="QECE") {
      $this->load->view('Student/Components/CeQeExam');
      // if ($StudentType>=80 && $StudentType<=89) {
      //
      //   // คำร้องขอสอบวัดความรู้
      //   $this->load->view('Papers/Ceform');
      // } else {
      //   // คำร้องขอสอบวัดคุณสมบัติ
      //   $this->load->view('Papers/Qeform');
      // }
    } else {
      if ($ExamType=="PROP") {
        $this->load->view('Papers/Thesis_proposal_petition_exam');
      } elseif ($ExamType=="THES") {
        $this->load->view('Papers/Thesis_petition_exam');
      }
    } ?>
  <?php endif; ?>

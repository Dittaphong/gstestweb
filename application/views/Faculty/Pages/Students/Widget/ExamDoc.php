<?php
$ExamType = $this->uri->segment(3);
$StudentType = $Result['Student'][0]['LEVELID'];

$ExamName = $this->debuger->ExamName($ExamType, $StudentType)

?>

<!-- ประเภทเอกสารจาก URL -->
<?php $ExamType=$this->uri->segment(4); ?>
<!-- นับจำนวนเอกสาร -->
<?php $e=0; ?>
<?php foreach ($Result['ExamDoc'] as $Exam): ?>
<?php if($Exam['EXAM_TYPE']==$ExamType){$e++;} ?>
<?php endforeach; ?>

<div class='row '>
  <div class="col-md-12">
    <div class="panel-group" id="accordion">
      <?php $i=1; ?>
      <?php foreach ($Result['ExamDoc'] as $ExamDoc): ?>
      <?php if($ExamDoc['EXAM_TYPE']==$ExamType): ?>
      <?php
        if($e>1){
          if ($i==1) {
            $coll= "false";
            $collapsed="collapsed";
            $colIn ="";
          } else {
            $coll= "true";
            $collapsed="";
            $colIn ="in";
          }
        } else {
          $coll= "true";
          $collapsed="";
          $colIn ="in";
        }
        ?>
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#coll<?php echo $ExamDoc['EXAM_ID'] ?>" aria-expanded="<?php echo $coll; ?>" class="<?php echo $collapsed; ?>"><?php echo $ExamName; ?> ครั้งที่ <?php echo $i; ?> <i class="fa fa-angle-down pull-right"></i><i class="fa fa-angle-up pull-right"></i></a> </h4>
        </div>
        <div id="coll<?php echo $ExamDoc['EXAM_ID'] ?>" class="panel-collapse collapse <?php echo $colIn; ?>" aria-expanded="<?php echo $coll; ?>" style="">
          <div class="panel-body">
            <?php
                  if ($this->uri->segment(4)!='QECE' && $this->uri->segment(4)!='ADVI') {
                    $ThesisTitle = $this->db->where('STUDENTID', $this->uri->segment(3))->get('thesis_name')->result_array();
                  }
             ?>
             <?php if($ThesisTitle[0]['thesis_name_id']!=0): ?>
           	<h4>ชื่อหัวข้อภาษาไทย : <?php echo $ThesisTitle[0]['thesis_name_th']; ?></h4>
            <h4>ชื่อหัวข้อภาษาอังกฤษ : <?php echo $ThesisTitle[0]['thesis_name_en']; ?></h4>
             <?php endif; ?>
            <h5>เอกสารเลขที่ : </h5>
            <!-- <h5>เอกสารเลขที่ : </h5> -->

            <hr class="inner-separator">
            <h5>กำหนดสอบ : </h5>
            <div class="row">
              <div class="col-md-4">วันที่ <?php echo $this->debuger->DateThai($ExamDoc['EXAM_DATE']); ?></div>
              <div class="col-md-4">อาคาร <?php echo $ExamDoc['EXAM_BUILD']; ?></div>
              <div class="col-md-4">ห้อง <?php echo $ExamDoc['EXAM_ROOM']; ?></div>
            </div>
            <hr class="inner-separator">
            <h5>อาจารย์ผู้คุมสอบ : </h5>
            <div class="row">
              <div class="col-sm-12">
                <?php $ExamType=$this->uri->segment(4); ?>
                <?php foreach ($Result['ExamOfficer'] as $ExamOfficer): ?>
                <?php if ($ExamOfficer['EXAM_TYPE']==$ExamType&&$ExamOfficer['EXAM_REF']==$ExamDoc['EXAM_ID']): ?>
                <div class="col-sm-3 text-right"><?php echo $ExamOfficer['OFFICER_POSITION']?> :</div>
                <div class="col-sm-9"><?php echo $ExamOfficer['OFFICERPOSITION'].$ExamOfficer['OFFICERNAME']." ".$ExamOfficer['OFFICERSURNAME']; ?></div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php $r=1; ?>
                <?php foreach ($Result['AdviserList'] as $AdviserList): ?>
                <div class="col-sm-3 text-right">
                  <?php if ($r==3) { echo "กรรมการและเลขา"; } else { echo "กรรมการ"; } ?>
                  :</div>
                <div class="col-sm-9"><?php echo $AdviserList['OFFICERPOSITION'].$AdviserList['OFFICERNAME']." ".$AdviserList['OFFICERSURNAME']; ?></div>

                <?php $r++; ?>
                <?php endforeach; ?>
              </div>
            </div>
            <hr class="inner-separator">
            <div class="row">
            <div class="col-md-12">
            <?php if ($ExamDoc['EXAM_RESULT']==""): ?>
            <div class="alert alert-info"> <strong>ผลการสอบ</strong> รอผลการสอบ </div>
            <?php elseif ($ExamDoc['EXAM_RESULT']=="1"): ?>
            <div class="alert alert-success"> <strong>ผลการสอบ</strong> ผ่านดี<br>
              วันที่บันทึก </div>
            <?php elseif ($ExamDoc['EXAM_RESULT']=="2"): ?>
            <div class="alert alert-warning"> <strong>ผลการสอบ</strong> ผ่าน - เหลือเวลาแก้ไขอีก 45 วัน<br>
              วันที่บันทึก
              <?php if($ExamDoc['EXAM_RESULT_REASON']!=""){echo "เหตุผล ".$ExamDoc['EXAM_RESULT_REASON'];}?>
            </div>
            <?php elseif ($ExamDoc['EXAM_RESULT']=="3"): ?>
            <div class="alert alert-danger"> <strong>ผลการสอบ</strong> ไม่ผ่าน<br>
              วันที่บันทึก </div>
            <?php endif; ?>
            </div>
            <div class="col-md-3">
            <button class="btn btn-custom-secondary">บันทึกผลการสอบ</button>
            </div>
            </div>
            <?php //$this->load->view('Graduate/Pages/Students/ExamApprocvedList'); ?>
          </div>
        </div>
      </div>
      <?php $i++; ?>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<hr>
<?php $this->load->view('Graduate/Pages/Students/Widget/ExamSetup'); ?>

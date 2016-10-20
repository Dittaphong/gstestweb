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
        <div class="col-sm-3 text-right"><?php if ($r==3) { echo "กรรมการและเลขา"; } else { echo "กรรมการ"; } ?> :</div>
        <div class="col-sm-9"><?php echo $AdviserList['OFFICERPOSITION'].$AdviserList['OFFICERNAME']." ".$AdviserList['OFFICERSURNAME']; ?></div>
        <?php $r++; ?>
      <?php endforeach; ?>

  </div>
</div>

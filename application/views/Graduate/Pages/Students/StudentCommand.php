<?php
$StudentType = $Result['Student'][0]['LEVELID'];

if ($StudentType>=80 && $StudentType<=89) {
  $QECEName = "สอบวัดความรู้";
} else {
  $QECEName = "สอบวัดคุณสมบัติ";
}
if ($StudentType==82) {
    $StudentTypeName = "การค้นคว้าอิสระ";
    $PROPName = "สอบเค้าโครงการค้นคว้าอิสระ";
    $THESName = "สอบการค้นคว้าอิสระ";
} else {
    $StudentTypeName = "วิทยานิพนธ์";
    $PROPName = "สอบเค้าโครงวิทยานิพนธ์";
    $THESName = "สอบวิทยานิพนธ์";
}
?>

<div class="main-content">
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-6">
          <div class="project-section general-info">
            <div class="media clearfix header-bottom">
              <div class="media-left"> <img src="<?php echo base_url('image/student/user2.png'); ?>" class="media-object img-circle" height="90px"> </div>
              <div class="media-body" style="padding-left: 20px;"> <span><?php echo $Result['Student'][0]['PREFIXNAME']." ".$Result['Student'][0]['STUDENTNAME']."   ".$Result['Student'][0]['STUDENTSURNAME'];?></span> <br>
                <span class="text-muted username"><?php echo $Result['Student'][0]['PREFIXNAMEENG']." ".$Result['Student'][0]['STUDENTNAMEENG']."  ".$Result['Student'][0]['STUDENTSURNAMEENG']; ?></span><br>
                <span class="text-muted username"><?php echo $Result['Student'][0]['STUDENTCODE'];?></span> </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-12">
                <div class="col-md-5 text-right">คณะ :</div>
                <div class="col-md-7"><?=$Result['Student'][0]['FACULTYNAME'];?></div>
                <div class="col-md-5 text-right">สาขาวิชา :</div>
                <div class="col-md-7"><?=$Result['Student'][0]['DEPARTMENTNAME'];?></div>
                <div class="col-md-5 text-right">ระดับปริญญา :</div>
                <div class="col-md-7"><?=$Result['Student'][0]['LEVELNAME'];?></div>
                <div class="col-md-5 text-right">ปีการศึกษา :</div>
                <div class="col-md-7"><?=$Result['Student'][0]['CURRENTACADYEAR'];?></div>
                <div class="col-md-5 text-right">สถานะ:</div>
                <div class="col-md-7"><?=$Result['Student'][0]['procedure_name'];?></div>
          </div>
        </div>
      </div>
      <hr>
      <div class="">
        <div class="col-sm-12">
        <?php if($this->uri->segment(4)!='ADVI'): ?>
        	<?php $this->load->view('Graduate/Pages/Students/Widget/ExamDoc'); ?>
        <?php else: ?>
        	<?php $this->load->view('Graduate/Pages/Students/Widget/AppointmentAdviser'); ?>
        <?php endif; ?>

        </div>
      </div>
    </div>
    </div>
    <div class="col-md-4">
      <ul class="nav nav-pills nav-pills-custom-minimal custom-minimal-bottom" role="tablist">
        <li class="active"><a href="#activities" role="tab" data-toggle="tab" aria-expanded="true"><i class="icon ion-social-rss"></i>
          <h5>การจัดทำ<?php echo $StudentTypeName; ?></h5>
          </a></li>
        <li class=""><a href="#followers" role="tab" data-toggle="tab" aria-expanded="false"><i class="icon ion-reply-all"></i>
          <h5>ดาวนโหลดเอกสาร</h5>
          </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade active in" id="activities">
          <?php if (isset($Result['DocStatus']['ADVI']) && $Result['DocStatus']['ADVI']==1): ?>
            <h5 style="color: #97dd03;"><i class="fa fa-check-square-o"></i>
                <?php else: ?>
            <h5><i class="fa fa-square-o"></i>
          <?php endif; ?>
           แต่งตั้งอาจารย์ที่ปรึกษา</h5>
          <?php if (isset($Result['DocStatus']['QECE']) && $Result['DocStatus']['QECE']==1): ?>
            <h5 style="color: #97dd03;"><i class="fa fa-check-square-o"></i>
              <?php else: ?>
            <h5><i class="fa fa-square-o"></i>
          <?php endif; ?> <?php echo $QECEName; ?></h5>
          <?php if (isset($Result['DocStatus']['PROP']) && $Result['DocStatus']['PROP']==1): ?>
            <h5 style="color: #97dd03;"><i class="fa fa-check-square-o"></i>
              <?php else: ?>
            <h5><i class="fa fa-square-o"></i>
          <?php endif; ?> <?php echo $PROPName; ?></h5>
          <?php if (isset($Result['DocStatus']['THES']) && $Result['DocStatus']['THES']==1): ?>
            <h5 style="color: #97dd03;"><i class="fa fa-check-square-o"></i>
              <?php else: ?>
            <h5><i class="fa fa-square-o"></i>
          <?php endif; ?> <?php echo $THESName; ?></h5>
          <hr class="inner-separator">
          <?php if ($this->uri->segment(4)=='ADVI'): ?>
            <?php $this->load->view('Graduate/Pages/Students/Widget/AppointTimeline'); ?>
            <?php else: ?>
              <?php $this->load->view('Graduate/Pages/Students/Widget/ExamTimeline'); ?>
          <?php endif; ?>

        </div>
        <div class="tab-pane fade" id="followers">
          <div class="knowledge">
            <h5><i class="fa fa-folder"></i> เอกสารแต่งตั้งอาจารย์ที่ปรึกษา</h5>
            <ul class="list-unstyled">
              <li><i class="fa fa-file-text-o pull-left"></i><a href="#">เอกสารแต่งตั้งอาจารย์ที่ปรึกษา</a></li>
            </ul>
          </div>
          <div class="knowledge">
            <h5><i class="fa fa-folder"></i> เอกสารคำร้องขอสอบ</h5>
            <ul class="list-unstyled">
              <li><i class="fa fa-file-text-o pull-left"></i><a href="#">เอกสารขอสอบ QE CE</a></li>
              <li><i class="fa fa-file-text-o pull-left"></i><a href="#">เอกสารขอสอบเค้าโครงค้นคว้าอิสระ</a></li>
              <li><i class="fa fa-file-text-o pull-left"></i><a href="#">เอกสารขอสอบค้นคว้าอิสระ/วิทยานิพนธ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

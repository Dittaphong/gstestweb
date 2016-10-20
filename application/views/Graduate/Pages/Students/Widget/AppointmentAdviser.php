
<div class='row '> </div>
<hr>
<div class='row '> </div>
<h3>อาจารย์ที่ปรึกษา</h3>

<span class="badge element-bg-color-blue">เอกสารเลขที่ : </span>
<hr class="inner-separator">
<div class="row">

  <?php foreach ($Result['AdviserList'] as $Result['AdviserList']): ?>
  <?php
  $AMT_STD1 = $Result['AdviserList']['AMT_STD1'];
  $AMT_STD2 = $Result['AdviserList']['AMT_STD2'];
  $limitIS = $Result['limitIS'];
  $limitThesis = $Result['limitThesis'];
  ?>
  <div class="col-md-6">
    <div class="media clearfix header-bottom" style="padding-bottom:20px">
      <div class="media-left"> <img src="<?php echo base_url('image/officer/user1.png'); ?>" class="media-object img-circle" height="64px"> </div>
      <div class="media-body"> <a href="<?php echo site_url(); ?>/graduate/Officerinfo/<?php echo $Result['AdviserList']['OFFICERID']?>"> <span><?php echo $Result['AdviserList']['OFFICERPOSITION']." ".$Result['AdviserList']['OFFICERNAME']."  ".$Result['AdviserList']['OFFICERSURNAME'];?></span> </a><br>
        <span class="text-muted username">ที่ปรึกษาวิทยานิพนธ์ <?php echo $AMT_STD1."/".$limitThesis; ?> คน</span><br>
        <span class="text-muted username">ที่ปรึกษาค้นคว้าอิสระ <?php echo $AMT_STD2."/".$limitIS; ?> คน</span><br>
        <?php if ($Result['AdviserList']['ADVISERTYPE']==1): ?>
        <span class="badge element-bg-color-green">ที่ปรึกษาหลัก</span>
        <?php else: ?>
        <span class="badge">ที่ปรึกษาร่วม</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<!-- <div class="row">
  <?php if($Result['Lock']==0): ?>
  <span class="col-md-10"></span>
  <button id="app_success" class="btn btn-success" type="button" onClick="window.location.href='<?php echo site_url(); ?>/graduate/AdvisorApproved/<?php echo $Result['DocAdviser'][0]['APPOINT_AVISER_ID']; ?>'"><i class="glyphicon glyphicon-ok"></i> <span>บันทึก</span></button>
  <?php else: ?>
  <div id="alert_full" class="alert alert-danger alert-dismissable" >
    <div class="row text-center" style="margin-bottom:20px"> <strong>ปิดการใช้งาน!</strong> อาจารย์บางท่านบนรายการมีภาระงานเกินจำนวนจำกัด </div>
    <div class="row text-center">
      <button id="unlock_full" style="text-align:left" class="btn btn-success btn-sm" type="button" onClick="unlock"><i class="fa fa-unlock"></i><span> เปิดการใช้งานเดี๋ยวนี้</span></button>
    </div>
    <script>
    $("#unlock_full").click(function() {
        $("#app_success").removeAttr('disabled');
        $("#app_unsuccess").removeAttr('disabled');
        $('#alert_full').hide();
        $('#app_success').show();
    });
    </script>
  </div>
  <button id="app_success" style="display:none;" class="btn btn-success" type="button" onClick="window.location.href='<?php echo site_url(); ?>/graduate/AdvisorApproved/<?php echo $Result['DocAdviser'][0]['APPOINT_AVISER_IS_THESIS_ID']; ?>'"><i class="glyphicon glyphicon-ok"></i> <span>บันทึก</span></button>
  <?php endif; ?>
</div> -->
<div class='row '> </div>
<hr>
<div class='row '> </div>
<?php $this->load->view('Graduate/Pages/Students/Widget/ExamApproved'); ?>

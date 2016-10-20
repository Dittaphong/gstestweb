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
          <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#coll<?php echo $ExamDoc['EXAM_ID'] ?>" aria-expanded="<?php echo $coll; ?>" class="<?php echo $collapsed; ?>">
            <?php if ($Result['Student'][0]['LEVELID'] != 82): ?>
            คำร้องขอสอบวัดคุณสมบัติ
            <?php else: ?>
            คำร้องขอสอบวัดความรู้
            <?php endif; ?>
            ครั้งที่ <?php echo $i; ?> <i class="fa fa-angle-down pull-right"></i><i class="fa fa-angle-up pull-right"></i></a> </h4>
        </div>
        <div id="coll<?php echo $ExamDoc['EXAM_ID'] ?>" class="panel-collapse collapse <?php echo $colIn; ?>" aria-expanded="<?php echo $coll; ?>" style="">
          <div class="panel-body">
            <?php if ($Result['Student'][0]['LEVELID'] != 82): ?>
            <h3>คำร้องขอสอบวัดคุณสมบัติ</h3>
            <?php else: ?>
            <h3>คำร้องขอสอบวัดความรู้</h3>
            <?php endif; ?>
            <h4>เลขที่ : <span class="label label-success">รออนุมัติ</span></h4>
            <?php if ($ExamDoc['EXAM_RESULT']==""): ?>
            <div class="alert alert-info"> <strong>รอผลการสอบ</strong> รอผลการสอบ </div>
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
                <dl class="dl-horizontal">
                  <?php foreach ($Result['ExamOfficer'] as $ExamOfficer): ?>
                  <?php if ($ExamOfficer['EXAM_TYPE']==$ExamType&&$ExamOfficer['EXAM_REF']==$ExamDoc['EXAM_ID']): ?>
                  <dt><?php echo $ExamOfficer['OFFICER_POSITION']?> :</dt>
                  <dd><?php echo $ExamOfficer['OFFICERPOSITION'].$ExamOfficer['OFFICERNAME']." ".$ExamOfficer['OFFICERSURNAME']; ?></dd>
                  <?php endif; ?>
                  <?php endforeach; ?>
                  <?php $r=1; ?>
                  <?php foreach ($Result['AdviserList'] as $AdviserList): ?>
                  <dt>
                    <?php
                          if ($r==3) {
                            echo "เลขา";
                          } else {
                            echo "กรรมการ";
                          }
                          ?>
                    :</dt>
                  <dd><?php echo $AdviserList['OFFICERPOSITION'].$AdviserList['OFFICERNAME']." ".$AdviserList['OFFICERSURNAME']; ?></dd>
                  <?php $r++; ?>
                  <?php endforeach; ?>
                </dl>
              </div>
            </div>
            <hr class="inner-separator">
            <h5>ประธานคณะกรรมการผู้รับผิดชอบหลักสูตร : </h5>
            <div class="row">
              <div class="col-md-12">ผลการตรวจสอบ </div>
              <div class="col-md-12">เหตุผล </div>
              <div class="col-md-12">วันที่ตรวจสอบ </div>
            </div>
            <hr class="inner-separator">
            <h5>ความเห็นคณบดีคณะที่สาขาวิชาสังกัดคณะ : </h5>
            <div class="row">
              <div class="col-md-12">ผลการตรวจสอบ </div>
              <div class="col-md-12">เหตุผล </div>
              <div class="col-md-12">วันที่ตรวจสอบ </div>
            </div>
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
<div class='row '>
  <div class="col-md-12">
    <h5>ประธานคณะกรรมการผู้รับผิดชอบหลักสูตร :</h5>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-inline fancy-radio custom-bgcolor-green">
            <input type="radio" name="inline-radio1">
            <span><i></i>อนุมัติ</span> </label>
          <label class="control-inline fancy-radio custom-bgcolor-green">
            <input type="radio" name="inline-radio1">
            <span><i></i>ไม่อนุมัติ</span> </label>
        </div>
      </div>
      <div class="col-md-9">
        <input type="email" class="form-control" id="ticket-email" placeholder="เหตุผล">
      </div>
      <div class="col-md-3">
        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> บันทึก</button>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <h5>กำหนดวันสอบ : </h5>
    <?php echo form_open('graduate/PropersalApproved'); ?>
    <?php
        if (count($Result['ExamDoc'])>1){
          $id = $Result['ExamDoc'][1]['EXAM_ID'];
          $date = $Result['ExamDoc'][1]['EXAM_DATE'];
          $build = $Result['ExamDoc'][1]['EXAM_BUILD'];
          $room = $Result['ExamDoc'][1]['EXAM_ROOM'];
        } else {
          $id = $Result['ExamDoc'][0]['EXAM_ID'];
          $date = $Result['ExamDoc'][0]['EXAM_DATE'];
          $build = $Result['ExamDoc'][0]['EXAM_BUILD'];
          $room = $Result['ExamDoc'][0]['EXAM_ROOM'];
        }
        ?>
    <input type="hidden" name="docid" value="<?php echo $id; ?>"/>
    <div class="widget-content">
      <div class="row" >
        <div class="col-sm-5">
          <div class="input-group date form_datetime" data-date="<?php echo $date; ?>" data-date-format="yyyy-mm-d HH:mm:ss" data-link-field="">
            <input id="exam_date" name="exam_date" class="form-control " size="16" type="text" value="<?php echo $date; ?>" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
        </div>
        <div class="col-sm-2">
          <input name="exam_room" class="form-control" type="text" value="<?php echo $room; ?>" placeholder="ห้องสอบ">
        </div>
        <div class="col-sm-2">
          <input name="exam_build" class="form-control" type="text" value="<?php echo $build; ?>" placeholder="อาคาร">
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> กำหนดวันสอบ</button>
        </div>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?> <?php echo form_open('graduate/Exam_Officer'); ?>
  <input type="hidden" name="EXAM_TYPE" value="<?php echo $ExamType ?>">
  <input type="hidden" name="EXAMREF" value="<?php echo $id; ?>">
  <div class="col-md-12">
    <div class="row">
      <div class='col-md-12'>
        <h5>คณะกรรมการดําเนินการสอบ : </h5>
      </div>
      <div class="col-sm-5">
        <div class="form-group">
          <select name="OFFICERID" id="officer1" autocomplete="off" class="input">
            <option value="">กรรมการดําเนินการสอบ</option>
            <?php for($i=0; $i<count($Result['officerList']); $i++) { ?>
            <option value="<?php echo $Result['officerList'][$i]['OFFICERID'];?>"><?php echo $Result['officerList'][$i]['OFFICERNAME']." ".$Result['officerList'][$i]['OFFICERSURNAME'];?></option>
            <?php  }?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <select name="OFFICER_POSITION" id="officer1" autocomplete="off" class="input">
            <option value="">ตำแหน่งกรรมการดําเนินการสอบ</option>
            <option value="ประธาน">ผู้แทนบัณฑิตวิทยาลัย</option>
            <option value="ผู้ทรงคุณวุฒิ">ผู้ทรงคุณวุฒิ</option>
          </select>
        </div>
      </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-check-circle"></i> เพิ่มอาจารย์คุมสอบ</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

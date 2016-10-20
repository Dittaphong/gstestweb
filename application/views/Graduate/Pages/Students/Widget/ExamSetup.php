<?php $ExamType=$this->uri->segment(4); ?>

<div class='row '>
  <?php $this->load->view('Graduate/Pages/Students/Widget/ExamApproved'); ?>
  <div class='row '></div>
<hr class="inner-separator">
<div class='row '></div>
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
        <div class="col-sm-2">
          <input name="exam_room" class="form-control" type="text" value="<?php echo $room; ?>" placeholder="ห้องสอบ">
        </div>
        <div class="col-sm-2">
          <input name="exam_build" class="form-control" type="text" value="<?php echo $build; ?>" placeholder="อาคาร">
        </div>
        <div class="col-sm-5">
          <div class="input-group date form_datetime" data-date="<?php echo $date; ?>" data-date-format="yyyy-mm-d HH:mm:ss" data-link-field="">
            <input id="exam_date" name="exam_date" class="form-control " size="16" type="text" value="<?php echo $date; ?>" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
        </div>
        <div class="col-sm-3">
          <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> กำหนดวันสอบ</button>
        </div>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?> <?php echo form_open('graduate/Exam_Officer'); ?>
  <input type="hidden" name="EXAM_TYPE" value="<?php echo $ExamType; ?>">
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
            <option value="<?php echo $Result['officerList'][$i]['OFFICERID'];?>"><?php echo $Result['officerList'][$i]['OFFICERPOSITION']." ".$Result['officerList'][$i]['OFFICERNAME']." ".$Result['officerList'][$i]['OFFICERSURNAME'];?></option>
            <?php  }?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <select name="OFFICER_POSITION" id="officer1" autocomplete="off" class="input">
            <option value="">ตำแหน่งกรรมการดําเนินการสอบ</option>
            <option value="ผู้แทนบัณฑิตวิทยาลัย">ผู้แทนบัณฑิตวิทยาลัย</option>
            <option value="ผู้ทรงคุณวุฒิ">ผู้ทรงคุณวุฒิ</option>
          </select>
        </div>
      </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-check-circle"></i> เพิ่มอาจารย์คุมสอบ</button>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?> </div>

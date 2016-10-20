<?php  $approved_status; ?>
<div class='row '></div>
<hr class="inner-separator">
<div class='row '></div>
<div class="col-md-12">
  <h5>คณบดีบัณฑิตวิทยาลัย :</h5>
  <div class="row">
  <?php echo form_open('faculty_controller/SaveApproved/'.$this->uri->segment(4)); ?>
  <input name="ApprovedBy" type="hidden" value="DEAN">
  <input name="student_id" type="hidden" value="<?php echo $Result['Student']['0']['STUDENTID']; ?>">
  <?php if($this->uri->segment(4)=='ADVI'): ?>
  <input name="doc_id" type="hidden" value="<?php echo $Result['DocAdviser']['0']['APPOINT_AVISER_ID']; ?>">
  <?php foreach($Result['RelateAdviser'] as $RelateAdviser){
	  if($RelateAdviser['doc_approved_by'] =='DEAN'){
		  $approved_status = $RelateAdviser['doc_approved_status'];
		  $approved_reason = $RelateAdviser['doc_approved_reason'];
		  $approved_date = $RelateAdviser['doc_approved_date'];

	  }
	  }  ?>
  <?php endif; ?>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-inline fancy-radio custom-bgcolor-green">
          <input type="radio" name="ApprovedStatus" value="1" <?php if($approved_status==1){echo "checked";} ?> >
          <span><i></i>อนุมัติ</span> </label>
        <!-- <label class="control-inline fancy-radio custom-bgcolor-green">
          <input type="radio" name="ApprovedStatus" value="2" <?php if($approved_status==2){echo "checked";} ?>>
          <span><i></i>ไม่อนุมัติ</span> </label> -->
      </div>
    </div>
    <div class="col-md-4">
      <input type="text" class="form-control" name="ApprovedReason" placeholder="เหตุผล" value="<?php if(isset($approved_reason)){echo $approved_reason;} ?>">
    </div>
    <div class="col-sm-5">
      <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-d HH:mm:ss" data-link-field="">
        <input id="doc_date" name="doc_date" class="form-control " size="16" type="text" value="<?php if(isset($approved_date)){echo $approved_date;} ?>" readonly>
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span> </div>
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> บันทึก</button>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

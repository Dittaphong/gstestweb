
<?php  $approved_status; ?>
<div class='row '></div>
<hr class="inner-separator">
<div class='row '></div>
<div class="col-md-12">
  <h5>ประธานคณะกรรมการผู้รับผิดชอบหลักสูตร :</h5>
  <div class="row">
  <?php echo form_open('faculty_controller/SaveApproved/'.$this->uri->segment(4)); ?>
  <input name="ApprovedBy" type="hidden" value="PRES">
  <input name="student_id" type="hidden" value="<?php echo $Result['Student']['0']['STUDENTID']; ?>">
  <?php if($this->uri->segment(4)=='ADVI'): ?>
  <input name="doc_id" type="hidden" value="<?php echo $Result['DocAdviser']['0']['APPOINT_AVISER_ID']; ?>">
  <?php foreach($Result['RelateAdviser'] as $RelateAdviser){
	  if($RelateAdviser['doc_approved_by'] =='PRES'){
		  $approved_status = $RelateAdviser['doc_approved_status'];
		  $approved_reason = $RelateAdviser['doc_approved_reason'];
		  $approved_date = $RelateAdviser['doc_approved_date'];

	  }
	  }  ?>
  <?php endif; ?>


  <div class="col-sm-6">
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

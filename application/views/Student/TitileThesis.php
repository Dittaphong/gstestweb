<div class="row">
  <div class="col-xs-12 col-sm-12 col-lg-12">
  <h1 class="text-center">ยื่นหัวข้อ</h1>
  <?php echo form_open('student/SaveThesisName');?>
    <div class="col-sm-12" style="margin-top:10px;">
      <label for="address" class="col-md-3 control-label" style="text-align:right;padding-top:10px;">หัวข้อภาษาไทย</label>
      <div class="col-sm-8">
        <textarea rows="3" class='form-control input-lg' name="name_th" ><?php $this->debuger->NullObj($Result[0]['thesis_name_th']); ?></textarea>
      </div>
    </div>
    <div class="col-sm-12" style="margin-top:10px;">
      <label for="email" class="col-sm-3 control-label" style="text-align:right;padding-top:10px;">หัวข้อภาษาอังกฤษ</label>
      <div class="col-sm-8">
        <textarea rows="3" class='form-control input-lg' name="name_en" ><?php $this->debuger->NullObj($Result[0]['thesis_name_en']); ?></textarea>
      </div>
    </div>
    <div class="col-sm-12" style="text-align:center;"><br>
      <button  type="submit" name="topicPropersal" class="btn btn-primary btn-lg">บันทึกหัวข้อ</button>
    </div>
    <?php echo form_close();?>
  </div>
</div>

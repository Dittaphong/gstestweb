<div class="widget">
  <div class="widget-header">
    <h3><i class="fa fa-edit"></i> วันที่เกี่ยวข้องกับหลักสูตร</h3>
  </div>
  <div class="widget-content">
    <div class="form-horizontal">
      <div class="form-group">
        <label class="col-md-3 control-label" style="font-size:12px;">วันรับทราบหลักสูตร</label>
        <div class="col-md-9">
          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" id="" class="form-control datepicker"
													name="CREATEDATE"
													value="<?php
													$this->debuger->NullObj($Result['PROGRAM'][0]['CREATEDATE']); ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label">วันอนุมัติหลักสูตร</label>
        <div class="col-md-9">
          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" id="" class="form-control datepicker"
													name="OPENDATE"
													value="<?php
													$this->debuger->NullObj($Result['PROGRAM'][0]['OPENDATE']); ?>">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label">วันหมดอายุ</label>
        <div class="col-md-9">
          <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" id="" class="form-control datepicker"
													name="CLOSEDATE"
													value="<?php
													$this->debuger->NullObj($Result['PROGRAM'][0]['CLOSEDATE']); ?>">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

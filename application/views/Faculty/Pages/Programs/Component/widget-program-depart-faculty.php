<div class="widget">
  <div class="widget-header">
    <h3><i class="fa fa-edit"></i> คณะ/สาขาวิชา</h3>
  </div>
  <div class="widget-content">
    <div class="row">
      <div class="col-md-12">
        <label>คณะ</label>
        <select id="FACULTY" name="FACULTYID" style="display: none;">
          <option value="999">คณะ</option>
          <?php foreach ($Result['FACULTY'] as $Result['FACULTY']): ?>
          <option <?php if ($Result['FACULTY']['FACULTYID']==$Result['PROGRAM'][0]['FACULTYID']): ?>
											selected="selected"
										<?php endif; ?>
										value="<?php echo $Result['FACULTY']['FACULTYID'] ?>"><?php echo $Result['FACULTY']['FACULTYNAME'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-12">
        <label>สาขาวิชา</label>
        <select id="DEPARTMENT" name="DEPARTMENTID" style="display: none;">
          <option value="999">สาขาวิชา</option>
          <?php foreach ($Result['DEPARTMENT'] as $Result['DEPARTMENT']): ?>
          <option <?php if ($Result['DEPARTMENT']['DEPARTMENTID'] == $Result['PROGRAM'][0]['DEPARTMENTID']): ?>
											selected="selected"
										<?php endif; ?>
										value="<?php echo $Result['DEPARTMENT']['DEPARTMENTID'] ?>"><?php echo $Result['DEPARTMENT']['DEPARTMENTNAME'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
</div>

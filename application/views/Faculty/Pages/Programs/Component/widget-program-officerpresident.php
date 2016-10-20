<div class="widget">
          <div class="widget-header">
            <h3><i class="fa fa-edit"></i> ประธานกรรมการผู้รับผิดชอบหลักสูตร</h3>
          </div>
          <div class="widget-content">
            <div class="row">
              <div class="col-md-12">
                <select id="OFFICER" name="OFFICERID" style="display: none;">
                  <option value="">เลือกจากรายชื่ออาจารย์</option>
                  <?php $officerPresidentId = $this->debuger->NullObj($Result['PROGRAM'][0]['OFFICERID']); ?>
                  <?php foreach ($Result['OFFICER'] as $OFFICER): ?>
                  <option <?php if ($OFFICER['OFFICERID']==$officerPresidentId): ?>
					selected="selected"
					<?php endif; ?>
					value="<?php echo $OFFICER['OFFICERID'] ?>"><?php echo $OFFICER['OFFICERPOSITION'] ?> <?php echo $OFFICER['OFFICERNAME'] ?> <?php echo $OFFICER['OFFICERSURNAME'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>

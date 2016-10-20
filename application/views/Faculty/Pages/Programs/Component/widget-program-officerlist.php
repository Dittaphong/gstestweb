<?php if (!isset($Result['PROGRAM'][0]['PROGRAMID'])): ?>

<div class="alert alert-warning alert-dismissable"> <strong>หมายเหตุ:</strong> ต้องทำการบันทึกหลักสูตรก่อน จึงจะสามารถเพิ่มคณะกรรมการได้ </div>
<?php else : ?>
<style media="screen">
.col-input [class*="col-"] {
	margin: 0px 0px 10px;
}
</style>
<div class="col-md-12">


      <h3><i class="fa fa-edit"></i> รายชื่ออาจารย์ประจำหลักสูตร</h3>


      <div class="row">
        <div class="col-md-12">
          <table id="" class="table table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">
            <thead>
              <tr role="row">
                <th>#</th>
                <th>ชื่อ-สกุล</th>
                <th>ตำแหน่ง</th>
                <th>จัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php echo form_open('graduate/SaveOfficerToProg/'); ?>
            <input type="hidden" name="PROGRAMID" value="<?php $this->debuger->NullObj($Result['PROGRAM'][0]['PROGRAMID']); ?>">
            <tr role="row" class="odd">
              <td></td>
              <td><select id="OFFICER_NEW" name="OFFICER_NEW" style="display: none;">
                  <option value="0">เลือกจากรายชื่ออาจารย์</option>
                  <?php $officerPresidentId = $this->debuger->NullObj($Result['PROGRAM'][0]['OFFICERID']);?>
                  <?php foreach ($Result['OFFICER_NEW'] as $OFFICER_NEW): ?>
                  <option value="<?php echo $OFFICER_NEW['OFFICERID'] ?>"><?php echo $OFFICER_NEW['OFFICERPOSITION'] ?> <?php echo $OFFICER_NEW['OFFICERNAME'] ?> <?php echo $OFFICER_NEW['OFFICERSURNAME'] ?></option>
                  <?php endforeach; ?>
                </select></td>
              <td><label class="fancy-checkbox">
                  <input type="checkbox" value="1" name="ChkPresident">
                  <span>ประธานกรรมการผู้รับผิดชอบหลักสูตร</span> </label></td>
              <th><button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> </button></th>
            </tr>
            <?php echo form_close(); ?>
            <?php $ii=1; foreach ($Result['OFFICER_LI'] as $OFFICER_LI): ?>
            <tr role="row" class="odd">
              <td valign="middle"><?php echo $ii;?></td>
              <td valign="middle"><span><?php echo $OFFICER_LI['OFFICERPOSITION'] ?></span> <span><?php echo $OFFICER_LI['OFFICERNAME']; ?></span> <span><?php echo $OFFICER_LI['OFFICERSURNAME']; ?></span></td>
              <td valign="middle"><?php if($OFFICER_LI['PROG_OFFICER_POSITION']==1){ echo "ประธานกรรมการผู้รับผิดชอบหลักสูตร";}else{echo "กรรมการ";}?></td>
              <td valign="middle"><button type="button" class="btn btn-danger btn-sm" onClick="window.location.href='<?php echo site_url(); ?>/graduate/DelOfficerFromList/<?php echo $OFFICER_LI['PROGRAMOFFICER_ID']; ?>'"> <i class="glyphicon glyphicon-remove"></i> </button></td>
            </tr>
            <?php $ii++; endforeach; ?>
              </tbody>

          </table>
        </div>
      </div>
    </div>


<?php endif ?>

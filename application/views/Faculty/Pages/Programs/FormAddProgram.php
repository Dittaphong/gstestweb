<div class="content">
  <div class="main-header"> <?php echo form_open('graduate/SaveProgram'); ?>
    <input type="hidden" name="PROG_NUM" value="<?php isset($Result['PROGRAM'][0]['PROG_NUM']) ? $Result['PROGRAM'][0]['PROG_NUM'] : $Result['PROGRAM'][0]['PROG_NUM'] = ''; echo $Result['PROGRAM'][0]['PROG_NUM']; ?>"/>
    <h2>เพิ่มหลักสูตร</h2>

    <!-- <em>WYSIWYG and Markdown editor</em> -->
    <button type="submit" class="btn btn-success" id="" ><i class="fa fa-save"></i> บันทึก</button>
    <button type="button" class="btn btn-warning" id="" onClick="window.location.href='<?php echo site_url(); ?>/graduate/ProgramsSearch'"><i class="glyphicon glyphicon-remove"></i> ยกเลิก</button>
    <?php if(isset($Result['PROGRAM'][0]['PROGRAMID'])): ?>
      <?php if ($Result['PROGRAM'][0]['PROGRAM_STATUS']==1): ?>
    <button type="button" class="btn btn-info"
    onClick="window.location.href='<?php echo site_url(); ?>/graduate/deactiveProgram/<?php echo $Result['PROGRAM'][0]['PROGRAMID']; ?>'">

  <i class="glyphicon glyphicon-eye-open"></i> เปิดการใช้งาน</button>
  <?php else: ?>
    <button type="button" class="btn btn-danger"
    onClick="window.location.href='<?php echo site_url(); ?>/graduate/deactiveProgram/<?php echo $Result['PROGRAM'][0]['PROGRAMID']; ?>'">

  <i class="glyphicon glyphicon-eye-close"></i> ปิดการใช้งาน</button>
<?php endif; ?>

    <?php endif; ?>
  </div>
  <div class="main-content">
    <ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
      <li class="active"><a href="#program-tab" data-toggle="tab"><i class="fa fa-user"></i> ข้อมูลพื้นฐาน</a></li>
      <li><a href="#expense-tab" data-toggle="tab"><i class="fa fa-rss"></i> ค่าใช้จ่าย</a></li>
      <li><a href="#structure-tab" data-toggle="tab"><i class="fa fa-gear"></i> โครงสร้างหลักสูตร</a></li>
      <li><a href="#officerlist-tab" data-toggle="tab"><i class="fa fa-gear"></i> รายชื่ออาจารย์ที่เกี่ยวเนื่องในหลักสูตร</a></li>
    </ul>
    <div class="tab-content profile-page">
      <!-- PROFILE TAB CONTENT -->
      <div class="tab-pane program active" id="program-tab">
        <div class="widget-content">
          <div class="row">
            <div class="col-md-12">
              <!-- หลักสูตร -->
              <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-publicname');?>
              <!-- วันที่เกี่ยวข้องหลักสูตร -->
              <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-daterefer');?>

              <!-- ปริญญาและสาขาวิชา -->
              <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-name');?>
              <!-- คณะและสาขา -->
              <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-depart-faculty');?>
            </div>
          </div>
        </div>
      </div>
      <!-- END PROFILE TAB CONTENT -->
      <!-- ACTIVITY TAB CONTENT -->
      <div class="tab-pane expense" id="expense-tab">
        <!-- ค่าใช้จ่ายในการเล่าเรียน -->
        <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-progcost');?>
        <?php echo form_close(); ?> </div>
      <!-- END ACTIVITY TAB CONTENT -->
      <!-- SETTINGS TAB CONTENT -->
      <div class="tab-pane structure" id="structure-tab">
        <!-- โครงสร้างหลักสูตร -->
        <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-progstructure');?>
      </div>
      <div class="tab-pane officerlist" id="officerlist-tab">
        <!-- รายชื่ออาจารย์ในสาขา -->

        <?php $this->load->view('Graduate/Pages/Programs/Component/widget-program-officerlist');?>
      </div>
      <!-- END SETTINGS TAB CONTENT -->
    </div>
  </div>
  <!-- /main-content -->
</div>

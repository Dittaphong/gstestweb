<div class="main-header">  <button type="button" class="btn btn-primary" onClick="window.location.href='<?php echo site_url(); ?>/graduate/FormEditProgram'" ><i class="glyphicon glyphicon-edit"></i> สร้างใหม่</button></div><div class="row">  <?php //echo "<pre>";print_r($Result['facultyLists']); ?>  <div class="col-md-3"></div>  <div class="col-md-6">    <div class="widget">      <div class="widget-header">        <h3><i class="fa fa-edit"></i>ค้นหาหลักสูตร</h3>      </div>      <div class="widget-content">        <?php echo form_open('graduate/ProgramsResult','class="form-horizontal label-left" role="form"'); ?>        <form class="form-horizontal label-left" role="form">          <div class="form-group">            <label for="officercode" class="col-sm-4 control-label">ชื่อหลักสูตร</label>            <div class="col-sm-8">              <input id="programname" name="programname" class="form-control" type="text">            </div>          </div>          <div class="form-group">            <label for="tax-id" class="col-sm-4 control-label">คณะ</label>            <div class="col-sm-8">              <select class="select2-input" name="facultyname">                <option value=""> -- เลือกหรือพิมพ์ค้นหา --</option>                <?php foreach ($Result['facultyLists'] as $key => $value) { ?>                  <option value="<?=$value['FACULTYID'];?>">-<?=$value['FACULTYNAME'];?></option>                <?php } ?>              </select>            </div>          </div>          <div class="form-group">            <label for="tax-id" class="col-sm-4 control-label">ภาควิชา</label>            <div class="col-sm-8">              <select class="select2-input" name="departmentname">                <option value=""> -- เลือกหรือพิมพ์ค้นหา --</option>                <?php foreach ($Result['departmentLists'] as $key => $value) { ?>                  <option value="<?=$value['DEPARTMENTID'];?>">-<?=$value['DEPARTMENTNAME'];?></option>                <?php } ?>              </select>            </div>          </div>          <div class="form-group">            <label for="officername" class="col-sm-4 control-label">ระดับปริญญา</label>            <div class="col-sm-8">              <input id="officerExpert name="officerExpert class="form-control" type="text">            </div>          </div>          <div class="form-group">            <label for="officername" class="col-sm-4 control-label">ปีการศึกษา</label>            <div class="col-sm-8">              <div class="row">                <div class="col-md-5">                  <input id="programyearfor name="programyearfor class="form-control" type="text">                </div>                <div class="col-md-1">ถึง</div>                <div class="col-md-6">                  <input id="programyearto name="programyearto class="form-control" type="text">                </div>              </div>            </div>          </div>          <div class="form-group">            <label for="ssn" class="col-sm-9 control-label"></label>            <div class="col-sm-3">              <button type="submit" class="btn btn-primary">ค้นหา</button>            </div>          </div>        <?php echo form_close(); ?>      </div>    </div></div><div class="col-md-3"></div></div><!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --><div style="display:none"><?php echo form_open('graduate/GraduateProgramsFilter'); ?><div class="row" ><div class="col-md-4"> <div class="widget widget-table">        <div class="widget-header">          <h3><i class="fa fa-table"></i>ค้นหาหลักสูตร</h3>        </div>        <div class="widget-content">        <div class="table-responsive">          <table border="0"  cellspacing="0" width="100%">            <tbody>              <tr id="" class="tr_filter" data-column="0">                <td class="td_topic"><h4>ชื่อหลักสูตร</h4></td>                <td class="input_table col-md-7"><input name="programname" class="column_filter form-control col-sm-10" id="" type="text"></td>              </tr>              <tr id="" class="tr_filter" data-column="1">                <td class="td_topic"><h4>คณะ</h4></td>                <td class="input_table col-md-7"><input name="facultyname" class="column_filter form-control col-sm-10" id="" type="text"></td>              </tr>              <tr id="" class="tr_filter" data-column="2">                <td class="td_topic"><h4>สาขาวิชา</h4></td>                <td class="input_table col-md-7"><input name="departmentname" class="column_filter form-control col-sm-10" id="" type="text"></td>              </tr>              <tr id="" class="tr_filter" data-column="3">                <td class="td_topic"><h4>ระดับปริญญา</h4></td>                <td class="input_table col-md-7"><input name="levelname" class="column_filter form-control col-sm-10" id="" type="text"></td>              </tr>              <tr id="" class="tr_filter" data-column="4">                <td class="td_topic"><h4>ปีการศึกษา (ตั้งแต่)</h4></td>                <td class="input_table col-md-7"><input  name="programyearfor" id="min" name="min" type="text" class="form-control"></td>              </tr>              <tr id="" class="tr_filter" data-column="4">                <td class="td_topic"><h4>ปีการศึกษา (ถึง)</h4></td>                <td class="input_table col-md-7"><input name="programyearto" id="max" name="max" type="text" class="form-control"></td>              </tr>            </tbody>          </table>        </div>        </div>        <div class="modal-footer">          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>          <button type="submit" class="btn btn-primary">ค้นหา</button>        </div>      </div></div></div><?php echo form_close(); ?></div><!--end display:none-->
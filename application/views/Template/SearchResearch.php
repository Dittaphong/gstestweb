<div class="main-content">
  <ul class="nav nav-pills nav-pills-custom-minimal custom-minimal-bottom" role="tablist">
    <li class="active"><a href="#searchResearch" role="tab" data-toggle="tab" aria-expanded="false">
      <i class="icon ion-reply-all"></i> ค้นหางานวิจัย</a></li>
  	<!-- <li class=""><a href="#addResearch" role="tab" data-toggle="tab" aria-expanded="true">
      <i class="icon ion-social-rss"></i> เพิ่มข้อมูลงานวิจัย</a></li> -->

  </ul>
<div class="tab-content">

  <div id="searchResearch" class="tab-pane fade  active in">
    <div class="row">
        <?php //print_r($Result); ?>
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="widget">
            <div class="widget-header">
              <h3><i class="fa fa-edit"></i>ค้นหางานวิจัย</h3>
            </div>
            <div class="widget-content">
              <?php echo form_open('student/search_research','class="form-horizontal label-left" role="form"'); ?>
              <div class="form-group">
                <label for="stdcode" class="col-sm-5 control-label">รหัสนักศึกษา</label>
                <div class="col-sm-7">
                  <input name="stdcode" class="form-control col-sm-10" id="stdcode" type="text">
                </div>
              </div>

                <div class="form-group">
                  <label for="researchcode" class="col-sm-5 control-label">ชื่องานวิจัย</label>
                  <div class="col-sm-7">
                    <input id="researchname" name="researchname" class="form-control" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tax-id" class="col-sm-5 control-label">คณะ</label>
                  <div class="col-sm-7">
                    <select class="select2-input" name="facultyid">
                      <option value=""> -- เลือกหรือพิมพ์ค้นหา --</option>
                      <?php foreach ($Result['facultyLists'] as $key => $value) { ?>
                        <option value="<?=$value['FACULTYID'];?>">-<?=$value['FACULTYNAME'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tax-id" class="col-sm-5 control-label">ภาควิชา</label>
                  <div class="col-sm-7">
                    <select class="select2-input" name="departmentid">
                      <option value=""> -- เลือกหรือพิมพ์ค้นหา --</option>
                      <?php foreach ($Result['departmentLists'] as $key => $value) { ?>
                        <option value="<?=$value['DEPARTMENTID'];?>">-<?=$value['DEPARTMENTNAME'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ssn" class="col-sm-5 control-label">ระดับการศึกษา</label>
                  <div class="col-sm-7">
                    <select class="select2-input" name="levelid">
                      <option value=""> -- เลือกหรือพิมพ์ค้นหา --</option>
                      <?php foreach ($Result['level'] as $key => $value) { ?>
                        <option value="<?=$value['LEVELID'];?>">-<?=$value['LEVELNAME'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ssn" class="col-sm-9 control-label"></label>
                  <div class="col-sm-3">
                    <input type="submit" class="btn btn-primary form-control" name="submitBtn" value="ค้นหา"/>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>

    <div id="test"></div>


      <div class="col-md-12">
        <div class="widget-content">
          <?php if(isset($Result['researchInfo'])){?>
          <table id="StudentsAll2" class="table table-bordered table-responsive t" role="grid">
            <thead>
              <tr role="row">
                <th>ชื่องานวิจัย</th>
                <th>สถานภาพ</th>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ-นามสกุล</th>
                <th>คณะ</th>
                <th>สาขา/แผนการศึกษา</th>
                <th>ระดับการศึกษา</th>

              </tr>
            </thead>
            <tbody>
            <?php //echo "<pre>";print_r($Result['researchInfo']);?>
              <?php if(count($Result['researchInfo'])>0){?>
              <?php foreach ($Result['researchInfo'] as $Result =>$value): ?>

              <tr role="row" class="odd">
                <?php $a = $this->studentsmodel->getStudentInfo2($value['STUDENTID'],'STUDENTNAME,STUDENTSURNAME,PREFIXID,STUDENTCODE');?>

                <td>
                  <!-- <a href="<?=base_url();?>index.php/graduate/studentInfo/<?//=$value['STUDENTID'].'/'.$a[0]['STUDENTCODE'];?>"> -->
                  <a href="javascript:modalStdInfo(<?=$value['STUDENTID'];?>,<?=$a[0]['STUDENTCODE'];?>)">
                    <?php echo $value['RESEARCHNAME']; ?>
                  </a>
                </td>
                <td><?php echo $value['RESEARCHSTATUS']; ?></td>
                <td><?php echo $value['STUDENTID']; ?></td>
                <td>
                  <?php
                      $prefix = $this->studentsmodel->getPrefix($a[0]['PREFIXID'],'PREFIXNAME');
                        echo   $prefix[0]['PREFIXNAME']." ".$a[0]['STUDENTNAME']."  ".$a[0]['STUDENTSURNAME'];
                  ?>
                </td>
                <td>
                  <?php
                      $a = $this->graduatemodel->getFacultyInfo($value['FACULTYID']);
                          echo @$a[0]['FACULTYNAME'];
                  ?>
                </td>
                <td>
                  <?php
                      $a = $this->studentsmodel->getDepartmentInfo($value['DEPARTMENTID']);
                            echo @$a[0]['DEPARTMENTNAME'];
                   ?>
                </td>
                <td>
                  <?php
                      $a = $this->studentsmodel->getLevelIDInfo($value['LEVELID']);
                            echo @$a[0]['LEVELNAME'];
                   ?>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php }else{ ?>
                <tr><td colspan="7">ไม่พบข้อมูล</td></tr>
              <?php } ?>
            </tbody>
          </table>
          <?php }//end if ?>
        </div>
      </div>
  </div>

  <div id="addResearch" class="tab-pane fade  in" style="display:none">
    <?php echo form_open_multipart('student/search_research','class="form" id="myform"');?>
    <div class="widget">

											<div class="widget-content">
												<form class="form-horizontal" role="form">
													<fieldset>
														<legend>Submit New Paper <span style="font-size:14px">* is required</span></legend>

														<div class="form-group">
															<label for="ticket-name" class="col-sm-3 control-label">ชื่องานวิจัย *</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" name="researchName" id="researchName" placeholder="Name">
															</div>
														</div>
														<div class="form-group">
															<label for="ticket-email" class="col-sm-3 control-label">Title*</label>
															<div class="col-sm-9">
																<input type="input" class="form-control"  name="title" id="title" placeholder="Email">
															</div>
														</div>

                            <div class="form-group">
															<label for="ticket-message" class="col-sm-3 control-label">บทคัดย่อ *</label>
															<div class="col-sm-9">
																<textarea class="form-control" name="thaiAbstract" id="thaiAbstract" rows="5" cols="30" placeholder="Message"></textarea>
															</div>
														</div>
                            <div class="form-group">
															<label for="ticket-message" class="col-sm-3 control-label">Abstract *</label>
															<div class="col-sm-9">
																<textarea class="form-control" name="engAbstract" id="engAbstract" rows="5" cols="30" placeholder="Message"></textarea>
															</div>
														</div>
														<div class="form-group" >
															<label for="ticket-priority" class="col-sm-3 control-label">Keyword *</label>
															<div class="col-sm-9">
          												<p class="help-block"><em>Type a word then hit enter</em></p>
          												<input type="text" name="keyword" value="" data-role="tagsinput" style="width:200px"/>
														</div>

														<div class="form-group">
															<label for="ticket-attachment" class="col-sm-3 control-label">Attach File *</label>
															<div class="col-md-9">
																<input type="file" id="file" name="file">
																<p class="help-block"><em>Valid file type: .jpg, .png, .txt, .pdf. File size max: 1 MB</em></p>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-offset-3 col-sm-9">
																<input type="submit" class="btn btn-primary" name="addResearchBtn" value="Submit"/>
															</div>
														</div>
													</fieldset>
												</form>
											</div>
										</div>
      <?php echo form_close();?>
  </div>

</div>






<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="row">  <div class="col-md-12">    <div class="widget">    <div class="widget-header">        <h3>อาจารย์ที่ปรึกษาหลักวิทยานิพนธ์</h3>      </div>      <div class="widget-content">        <table id="SBOMainThesis1" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">          <thead>            <tr role="row">              <th>รหัสนักศึกษา</th>              <th>ชื่อ-นามสกุล</th>              <th>คณะ</th>              <th>สาขา/แผนการศึกษา</th>              <th>ระดับการศึกษา</th>              <th>ปีการศึกษา</th>              <th>สถานภาพ</th>            </tr>          </thead>          <tbody>            <?php foreach ($Result['StudentByOfficerMainThesis'] as $Result['STD']): ?>            <tr role="row" class="odd">              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTCODE']; ?></a></td>              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTNAME']." ".$Result['STD']['STUDENTSURNAME']; ?></a></td>              <td><?php echo $Result['STD']['FACULTYNAME']; ?></td>              <td style="width: 15%;"><?php echo $Result['STD']['DEPARTMENTNAME']; ?></td>              <td><?php echo $Result['STD']['LEVELNAME']; ?></td>              <td><?php echo $Result['STD']['CURRENTACADYEAR']; ?></td>              <td><?php echo $Result['STD']['procedure_name']; ?></td>							</tr>            <?php endforeach; ?>          </tbody>        </table>      </div>    </div>  </div></div><div class="row">  <div class="col-md-12">    <div class="widget">      <div class="widget-header">        <h3>อาจารย์ที่ปรึกษาร่วมวิทยานิพนธ์</h3>      </div>      <div class="widget-content">        <table id="StudentByOfficerCoThesis" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">          <thead>            <tr role="row">              <th>รหัสนักศึกษา</th>              <th>ชื่อ-นามสกุล</th>              <th>คณะ</th>              <th>สาขา/แผนการศึกษา</th>              <th>ระดับการศึกษา</th>              <th>ปีการศึกษา</th>              <th>สถานภาพ</th>            </tr>          </thead>          <tbody>            <?php foreach ($Result['StudentByOfficerCoThesis'] as $Result['STD']): ?>							<tr role="row" class="odd">              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTCODE']; ?></a></td>              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTNAME']." ".$Result['STD']['STUDENTSURNAME']; ?></a></td>              <td><?php echo $Result['STD']['FACULTYNAME']; ?></td>              <td style="width: 15%;"><?php echo $Result['STD']['DEPARTMENTNAME']; ?></td>              <td><?php echo $Result['STD']['LEVELNAME']; ?></td>              <td><?php echo $Result['STD']['CURRENTACADYEAR']; ?></td>              <td><?php echo $Result['STD']['procedure_name']; ?></td>							</tr>            <?php endforeach; ?>          </tbody>        </table>      </div>    </div>  </div></div><div class="row">  <div class="col-md-12">    <div class="widget">      <div class="widget-header">        <h3>อาจารย์ที่ปรึกษาหลักค้นคว้าอิสระ</h3>      </div>      <div class="widget-content">        <table id="StudentByOfficerMainIs" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">          <thead>            <tr role="row">              <th>รหัสนักศึกษา</th>              <th>ชื่อ-นามสกุล</th>              <th>คณะ</th>              <th>สาขา/แผนการศึกษา</th>              <th>ระดับการศึกษา</th>              <th>ปีการศึกษา</th>              <th>สถานภาพ</th>            </tr>          </thead>          <tbody>            <?php foreach ($Result['StudentByOfficerMainIs'] as $Result['STD']): ?>            <tr role="row" class="odd">              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTCODE']; ?></a></td>              <td><a href="<?php echo site_url()."/graduate/StudentCommand/".$Result['STD']['STUDENTID']; ?>/appointAdviser" ><?php echo $Result['STD']['STUDENTNAME']." ".$Result['STD']['STUDENTSURNAME']; ?></a></td>              <td><?php echo $Result['STD']['FACULTYNAME']; ?></td>              <td style="width: 15%;"><?php echo $Result['STD']['DEPARTMENTNAME']; ?></td>              <td><?php echo $Result['STD']['LEVELNAME']; ?></td>              <td><?php echo $Result['STD']['CURRENTACADYEAR']; ?></td>              <td><?php echo $Result['STD']['procedure_name']; ?></td>							</tr>            <?php endforeach; ?>          </tbody>        </table>      </div>    </div>  </div></div>
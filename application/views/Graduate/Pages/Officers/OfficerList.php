<div class="main-content"><div class="row">  <div class="col-md-12">    <table id="OfficersAll" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">      <thead>        <tr role="row">          <th>รหัส</th>          <th>ตำแหน่ง</th>          <th>ชื่อ-สกุล</th>          <th>คณะ</th>          <th>สาขา</th>        </tr>      </thead>      <tbody>        <?php foreach ($Result as $Result): ?>        <tr role="row" class="odd">          <td><a href="<?php echo site_url()."/graduate/Officerinfo/".$Result['OFFICERID'] ?>"><?php echo $Result['OFFICERCODE']; ?></a></td>          <td><?php echo $Result['OFFICERPOSITION']; ?></td>          <td><a href="<?php echo site_url()."/graduate/Officerinfo/".$Result['OFFICERID'] ?>"><?php echo $Result['OFFICERNAME']." ".$Result['OFFICERSURNAME']; ?></a></td>          <td><?php echo $Result['FACULTYNAME']; ?></td>          <td><?php echo $Result['DEPARTMENTNAME']; ?></td        </tr>        <?php endforeach; ?>      </tbody>    </table>  </div></div>
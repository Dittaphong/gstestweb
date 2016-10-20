
<div class="main-content">
<div class="row">
  <div class="col-md-12">
    <table id="OfficersAll" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">
      <thead>
        <tr role="row">
          <th>รหัส</th>
          <th>ชื่อ-สกุล</th>
          <th>คณะ</th>
          <th>สาขา</th>
          <th>สถานะบุคลากร</th>
         
        </tr>
      </thead>
      <tbody>
        <?php foreach ($Result as $Result): ?>
        <tr role="row" class="odd">
          <td><?php echo $Result['OFFICERCODE']; ?></td>
          <td><p><span><?php echo $Result['OFFICERNAME']; ?></span> <span><?php echo $Result['OFFICERSURNAME']; ?></span></p></td>
          <td><?php echo $Result['FACULTYNAME']; ?></td>
          <td><?php echo $Result['DEPARTMENTNAME']; ?></td>
          <td><?php echo $Result['OFFICERPOSITION']; ?></td>
         
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

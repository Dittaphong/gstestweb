<div class="main-header">
<div class="main-content">

  <div class="row">
  
    <div class="col-md-12">
    
      <div class="widget-content">
        <table id="StudentsAll" class="table table-bordered table-responsive table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">
          <thead>
            <tr role="row">
              <th>รหัสนักศึกษา</th>
              <th>ชื่อ-นามสกุล</th>
              <th>คณะ</th>
              <th>สาขา/แผนการศึกษา</th>
              <th>ระดับการศึกษา</th>
              <th>ปีการศึกษา</th>
              <th>สถานภาพ</th>
              <th>จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($Result as $Result): ?>
            <tr role="row" class="odd">
              <td><a href="<?php echo site_url(); ?>/graduate/student_thesis_is_info/<?php echo $Result['STUDENTID']; ?>" target="_blank"><?php echo $Result['STUDENTCODE']; ?></a></td>
              <td><a href="<?php echo site_url(); ?>/graduate/student_thesis_is_info/<?php echo $Result['STUDENTID']; ?>" target="_blank">
                <p><span><?php echo $Result['STUDENTNAME']; ?></span> <span><?php echo $Result['STUDENTSURNAME']; ?></span></p>
                </a></td>
              <td><?php echo $Result['FACULTYNAME']; ?></td>
              <td><?php echo $Result['DEPARTMENTNAME']; ?></td>
              <td><?php echo $Result['LEVELNAME']; ?></td>
              <td><?php echo $Result['CURRENTACADYEAR']; ?></td>
              <td><?php echo $Result['procedure_name']; ?></td>
              
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

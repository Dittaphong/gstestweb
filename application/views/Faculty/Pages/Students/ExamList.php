<div class="main-header">
<div class="main-content">
  <div class="row">
    <div class="col-md-12">
      <div class="widget-content">
        <div class="table">
            <table id="" class="table colored-header datatable project-list" role="grid" aria-describedby="datatable-column-filter_info">
          <thead>
            <tr role="row">
              <th>รหัสนักศึกษา</th>
              <th>ชื่อ-นามสกุล</th>
              <th>คณะ</th>
              <th>วันที่ทำเอกสาร</th>
              <th>ระดับการศึกษา</th>
              <th>ปีการศึกษา</th>
              <th>สถานภาพ</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($Result as $Result): ?>
            <tr role="row" class="odd">
              <td><a href="<?php echo site_url(); ?>/faculty_controller/StudentCommand/<?php echo $Result['STUDENTID']."/".$this->uri->segment(3);?>" target="_blank"><?php echo $Result['STUDENTCODE']; ?></a></td>
              <td><a href="<?php echo site_url(); ?>/faculty_controller/StudentCommand/<?php echo $Result['STUDENTID']."/".$this->uri->segment(3); ?>" target="_blank">
                <p><span><?php echo $Result['PREFIXNAME'].$Result['STUDENTNAME']; ?></span> <span><?php echo $Result['STUDENTSURNAME']; ?></span></p>
                </a></td>
              <td><?php echo $Result['FACULTYNAME']; ?></td>
              <td><?php echo $this->debuger->DateThai($Result['EXAM_CREATE_DATE']); ?></td>
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
</div>

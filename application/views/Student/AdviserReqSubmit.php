<?php

 $StudentType = $Result['Student'][0]['LEVELID'];

if ($StudentType>=80 && $StudentType<=89) {
  $QECEName = "คำร้องขอสอบวัดความรู้";
} else {
  $QECEName = "คำร้องขอสอบวัดคุณสมบัติ";
}
if ($StudentType!=82) {
    $StudentTypeName = "วิทยานิพนธ์";
    $PROPName = "คำร้องขอสอบเค้าโครงการค้นคว้าอิสระ";
    $THESName = "คำร้องขอสอบการค้นคว้าอิสระ";
} else {
    $StudentTypeName = "การค้นคว้าอิสระ";

    $PROPName = "คำร้องขอสอบเค้าโครงวิทยานิพนธ์";
    $THESName = "คำร้องขอสอบวิทยานิพนธ์";
}


?>


<?php echo "STUDENTID=".$_SESSION['STUDENTID'];?><br />
<?php echo form_open('/student/AdviserReqSubmit')?>
  <input type="hidden" name="studentid" value="<?=$_SESSION['STUDENTID']?>"/>
  <input type="submit" value="แต่งตั้งอาจารย์ที่ปรึกษา"  name="submitBtn" class="btn btn-info" />
<?php echo form_close()?>

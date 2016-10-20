<?php
  echo form_open('/graduateByJo/selectGraduateOfficer');
  echo "<ul>";
   foreach ($Result as $key => $value) {
     echo "<li><input type='checkbox' name='graduateOfficer[]' class='onoffswitch-checkbox' id='myonoffswitch4'
     value='".$value['OFFICERID']."'>".$value['PREFIXNAME'].$value['OFFICERNAME']." ".$value['OFFICERSURNAME']."</li>";
   }
   echo "</ul>";
   echo "<input type='submit' value='บันทึก' name='selectGraduateOfficerBtn'/>";
   echo form_close();
 ?>

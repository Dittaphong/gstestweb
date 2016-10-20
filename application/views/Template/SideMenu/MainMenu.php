<?php
if (count($_SESSION)>0) {
  if ($_SESSION['GROUPTYPE']=="ADMIN") {
    $this->load->view('Template/SideMenu/AdminMenu');
  }
  else if($_SESSION['GROUPTYPE']=="TEACHER") {
    $this->load->view('Template/SideMenu/OfficerMenu');
  }
  else if($_SESSION['GROUPTYPE']=="STUDENT") {
    $this->load->view('Template/SideMenu/StudentMenu');
  }
  else if($_SESSION['GROUPTYPE']=="FACULTY") {
    $this->load->view('Template/SideMenu/FacultyMenu');
  }
} else {
  redirect(graduate);
}
?>



<script type="text/javascript">
$( document ).ready(function() {
	var url = window.location;
	// Will only work if string in href matches with location
	$('.main-menu a[href="'+ url +'"]').parent().addClass('active');
	$('.thispages').html($('.main-menu a[href="'+ url +'"]').html());
	
	// Will also work for relative and absolute hrefs
	$('.main-menu a').filter(function() {
		return this.href == url;
	}).parent().addClass('active');
});
</script>
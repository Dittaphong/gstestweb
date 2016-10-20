<!-- Main Menu -->
<nav class="main-nav">
  <ul class="main-menu">
    <!--<ul class="nav nav-tabs nav-tabs-custom-colored" id="headmenu">-->
    <li><a href="<?php echo site_url();?>/graduate/" >
      <i class="glyphicon glyphicon-dashboard"></i><span class="text"> ข้อมูลภาพรวม</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/AdvisorList/ADVI" >
      <i class="glyphicon glyphicon-heart"></i><span class="text"> แต่งตั้งที่ปรึกษา</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/ExamList/QECE" >
      <i class="glyphicon glyphicon-inbox"></i><span class="text"> ขอสอบ QE/CE</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/ExamList/PROP" >
      <i class="glyphicon glyphicon-inbox"></i><span class="text"> ขอสอบเค้าโครง</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/ExamList/THES" >
      <i class="glyphicon glyphicon-inbox"></i><span class="text"> ขอสอบวิทยานิพนธ์</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/home/SearchStudent" >
      <i class="glyphicon glyphicon-education"></i><span class="text"> ข้อมูลนักศึกษา</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/OfficerList" >
      <i class="fa fa-users"></i><span class="text"> ข้อมูลอาจารย์</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/ProgramsSearch" >
      <i class="glyphicon glyphicon-bookmark"></i><span class="text"> ข้อมูลหลักสูตร</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/SearchResearch" >
      <i class="glyphicon glyphicon-search"></i><span class="text"> ค้นหางานวิจัย</span></a>
    </li>
    <li><a href="<?php echo site_url();?>/graduate/SearchThesis" >
      <i class="glyphicon glyphicon-book"></i><span class="text"> ค้นหาวิทยานิพนธ์</span></a>
    </li>
    <li>
      <ul class="sub-menu" style="display: block;">
        <li class="">
          <a href="#" class="js-sub-menu-toggle">
            <span class="text">ตั้งค่า</span>
            <i class="toggle-icon fa fa-angle-left"></i>
          </a>
          <ul class="sub-menu">
            <li><a href="#">ภาระงานอาจารย์</a></li>
            <li><a href="#">ค่าตอบแทนประจำตำแหน่ง</a></li>
            <li><a href="#">ห้องสอบ</a></li>
            <li><a href="#">วันเวลาสอบเค้าโครง</a></li>
            <li><a href="#">เพิ่มอาจารย์ภายนอก</a></li>
            <li><a href="<?php echo site_url();?>/graduateByJo/selectGraduateOfficer" >เลือกอาจารย์ ปโท</a></li>
          </ul>

        </li>

      </ul>
    </li>
    <li><a href="<?php echo site_url();?>/home/logout/" >
      <i class="glyphicon glyphicon-remove-circle" style="color:red"></i><span class="text" style="color:red"> ออกจากระบบ</span></a>
    </li>
  </ul>
</nav>

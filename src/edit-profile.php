<?php
  include_once('html/common/header.php');
  include_once('html/pages/edit-profile.php');
  
  $courses = ["MIEIC", "MIEGI", "MIB", "MIEC", "MI:EF"];
  editProfileForm($courses);
  
  include_once('html/common/footer.php');
?>
<?php
  include_once('html/common/header.php');
  include_once('html/pages/add-question.php');

  $courses = ["MIEIC", "MIEGI", "MIB", "MIEC", "MI:EF"];

  questionForm($courses);

  include_once('html/common/footer.php');
?>
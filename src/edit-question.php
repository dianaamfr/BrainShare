<?php
  include_once('html/common/header.php');
  include_once('html/pages/edit-question.php');

  $courses = ["MIEIC", "MIEGI", "MIB", "MIEC", "MI:EF"];
  editQuestionForm($courses);

  include_once('html/common/footer.php');
?>
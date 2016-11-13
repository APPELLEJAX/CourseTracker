<?php

  require_once("page.inc.php");

  $page = new Page("Remove Course");

  $students = Array();
  if(($handle = fopen("students.csv", "r")) !== FALSE){
    while($student = fgets($handle)){
      $students[count($students)] = $student;
    }
    fclose($handle);
  }else{
    $page->content.= "<h1>STUDENT ERROR</h1>";
    $page->displayCont();
    exit();
  }

  $courses  = Array();
  if(($handle = fopen("classes.csv", "r")) !== FALSE){
    while($course = fgets($handle)){
      $courses[count($courses)] = $course;
    }
    fclose($handle);
  }else{
    $page->content.= "<h1>COURSE ERROR</h1>";
    $page->displayCont();
    exit();
  }

  $assignments = Array();
  if(($handle = fopen("assignments.csv", "r")) !== FALSE){
    while($assignment = fgets($handle)){
      $assignments[count($assignments)] = $assignment;
    }
    fclose($handle);
  }else{
    $page->content.= "<h1>ASSIGNMENT ERROR</h1>";
    $page->displayCont();
    exit();
  }

  if(!isset($_COOKIE["username"]) || !isset($_COOKIE["password"])){
    $page->content .= "<h1>AUTHENTICATION ERROR</h1>";
    $page->displayCont();
    exit();
  }

  $username = trim($_COOKIE["username"]);
  $password = trim($_COOKIE["password"]);


  if(($handle = fopen("students.csv", "w")) == FALSE){
    $page->content .= "<h1>FILEWRITE ERROR</h1>";
    $page->displayCont();
    exit();
  }
  foreach($students as &$student){
    $student = explode(",", $student);
    if(trim($student[0]) == $username && trim($student[1]) == $password){
      fwrite($handle, "$student[0],$student[1],");
      $myclasses = explode("|", $student[2]);
      $first = TRUE;
      foreach($myclasses as &$myclass){
        $myclass = preg_replace('/\s+/', '', $myclass);
        $get = $_GET[trim($myclass)];
        if($get != "on" && $myclass != "it300" && $myclass != "cc210"){
          fwrite($handle, ($first? " $myclass " : "| $myclass "));
          $first = FALSE;
        }
      }
      fwrite($handle, "\n");
    }else{
      fwrite($handle, "$student[0],$student[1],$student[2]");
    }
  }

  $page->content .= "<script type=\"text/javascript\">document.location = \"courses.php\"</script>";

  $page->displayTop();

  $page->displayFull();

  $page->displayBot();

 ?>

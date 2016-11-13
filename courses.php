<?php

  include_once("page.inc.php");

  $page = new Page("Courses");

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

  foreach($students as &$student){
    $student = explode(",", $student);
    if(trim($student[0]) == $username && trim($student[1]) == $password){
      $myclasses = explode("|", $student[2]);
    }
  }

  $page->content .= "<div class=\"title\"><h1>Course Manager</h1></div>";

  $page->content .= "<form class=\"incourses\" method=\"GET\" action=\"rmcourse.php\"><h3>DROP CLASSES</h3>";
  foreach($myclasses as &$myclass){
    $page->content .= "<label>$myclass<input type=\"checkbox\" name=\"$myclass\"/></label>";
  }
  $page->content .= "<input id=\"submit\" type=\"submit\" value=\"DROP\" /></form>";

  $page->content .= "<form class=\"outcourses\"><h3>ADD CLASSES</h3>";
  $page->content .= "<select>";
  foreach($courses as &$course){
    $page->content .= "<option value=\"$course\">$course</option>";
  }
  $page->content .= "</select>";
  $page->content .= "<input id=\"submit\" type=\"submit\" value=\"ADD\" /></form>";

  $page->displayTop();
  
  $page->displayFull();

  $page->displayBot();

 ?>

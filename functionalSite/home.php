<?php

  include_once("page.inc.php");

  $page = new Page("Home");

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

  $page->content .= "<div class=\"title\"><h1>Assignments<h1></div>";

  foreach($myclasses as &$myclass){
    $page->content .= "<div class=\"course\"><h2>$myclass</h2>";
    $cpassignments = $assignments;
    foreach($cpassignments as &$assignment){
      $assignment = explode(",", $assignment);
      if(trim($assignment[1]) == trim($myclass)){
        $page->content .= "<div class=\"assignment\">";
        $today = date("ymdhis");
        if($today <= trim($assignment[2])){
          $duedate = intval($assignment[2]);
          $ddyr    = floor($duedate / 10000000000);
          $ddyr    = "20" . "$ddyr";
          $mo      = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
          $ddmo    = floor(($duedate % 10000000000) / 100000000);
          $ddmo    = $mo[$ddmo];
          $dddy    = floor(($duedate % 100000000) / 1000000);
          $ddhr    = floor(($duedate % 1000000) / 10000);
          $ddhr    = ($ddhr < 10? "0" . $ddhr : $ddhr);
          $ddmn    = floor(($duedate % 10000) / 100);
          $ddmn    = ($ddmn < 10? "0" . $ddmn : $ddmn);
          $ddsc    = floor(($duedate % 100));
          $ddsc    = ($ddsc < 10? "0" . $ddsc : $ddsc);

          $page->content .= "<h3>$assignment[0] : due $dddy $ddmo, $ddyr @ $ddhr:$ddmn</h3>";
        }else{
          $page->content .= "<h3>$assignment[0] : expired</h3>";
        }
        $page->content .= "</div>";
      }
    }
    $page->content .= "</div>";
  }

  $page->displayTop();

  $page->displayFull();

  $page->displayBot();



 ?>

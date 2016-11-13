<?php

  class Page{
    var $title = "CourseTracker";
    var $stylesheet = "styles.css";
    var $content = "";

    function __construct($title){
      $this->title .= " - " . $title;
    }

    function displayFull(){
      echo "<div class=\"navbar\">";
      echo "<a class=\"navlink\" href=\"home.php\"><img src=\"home.svg\" alt=\"home\" /><h3>Home</h3></a>";
      echo "<a class=\"navlink\" href=\"profile.html\"><img src=\"profile.svg\" alt=\"profile\" /><h3>Profile</h3></a>";
      echo "<a class=\"navlink\" href=\"courses.php\"><img src=\"courses.svg\" alt=\"courses\" /><h3>Courses</h3></a>";
      echo "</div>";
      $this->displayCont();
    }

    function displayCont(){
      echo $this->content;
    }

    function displayTop(){
      echo "<!DOCTYPE html><html><head>";
      echo "<title>$this->title</title>";
      echo "<link rel=\"stylesheet\" href=\"$this->stylesheet\" />";
      echo "<script type=\"text/javascript\" src=\"coursescript.js\"></script>";
      echo "</head>";
      echo "<body>";
    }

    function displayBot(){
      echo "</body>";
      echo "</html>";
    }

  }

 ?>

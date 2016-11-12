<?php

  class Page{
    $title = "CourseTracker";
    $stylesheet = "";
    $content = "";

    function __construct($title){
      $this->title .= " - " . $title;
    }

    function displayFull(){
      echo "<div class=\"navbar\">";
      echo "<a class=\"navlink\" href=\"home.php\"><img src=\"\"</a>"
      echo "</div>";
      $this->displayCont();
    }

    function dipslayCont(){
      echo $this->content;
    }

    function displayTop(){
      echo "<!DOCTYPE html><html><head>";
      echo "<title>$this->title</title>";
      echo "<link rel=\"stylesheet\" href=\"$this->stylesheet\" />";
      echo "</head>";
      echo "<body>";
    }

    function displayBot(){
      echo "</body>";
      echo "</html>";
    }



  }

 ?>

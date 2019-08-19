<?php
require_once "database-functions.php";
require_once "doctor.php";
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(isset($username) && isset($password)){
          $doc =  Doctor::initDoctorWithNothing();
          $doc_info = $doc->getDoctorByUsername($username,$password);
          if($doc_info != array()){
              // session start
              echo "valide ";
          }else echo "not working";
        }
    }
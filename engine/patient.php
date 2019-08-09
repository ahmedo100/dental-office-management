<?php
//// The names that should be put inside the form when adding a patient ////

//// full_name_patient , address_patient , gender_patient , ////

/// phone_number_patient , birthdate_patient , id_doctor///

require_once "database-functions.php";
require_once "database-logs.php";

class Patient {
    
  function  __construct($id_patient){
        $this->id_patient = $id_patient;
        $db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $this->initPatient();
    }

  function initPatient(){
    $patient=  $db->selectData("patients","*","id_patient='"+$this->id_patient+"';")[0];
        $this->full_name_patient= $patient["full_name_patient"];
        $this->phone_number_patient= $patient["phone_number_patient"];
        $this->gender_patient = $patient["gender_patient"];
        $this->address_patient = $patient["address_patient"];
  }

  function getPatientById($id_patient){
    return new Patient($id_patient);
  }


  function addPatient($patient_arr){
      
  }

}


?>
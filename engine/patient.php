<?php
//// The names that should be put inside the form when adding a patient ////

//// full_name_patient , address_patient , gender_patient , ////

/// phone_number_patient , birthdate_patient , id_doctor///

require_once "database-functions.php";
require_once "database-logs.php";

class Patient {
  
  private $db;
  private $full_name_patient , $phone_number_patient , $gender_patient ,$address_patient;

  function  __construct($id_patient){
        $this->id_patient = $id_patient;
        $db = new DatabaseUtility(SERVERNAME,USERNAME,PASSWORD);
        $this->initPatient();
    }

  public static function 
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
      $return_result = $db->insertData("patient",$patient_arr);

      if($return_result["success"]!=true){
          throw new Exception;
      }

      return true;
  }



  
// Getters // 
  /**
   * Get the value of full_name_patient
   */ 
  public function getFull_name_patient()
  {
    return $this->full_name_patient;
  }

  /**
   * Get the value of phone_number_patient
   */ 
  public function getPhone_number_patient()
  {
    return $this->phone_number_patient;
  }

  /**
   * Get the value of gender_patient
   */ 
  public function getGender_patient()
  {
    return $this->gender_patient;
  }

  /**
   * Get the value of address_patient
   */ 
  public function getAddress_patient()
  {
    return $this->address_patient;
  }
}


?>